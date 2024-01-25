<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Motherboards') }}
            </h2>
            <a href="{{ route('motherboard.create') }}" class="py-2 px-4 bg-black text-white font-semibold">Add motherboard</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-[1366px] mx-auto sm:px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if (count($motherboards))
                    <div class="px-4">
                        <table class="w-full rounded-lg overflow-hidden text-sm">
                            <tr class="text-white bg-gray-900">
                                <th class="text-start p-2">Image</th>
                                <th class="text-start p-2">Name</th>
                                <th class="text-start p-2">Socket</th>
                                <th class="text-start p-2">Size</th>
                                <th class="text-start p-2">Memory</th>
                                <th class="text-start p-2">RAMs</th>
                                <th class="text-start p-2">Price</th>
                                <th class="text-start p-2">Created</th>
                                <th class="text-start p-2">Status</th>
                                <th class="text-end p-2">Delete</th>
                                <th class="text-end p-2">Edit</th>
                            </tr>
                            @foreach ($motherboards as $motherboard)
                                <tr class="odd:bg-gray-100">
                                    <td class="text-start p-2">
                                        <a href="{{ asset('/storage/'. $motherboard->image) }}" target="_blank" class="w-fit">
                                            <img width="40px" class="lazyload" data-src="{{ asset('/storage/'. $motherboard->image) }}" alt="Image">
                                        </a>
                                    </td>
                                    <td class="text-start p-2">{{ $motherboard->name }}</td>
                                    <td class="text-start p-2">{{ $motherboard->socket->name }}</td>
                                    <td class="text-start p-2">{{ $motherboard->size->size }}</td>
                                    <td class="text-start p-2">{{ $motherboard->memory->name }}</td>
                                    <td class="text-start p-2">{{ $motherboard->ram_slots }}</td>
                                    <td class="text-start p-2 font-semibold">€{{ number_format($motherboard->price, 2) }}</td>
                                    <td class="text-start p-2">{{ $motherboard->created_at->diffForHumans() }}</td>
                                    <td class="text-start p-2"><form action="{{ route('motherboard.status.update', $motherboard->id) }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        @if ($motherboard->is_active)
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
                                        <form action="{{ route('motherboard.delete', $motherboard->id) }}" method="post" id="form">
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
                                        <a href="{{ route('update.motherboard', $motherboard->id) }}" class="underline text-indigo-600 cursor-pointer">Update</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                        @if ($motherboards->hasPages())
                            <div class="p-3 bg-gray-100 rounded-lg">
                                {{ $motherboards->links() }}
                            </div>
                        @endif
                    </div>
                @else
                    <p class="py-4 text-center">No motherboard(s) data exist in the system!</p>
                @endif
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var form = document.getElementById('form');
                form.addEventListener('submit', function (event) {
                    var isConfirmed = confirm('Are you sure you want to delete the motherboard?');
                    if (!isConfirmed) {
                        event.preventDefault();
                    }
                });
            });
        </script>
    </div>
</x-app-layout>