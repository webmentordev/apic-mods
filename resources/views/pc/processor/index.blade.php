<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Processors') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <x-success :text="session('success')" />
                    @endif
                    @if (session('failed'))
                        <x-failed :text="session('failed')" />
                    @endif
                    <form action="{{ route('processor') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <x-input-label for="images" :value="__('Upload Processor')" />
                        <div class="flex items-center">
                            <div class="w-full mr-3">
                                <x-text-input id="name" class="block mt-1 w-full border-none rounded-lg bg-gray-100 py-2 px-3" type="text" placeholder="Processor Name" name="name" :value="old('name')" required />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="w-full mr-3">
                                <x-text-input id="price" class="block mt-1 w-full border-none rounded-lg bg-gray-100 py-2 px-3" type="number" placeholder="Processor Price" step="0.01" name="price" :value="old('price')" required />
                                <x-input-error :messages="$errors->get('price')" class="mt-2" />
                            </div>
                            <div class="w-full mr-3">
                                <x-text-input id="image" class="block mt-1 w-full border-none rounded-lg bg-gray-100 py-2 px-3" type="file" accept="image/*" name="image" :value="old('image')" required />
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>
                            <x-primary-button class="ms-4 py-3">
                                {{ __('Create') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>

                @if (count($processors))
                    <div class="px-4">
                        <table class="w-full rounded-lg overflow-hidden text-sm">
                            <tr class="text-white bg-gray-900">
                                <th class="text-start p-2">Image</th>
                                <th class="text-start p-2">Name</th>
                                <th class="text-start p-2">Price</th>
                                <th class="text-start p-2">Created</th>
                                <th class="text-start p-2">Status</th>
                                <th class="text-start p-2">Delete</th>
                                <th class="text-end p-2">Edit</th>
                            </tr>
                            @foreach ($processors as $processor)
                                <tr class="odd:bg-gray-100">
                                    <td class="text-start p-2">
                                        <a href="{{ asset('/storage/'. $processor->image) }}" target="_blank" class="w-fit">
                                            <img width="40px" class="lazyload" data-src="{{ asset('/storage/'. $processor->image) }}" alt="Image">
                                        </a>
                                    </td>
                                    <td class="text-start p-2">{{ $processor->name }}</td>
                                    <td class="text-start p-2">€{{ number_format($processor->price, 2) }}</td>
                                    <td class="text-start p-2">{{ $processor->created_at->diffForHumans() }}</td>
                                    <td class="text-start p-2"><form action="{{ route('processor.status.update', $processor->id) }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        @if ($processor->is_active)
                                            <x-table-button class="bg-green-700 py-3">
                                                <div class="flex items-center">
                                                    <img src="https://api.iconify.design/ic:baseline-check-circle.svg?color=%23ffffff" alt="Active">
                                                    <span class="ml-2">Active</span>
                                                </div>
                                            </x-table-button>
                                        @else
                                            <x-table-button class="bg-red-700 py-3">
                                                <div class="flex items-center">
                                                    <img src="https://api.iconify.design/charm:circle-cross.svg?color=%23ffffff" alt="Deactive">
                                                    <span class="ml-2">InActive</span>
                                                </div>
                                            </x-table-button>
                                        @endif
                                    </form></td>
                                    <td class="text-end p-2">
                                        <form action="{{ route('processor.delete', $processor->id) }}" method="post" id="form">
                                            @csrf
                                            @method('DELETE')
                                            <x-table-button class="bg-red-700 p-2 py-3">
                                                <div class="flex items-center">
                                                    <img src="https://api.iconify.design/charm:circle-cross.svg?color=%23ffffff" alt="Delete">
                                                    <span class="ml-2">Delete</span>
                                                </div>
                                            </x-table-button>
                                        </form>
                                    </td>
                                    <td class="text-end p-2">
                                        <a href="{{ route('update.processor', $processor->id) }}" class="underline text-indigo-600 cursor-pointer">Update</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                        @if ($processors->hasPages())
                            <div class="p-3 bg-gray-100 rounded-lg">
                                {{ $processors->links() }}
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>