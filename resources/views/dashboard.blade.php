<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 p-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 grid grid-cols-3 gap-6">
                    <div class="bg-gray-100 border border-gray-100 rounded-lg p-6">
                        <h2 class="font-semibold text-2xl">Total CPU</h2>
                        <p>{{ $cpus }}</p>
                    </div>
                    <div class="bg-gray-100 border border-gray-100 rounded-lg p-6">
                        <h2 class="font-semibold text-2xl">Total Worth Of CPU</h2>
                        <p>€{{ $cpu_price }}</p>
                    </div>
                    <div class="bg-gray-100 border border-gray-100 rounded-lg p-6">
                        <h2 class="font-semibold text-2xl">Total Motherboards</h2>
                        <p>{{ $motherboards }}</p>
                    </div>
                    <div class="bg-gray-100 border border-gray-100 rounded-lg p-6">
                        <h2 class="font-semibold text-2xl">Worth of Motherboards</h2>
                        <p>€{{ $motherboard_price }}</p>
                    </div>
                    <div class="bg-gray-100 border border-gray-100 rounded-lg p-6">
                        <h2 class="font-semibold text-2xl">Total Packages</h2>
                        <p>{{ $packages }}</p>
                    </div>
                </div>

                <div class="p-6 text-gray-900 grid grid-cols-3 gap-6 border-t border-gray-200">
                    <div class="bg-gray-100 border border-gray-100 rounded-lg p-6">
                        <h2 class="font-semibold text-2xl">Build Categories</h2>
                        <p>{{ $build_category }}</p>
                    </div>
                    <div class="bg-gray-100 border border-gray-100 rounded-lg p-6">
                        <h2 class="font-semibold text-2xl">Builds</h2>
                        <p>{{ $builds }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
