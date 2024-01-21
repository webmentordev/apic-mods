<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Build Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <x-success :text="session('success')" />
                    @endif
                    <form action="{{ route('category') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <x-input-label for="title" :value="__('Create build category')" />
                        <div class="flex items-center mb-3">
                            <div class="w-full mr-3">
                                <x-text-input id="title" class="block mt-1 w-full border-none rounded-lg bg-gray-100 p-3" type="text" name="title" :value="old('title')" required />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                            <x-primary-button class="ms-4 py-3">
                                {{ __('Upload') }}
                            </x-primary-button>
                        </div>
                        <div class="w-full mb-3">
                            <x-input-label for="detail" :value="__('Details (optional)')" />
                            <x-text-area cols="30" rows="4" id="detail" class="block mt-1 w-full border-none rounded-lg bg-gray-100 p-3" type="text" name="detail" :value="old('detail')" required />
                            <x-input-error :messages="$errors->get('detail')" class="mt-2" />
                        </div>
                    </form>
                </div>

                @if (count($categories))
                    <div class="px-4 pb-6">
                        <table class="w-full rounded-lg overflow-hidden">
                            <tr class="text-white bg-gray-900">
                                <th class="text-start p-2">Title</th>
                                <th class="text-start p-2">Detail</th>
                                <th class="text-start p-2">Created</th>
                                <th class="text-start p-2">Status</th>
                                <th class="text-start p-2">Featured</th>
                                <th class="text-end p-2">Delete</th>
                            </tr>
                            @foreach ($categories as $category)
                                <tr class="odd:bg-gray-100">
                                    <td class="text-start p-2">
                                        {{ $category->title }}
                                    </td>
                                    <td class="text-start p-2" x-data="{ open: false }">
                                        <span class="underline text-indigo-600 cursor-pointer" x-on:click="open = !open">Open</span>
                                        <div x-cloak x-transition x-show="open" class="absolute p-6 rounded-lg bottom-4 left-4 shadow-2xl max-w-lg w-full">
                                            <div class="relative w-full h-full">
                                                <img class="absolute -top-5 -right-6 z-10 cursor-pointer" x-on:click="open = false" width="40" src="https://api.iconify.design/material-symbols-light:cancel.svg?color=%23e33535" alt="Close Icon">
                                                <p>{{ $category->detail }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-start p-2">{{ $category->created_at->diffForHumans() }}</td>
                                    <td class="text-start p-2"><form action="{{ route('category.status.update', $category->id) }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        @if ($category->is_active)
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
                                    <td class="text-start p-2"><form action="{{ route('category.featured.update', $category->id) }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        @if ($category->is_featured)
                                            <x-table-button class="bg-green-700 py-3">
                                                <div class="flex items-center">
                                                    <img src="https://api.iconify.design/ic:baseline-check-circle.svg?color=%23ffffff" alt="Active">
                                                    <span class="ml-2">Featured</span>
                                                </div>
                                            </x-table-button>
                                        @else
                                            <x-table-button class="bg-red-700 py-3">
                                                <div class="flex items-center">
                                                    <img src="https://api.iconify.design/charm:circle-cross.svg?color=%23ffffff" alt="Deactive">
                                                    <span class="ml-2">NoFeatured</span>
                                                </div>
                                            </x-table-button>
                                        @endif
                                    </form></td>
                                    <td class="text-end p-2">
                                        <form action="{{ route('category.delete', $category->id) }}" method="post" id="form">
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

                        @if ($categories->hasPages())
                            <div class="p-3 bg-gray-100 rounded-lg">
                                {{ $categories->links() }}
                            </div>
                        @endif
                    </div>
                @else
                    <p class="text-center pb-4">No build categories exist</p>
                @endif
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var form = document.getElementById('form');
                form.addEventListener('submit', function (event) {
                    var isConfirmed = confirm('Are you sure you want to delete this form?');
                    if (!isConfirmed) {
                        event.preventDefault();
                    }
                });
            });
        </script>
    </div>
</x-app-layout>