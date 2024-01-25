<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Update Processor') }}
            </h2>
            <a href="{{ route('processor') }}" class="py-2 px-4 bg-black text-white font-semibold">Go Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-4 text-3xl font-semibold">Add new processor</h2>
                    @if (session('success'))
                        <x-success :text="session('success')" />
                    @endif
                    <form action="{{ route('processor') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="w-full mb-3">
                            <x-input-label for="name" :value="__('Processor name')" />
                            <x-text-input id="name" class="block mt-1 w-full border-none rounded-lg bg-gray-100 p-3" type="text" name="name" :value="old('name')" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        
                        <div class="w-full mb-3">
                            <x-input-label for="price" :value="__('Processor price')" />
                            <x-text-input id="price" class="block mt-1 w-full border-none rounded-lg bg-gray-100 p-3" type="number" step="0.01" name="price" :value="old('price')" required />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>
                        
                        <div class="w-full mb-3">
                            <x-input-label for="socket" :value="__('Processor socket')" />
                            <x-select id="socket" class="block mt-1 w-full border-none rounded-lg bg-gray-100 p-3" 
                            name="socket" :value="old('socket')" required :disabled="count($sockets) == 0">
                                @if (count($sockets))
                                    <option value="" selected>-- Please select socket type --</option>
                                    @foreach ($sockets as $socket)
                                        <option value="{{ $socket->id }}">{{ $socket->name }}</option>
                                    @endforeach
                                @else
                                    <option value="" selected>Please add a socket type first</option>
                                @endif
                            </x-select>
                            <x-input-error :messages="$errors->get('socket')" class="mt-2" />
                        </div>

                        <div class="w-full mb-3">
                            <x-input-label for="name" :value="__('Processor image')" />
                            <x-text-input id="image" class="block mt-1 w-full border-none rounded-lg bg-gray-100 p-3" type="file" accept="image/*" name="image" required />
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        <x-primary-button class="py-3">
                            {{ __('Create') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>