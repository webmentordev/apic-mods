<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Builds') }}
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
                    <form action="{{ route('gallery') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <x-input-label for="images" :value="__('Uplaod Build Image')" />
                        <div class="flex items-center">
                            <div class="w-full mr-3">
                                <x-text-input id="images" class="block mt-1 w-full border-none rounded-lg bg-gray-100 py-2 px-3" type="file" accept="image/*" multiple name="images[]" :value="old('image')" required />
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>

                            <div class="w-full mr-3">
                                <x-select id="category" class="block mt-1 w-full border-none rounded-lg bg-gray-100 p-3" 
                                name="category" :value="old('category')" required :disabled="count($categories) == 0">
                                    @if (count($categories))
                                        <option value="" selected>-- Please select build category --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    @else
                                        <option value="" selected>Please create a build category first</option>
                                    @endif
                                </x-select>
                                <x-input-error :messages="$errors->get('category')" class="mt-2" />
                            </div>

                            <x-primary-button class="ms-4 py-3">
                                {{ __('Upload') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>

                @if (count($images))
                    <div class="px-4">
                        <table class="w-full rounded-lg overflow-hidden text-sm">
                            <tr class="text-white bg-gray-900">
                                <th class="text-start p-2">Image</th>
                                <th class="text-start p-2">Category</th>
                                <th class="text-start p-2">Uploaded</th>
                                <th class="text-start p-2">Status</th>
                                <th class="text-end p-2">Delete</th>
                            </tr>
                            @foreach ($images as $image)
                                <tr class="odd:bg-gray-100">
                                    <td class="text-start p-2">
                                        <a href="{{ asset('/storage/'. $image->image) }}" target="_blank" class="w-fit">
                                            <img width="40px" class="lazyload" data-src="{{ asset('/storage/'. $image->image) }}" alt="Image">
                                        </a>
                                    </td>
                                    <td class="text-start p-2">{{ $image->category->title }}</td>
                                    <td class="text-start p-2">{{ $image->created_at->diffForHumans() }}</td>
                                    <td class="text-start p-2"><form action="{{ route('gallery.status.update', $image->id) }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        @if ($image->is_active)
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
                                        <form action="{{ route('gallery.delete', $image->id) }}" method="post" id="form">
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

                        @if ($images->hasPages())
                            <div class="p-3 bg-gray-100 rounded-lg">
                                {{ $images->links() }}
                            </div>
                        @endif
                    </div>
                @else
                    <p class="py-4 text-center">Builds data does not exist!</p>
                @endif
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var form = document.getElementById('form');
                form.addEventListener('submit', function (event) {
                    var isConfirmed = confirm('Are you sure you want to delete this build?');
                    if (!isConfirmed) {
                        event.preventDefault();
                    }
                });
            });
        </script>
    </div>
</x-app-layout>