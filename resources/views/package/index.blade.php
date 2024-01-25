<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Packages') }}
            </h2>
            <a href="{{ route('create.package') }}" class="py-2 px-4 bg-black text-white font-semibold">Create Package</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if (count($packages))
                    <div class="px-4">
                        <table class="w-full rounded-lg overflow-hidden text-sm">
                            <tr class="text-white bg-gray-900">
                                <th class="text-start p-2">Name</th>
                                <th class="text-start p-2">Category</th>
                                <th class="text-start p-2">Price</th>
                                <th class="text-start p-2">Description</th>
                                <th class="text-start p-2">Created</th>
                                <th class="text-start p-2">Status</th>
                                <th class="text-start p-2">Delete</th>
                                <th class="text-end p-2">Update</th>
                            </tr>
                            @foreach ($packages as $package)
                                <tr class="odd:bg-gray-100">
                                    <td class="text-start p-2">
                                        {{ $package->title }}
                                    </td>
                                    <td class="text-start p-2">
                                        €{{ number_format($package->price, 2) }}
                                    </td>
                                    <td class="text-start p-2">
                                        {{ $package->category }}
                                    </td>
                                    <td class="text-start p-2" x-data="{ open: false }">
                                        <span class="underline text-indigo-600 cursor-pointer" x-on:click="open = !open">Open</span>
                                        <div x-cloak x-transition x-show="open" class="absolute p-6 rounded-lg bottom-4 left-4 shadow-2xl max-w-lg w-full">
                                            <div class="relative w-full h-full">
                                                <img class="absolute -top-5 -right-6 z-10 cursor-pointer" x-on:click="open = false" width="40" src="https://api.iconify.design/material-symbols-light:cancel.svg?color=%23e33535" alt="Close Icon">
                                                <p>{{ $package->description }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-start p-2">{{ $package->created_at->diffForHumans() }}</td>
                                    <td class="text-start p-2"><form action="{{ route('package.status.update', $package->id) }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        @if ($package->is_active)
                                            <x-table-button class="bg-green-700 py-3">
                                                <img src="https://api.iconify.design/ic:baseline-check-circle.svg?color=%23ffffff" alt="Active">
                                                <span class="ml-2">Active</span>
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
                                    
                                    <td class="text-start p-2">
                                        <form action="{{ route('package.delete', $package->id) }}" method="post" id="form">
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
                                        <a href="{{ route('update.package', $package->id) }}" class="underline text-indigo-600 cursor-pointer">Update</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                        @if ($packages->hasPages())
                            <div class="p-3 bg-gray-100 rounded-lg">
                                {{ $packages->links() }}
                            </div>
                        @endif
                    </div>
                @else
                    <p class="text-center pb-4">No packages data exist</p>
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