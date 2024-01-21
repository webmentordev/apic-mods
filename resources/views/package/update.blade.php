<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Update Package') }}
            </h2>
            <a href="{{ route('package') }}" class="py-2 px-4 bg-black text-white font-semibold">Go Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-4 text-3xl font-semibold">Update Package</h2>
                    @if (session('success'))
                        <x-success :text="session('success')" />
                    @endif
                    <form action="{{ route('package.update', $package->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="w-full mb-3">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="block mt-1 w-full border-none rounded-lg bg-gray-100 p-3" type="text" name="title" :value="$package->title" required />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="w-full mb-3">
                            <x-input-label for="category" :value="__('Category (e.g Basic, Premium)')" />
                            <x-text-input id="category" class="block mt-1 w-full border-none rounded-lg bg-gray-100 p-3" type="text" name="category" :value="$package->category" required />
                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                        </div>

                        <div class="w-full mb-3">
                            <x-input-label for="description" :value="__('Description')" />
                            <x-text-area cols="30" rows="4" id="description" class="block mt-1 w-full border-none rounded-lg bg-gray-100 p-3" type="text" name="description" :value="$package->description" required />
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="w-full mb-3">
                            <x-input-label for="price" :value="__('Price')" />
                            <x-text-input id="price" step="0.01" class="block mt-1 w-full border-none rounded-lg bg-gray-100 p-3" type="number" name="price" :value="$package->price" required />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        <x-primary-button class="py-3">
                            {{ __('Update') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>