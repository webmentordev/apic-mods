<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('PC Coolers') }}
            </h2>
            <a href="{{ route('cooler') }}" class="py-2 px-4 bg-black text-white font-semibold">Go Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-4 text-3xl font-semibold">Add new Cooler</h2>
                    @if (session('success'))
                        <x-success :text="session('success')" />
                    @endif
                    <form action="{{ route('cooler') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="w-full mb-3">
                            <x-input-label for="name" :value="__('Cooler name')" />
                            <x-text-input id="name" class="block mt-1 w-full border-none rounded-lg bg-gray-100 p-3" type="text" name="name" value="{{ old('name') }}" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="w-full mb-3">
                            <x-input-label for="price" :value="__('Cooler price')" />
                            <x-text-input id="price" class="block mt-1 w-full border-none rounded-lg bg-gray-100 p-3" type="number" step="0.01" name="price" value="{{ old('price') }}" required />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        <div class="w-full mb-3">
                            <x-input-label for="type" :value="__('Cooler Type')" />
                            <x-select id="type" class="block mt-1 w-full border-none rounded-lg bg-gray-100 p-3" 
                            name="type" required>
                                <option value="" selected>-- Select cooler type --</option>
                                <option value="Air Cooler">Air Cooler</option>
                                <option value="Water Cooler">Water Cooler</option>
                            </x-select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>


                        <div class="w-full mb-3">
                            <x-input-label for="aio" :value="__('Cooler AIO type')" />
                            <x-select id="aio" class="block mt-1 w-full border-none rounded-lg bg-gray-100 p-3" 
                            name="aio">
                                <option value="" selected>No AIO Type</option>
                                <option value="120MM">120MM</option>
                                <option value="360MM">360MM</option>
                                <option value="240MM">240MM</option>
                            </x-select>
                            <x-input-error :messages="$errors->get('aio')" class="mt-2" />
                        </div>

                        <div class="w-full mb-3">
                            <x-input-label for="image" :value="__('Cooler Image')" />
                            <x-text-input id="image" class="block mt-1 w-full border-none rounded-lg bg-gray-100 py-2 px-3" type="file" accept="image/*" name="image" required />
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