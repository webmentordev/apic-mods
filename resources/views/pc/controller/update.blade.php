<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Update Custom Controller') }}
            </h2>
            <a href="{{ route('controller') }}" class="py-2 px-4 bg-black text-white font-semibold">Go Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-4 text-3xl font-semibold">Update Controller</h2>
                    @if (session('success'))
                        <x-success :text="session('success')" />
                    @endif
                    <form action="{{ route('controller.update', $controller->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="w-full mb-3">
                            <x-input-label for="name" :value="__('Controller name')" />
                            <x-text-input id="name" class="block mt-1 w-full border-none rounded-lg bg-gray-100 p-3" type="text" name="name" value="{{ $controller->name }}" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="w-full mb-3">
                            <x-input-label for="price" :value="__('Controller price')" />
                            <x-text-input id="price" class="block mt-1 w-full border-none rounded-lg bg-gray-100 p-3" type="number" step="0.01" name="price" value="{{ $controller->price }}" required />
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