<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Custom Controllers data') }}
            </h2>
            <a href="{{ route('controller.create') }}" class="py-2 px-4 bg-black text-white font-semibold">Add Controller</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-[98%] w-full mx-auto sm:px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if (session('success'))
                    <x-success :text="session('success')" />
                @endif
                @if (count($controllers))
                    <div class="px-4">
                        <table class="w-full rounded-lg overflow-hidden text-sm">
                            <tr class="text-white bg-gray-900">
                                <th class="text-start p-2">Name</th>
                                <th class="text-start p-2">Price</th>
                                <th class="text-start p-2">Added</th>
                                <th class="text-start p-2">Status</th>
                                <th class="text-end p-2">Delete</th>
                                <th class="text-end p-2">Update</th>
                            </tr>
                            @foreach ($controllers as $item)
                                <tr class="odd:bg-gray-100">
                                    <td class="text-start p-2">{{ $item->name }}</td>
                                    <td class="text-start p-2 font-semibold">€{{ number_format($item->price, 2) }}</td>
                                    <td class="text-start p-2">{{ $item->created_at->diffForHumans() }}</td>
                                    <td class="text-start p-2"><form action="{{ route('controller.status.update', $item->id) }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        @if ($item->is_active)
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
                                        <form action="{{ route('controller.delete', $item->id) }}" method="post" id="form">
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
                                        <a href="{{ route('update.controller', $item->id) }}" class="underline text-indigo-600 cursor-pointer">Update</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                        @if ($controllers->hasPages())
                            <div class="p-3 bg-gray-100 rounded-lg">
                                {{ $controllers->links() }}
                            </div>
                        @endif
                    </div>
                @else
                    <p class="py-4 text-center">CONTROLLER data does not exist!</p>
                @endif
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var form = document.getElementById('form');
                form.addEventListener('submit', function (event) {
                    var isConfirmed = confirm('Are you sure you want to delete this controller?');
                    if (!isConfirmed) {
                        event.preventDefault();
                    }
                });
            });
        </script>
    </div>
</x-app-layout>