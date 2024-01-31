<section class="w-full px-4 py-[150px] bg-dark">
    <div class="max-w-3xl m-auto pb-[150px]">
        <h2 class="mb-12 lemon_m text-center text-4xl text-white 650px:text-4xl">BUILD YOUR <span class="text-main lemon_m">CUSTOM GAMING</span> PC</h2>
        <main class="w-full">
            <div class="mb-3 w-full">
                <div class="flex items-center">
                    <x-custom-label :value="__('CPU / Processor')" />
                    @if (isset($items['processor']))
                        <img class="ml-2 -translate-y-1" src="https://api.iconify.design/ic:round-check-circle-outline.svg?color=%2326cf42" width="20">
                    @endif
                </div>
                <div class="w-full relative" x-data="{ open: false }">
                    <div x-on:click="open=!open" class="w-full flex items-center justify-between rounded-sm py-3 px-3 bg-dark-light text-white cursor-pointer"><span>— Wählen Sie einen Prozessor aus —</span><img src="https://api.iconify.design/bx:caret-down.svg?color=%237d7d7d" alt="Caret Down"></div>
                    <div x-cloak x-transition x-show="open" class="w-full z-10 absolute top-12 rounded-md left-0 bg-dark-light p-2 text-white max-h-[200px] h-fit overflow-y-scroll">
                        @foreach ($processors as $item)
                            <div wire:click="$set('processor', '{{ $item->name }}')" x-on:click="open=false" class="flex items-center cursor-pointer justify-between bg-dark-light rounded-lg mb-2 p-3">
                                <div class="flex items-center">
                                    <img src="{{ asset('/storage/'. $item->image) }}" class="max-w-[40px] mr-3 w-full" alt="">
                                    <p>{{ substr($item->name, 0, 70) }}...</p>
                                </div>
                                <p class="text-main">€ {{ $item->price }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @if ($processor)
                <div class="mb-3 w-full">
                    <div class="flex items-center">
                        <x-custom-label :value="__('Motherboard')" />
                        @if (isset($items['motherboard']))
                            <img class="ml-2 -translate-y-1" src="https://api.iconify.design/ic:round-check-circle-outline.svg?color=%2326cf42" width="20">
                        @endif
                    </div>
                    @if (count($sockets->motherboards))
                        <div class="w-full relative" x-data="{ open: false }">
                            <div x-on:click="open=!open" class="w-full flex items-center justify-between rounded-sm py-3 px-3 bg-dark-light text-white cursor-pointer"> <span>— Wählen Sie ein Motherboard aus —</span><img src="https://api.iconify.design/bx:caret-down.svg?color=%237d7d7d" alt="Caret Down"></div>
                            <div x-cloak x-transition x-show="open" class="w-full z-10 absolute top-12 rounded-md left-0 bg-dark-light p-2 text-white max-h-[200px] h-fit overflow-y-scroll">
                                @foreach ($sockets->motherboards as $item)
                                    <div wire:click="$set('motherboard', '{{ $item->name }}')" x-on:click="open=false" class="flex items-center cursor-pointer justify-between bg-dark-light rounded-lg mb-2 p-3">
                                        <div class="flex items-center">
                                            <img src="{{ asset('/storage/'. $item->image) }}" class="max-w-[40px] mr-3 w-full" alt="">
                                            <p>{{ substr($item->name, 0, 70) }}...</p>
                                        </div>
                                        <p class="text-main">€ {{ number_format($item->price, 2) }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <p class="text-white">Motherboards für den Prozessor gibt es nicht!</p>
                    @endif
                </div>


                @if ($motherboard)
                    <div class="mb-3 w-full">
                        <div class="flex items-center">
                            <x-custom-label :value="__('Memory (RAM)')" />
                            @if (isset($items['ram']))
                                <img class="ml-2 -translate-y-1" src="https://api.iconify.design/ic:round-check-circle-outline.svg?color=%2326cf42" width="20">
                            @endif
                        </div>
                        @if ($memories)
                            <div class="w-full relative" x-data="{ open: false }">
                                <div x-on:click="open=!open" class="w-full flex items-center justify-between rounded-sm py-3 px-3 bg-dark-light text-white cursor-pointer"> <span>— Wählen Sie ein Memory aus —</span><img src="https://api.iconify.design/bx:caret-down.svg?color=%237d7d7d" alt="Caret Down"></div>
                                <div x-cloak x-transition x-show="open" class="w-full z-10 absolute top-12 rounded-md left-0 bg-dark-light p-2 text-white max-h-[200px] h-fit overflow-y-scroll">
                                    @foreach ($memories as $item)
                                        <div wire:click="$set('ram', '{{ $item->name }}')" x-on:click="open=false" class="flex items-center cursor-pointer justify-between bg-dark-light rounded-lg mb-2 p-3">
                                            <div class="flex items-center">
                                                <img src="{{ asset('/storage/'. $item->image) }}" class="max-w-[40px] mr-3 w-full" alt="">
                                                <p>{{ substr($item->name, 0, 70) }}...</p>
                                            </div>
                                            <p class="text-main">€ {{ $item->price }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <p class="text-white">Motherboards für den memory gibt es nicht!</p>
                        @endif
                    </div>
                @endif
            @endif


            <div class="mb-3 w-full">
                <div class="flex items-center">
                    <x-custom-label :value="__('NVME (Storage)')" />
                    @if (isset($items['nvme']))
                        <img class="ml-2 -translate-y-1" src="https://api.iconify.design/ic:round-check-circle-outline.svg?color=%2326cf42" width="20">
                    @endif
                </div>
                @if ($nvmes)
                    <div class="w-full relative" x-data="{ open: false }">
                        <div x-on:click="open=!open" class="w-full flex items-center justify-between rounded-sm py-3 px-3 bg-dark-light text-white cursor-pointer"> <span>— Wählen Sie ein NVMEs aus —</span><img src="https://api.iconify.design/bx:caret-down.svg?color=%237d7d7d" alt="Caret Down"></div>
                        <div x-cloak x-transition x-show="open" class="w-full z-10 absolute top-12 rounded-md left-0 bg-dark-light p-2 text-white max-h-[200px] h-fit overflow-y-scroll">
                            @foreach ($nvmes as $item)
                                <div wire:click="$set('nvme', '{{ $item->name }}')" x-on:click="open=false" class="flex items-center cursor-pointer justify-between bg-dark-light rounded-lg mb-2 p-3">
                                    <div class="flex items-center">
                                        <img src="{{ asset('/storage/'. $item->image) }}" class="max-w-[40px] mr-3 w-full" alt="">
                                        <p>{{ substr($item->name, 0, 70) }}...</p>
                                    </div>
                                    <p class="text-main">€ {{ $item->price }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <p class="text-white">Motherboards für den nvme gibt es nicht!</p>
                @endif
            </div>


            <div class="mb-3 w-full">
                <div class="flex items-center">
                    <x-custom-label :value="__('SSD (Storage)')" />
                    @if (isset($items['ssd']))
                        <img class="ml-2 -translate-y-1" src="https://api.iconify.design/ic:round-check-circle-outline.svg?color=%2326cf42" width="20">
                    @endif
                </div>
                @if ($ssds)
                    <div class="w-full relative" x-data="{ open: false }">
                        <div x-on:click="open=!open" class="w-full flex items-center justify-between rounded-sm py-3 px-3 bg-dark-light text-white cursor-pointer"> <span>— Wählen Sie ein SSD aus —</span><img src="https://api.iconify.design/bx:caret-down.svg?color=%237d7d7d" alt="Caret Down"></div>
                        <div x-cloak x-transition x-show="open" class="w-full z-10 absolute top-12 rounded-md left-0 bg-dark-light p-2 text-white max-h-[200px] h-fit overflow-y-scroll">
                            @foreach ($ssds as $item)
                                <div wire:click="$set('ssd', '{{ $item->name }}')" x-on:click="open=false" class="flex items-center cursor-pointer justify-between bg-dark-light rounded-lg mb-2 p-3">
                                    <div class="flex items-center">
                                        <img src="{{ asset('/storage/'. $item->image) }}" class="max-w-[40px] mr-3 w-full" alt="">
                                        <p>{{ substr($item->name, 0, 70) }}...</p>
                                    </div>
                                    <p class="text-main">€ {{ $item->price }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <p class="text-white">Motherboards für den ssd gibt es nicht!</p>
                @endif
            </div>

            <div class="p-4 rounded-xl bg-white/10 text-white">
                <h3 class="text-lg mb-3 beyonders">Selection Summery</h3>
                @if (count($items))
                    <div class="flex flex-col w-full border-b border-white/20 mb-3">
                        @foreach ($items as $key => $item)
                            <div class="p-3 flex items-center justify-between w-full mb-3">
                                <div class="flex items-center">
                                    <img src="{{ $item['image'] }}" class="max-w-[40px]" alt="{{ $key }} image">
                                    <p class="ml-2 w-full">{{ $item['name'] }}</p>
                                </div>
                                <span class="text-main max-w-[100px] text-end w-full">€ {{ $item['price'] }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex justify-between">
                        <h3 class="text-end text-lg">Total:</h3>
                        <p class="font-semibold">€{{ number_format($total_price, 2) }}</p>
                    </div>
                @else
                    <p>Your products are not selected!</p>
                @endif
            </div>
        </main>
        {{-- <h3 class="bg-black text-white fixed bottom-3 left-3 z-10 text-3xl p-2 px-4">€ {{ number_format($total_price, 2) }}</h3> --}}
    
        @if (count($errors))
            <div class="fixed left-2 bottom-2 bg-red-600/30 border max-w-[300px] w-full border-red-600 rounded-lg z-20 p-6">

            </div>
        @endif
    
    </div>
</section>