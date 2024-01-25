<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Memory Types') }}
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
                    <form action="{{ route('memory.type') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <x-input-label for="memory" :value="__('Memory Name (e.g DDR4)')" />
                        <div class="flex items-center">
                            <div class="w-full mr-3">
                                <x-text-input id="name" class="block mt-1 w-full border-none rounded-lg bg-gray-100 py-2 px-3" type="text" placeholder="Memory" name="name" :value="old('name')" required />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <x-primary-button class="ms-4 py-3">
                                {{ __('Create') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>

                @if (count($memorytypes))
                    <div class="px-4">
                        <table class="w-full rounded-lg overflow-hidden text-sm">
                            <tr class="text-white bg-gray-900">
                                <th class="text-start p-2">Name</th>
                                <th class="text-start p-2">Created</th>
                                <th class="text-end p-2">Delete</th>
                            </tr>
                            @foreach ($memorytypes as $type)
                                <tr class="odd:bg-gray-100">
                                    <td class="text-start p-2">{{ $type->name }}</td>
                                    <td class="text-start p-2">{{ $type->created_at->diffForHumans() }}</td>
                                    <td class="text-end p-2">
                                        <form action="{{ route('memory.type.delete', $type->id) }}" method="post" id="form">
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
                                </tr>
                            @endforeach
                        </table>
                        @if ($memorytypes->hasPages())
                            <div class="p-3 bg-gray-100 rounded-lg">
                                {{ $memorytypes->links() }}
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>