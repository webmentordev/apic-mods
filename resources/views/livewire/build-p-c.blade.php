<section class="w-full px-4 py-[150px] bg-dark">
    <div class="max-w-3xl m-auto pb-[150px]">
        <h2 class="mb-12 lemon_m text-center text-4xl text-white 650px:text-4xl">BUILD YOUR <span class="text-main lemon_m">CUSTOM GAMING</span> PC</h2>
        <main class="w-full">
            <div class="mb-7 w-full">
                <div class="flex items-center">
                    <x-custom-label :value="__('CPU / Processor')" />
                    @if (isset($items['processor']))
                        <div class="flex items-center mb-3">
                            <img class="ml-2" src="https://api.iconify.design/ic:round-check-circle-outline.svg?color=%2326cf42" width="20">
                            <button wire:click='removeProcessor' class="py-1 px-2 text-white bg-red-600 ml-1 inline-block text-sm rounded-md">Entfernen</button>
                        </div>
                    @endif
                </div>
                <div class="w-full relative" x-data="{ open: false }">
                    <div x-on:click="open=!open" class="w-full flex items-center justify-between rounded-sm py-3 px-3 bg-dark-light text-white cursor-pointer">
                        @if (isset($items['processor']))
                            <p class="text-main">{{ $items['processor']['name'] }}</p>
                        @else
                            <span>— Wählen Sie einen Prozessor aus —</span><img src="https://api.iconify.design/bx:caret-down.svg?color=%237d7d7d" alt="Caret Down">
                        @endif
                    </div>
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
                <div class="mb-7 w-full">
                    <div class="flex items-center">
                        <x-custom-label :value="__('Motherboard')" />
                        @if (isset($items['motherboard']))
                            <img class="ml-2 -translate-y-1" src="https://api.iconify.design/ic:round-check-circle-outline.svg?color=%2326cf42" width="20">
                        @endif
                    </div>
                    @if (count($sockets->motherboards))
                        <div class="w-full relative" x-data="{ open: false }">
                            <div x-on:click="open=!open" class="w-full flex items-center justify-between rounded-sm py-3 px-3 bg-dark-light text-white cursor-pointer">
                                @if (isset($items['motherboard']))
                                    <p class="text-main">{{ $items['motherboard']['name'] }}</p>
                                @else
                                    <span>— Wählen Sie ein Motherboard aus —</span><img src="https://api.iconify.design/bx:caret-down.svg?color=%237d7d7d" alt="Caret Down">
                                @endif
                            </div>
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
                    <div class="mb-12 w-full">
                        <div class="flex items-center">
                            <x-custom-label :value="__('Memory (RAM)')" />
                            @if (isset($items['ram']))
                                <div class="flex items-center mb-3">
                                    <img class="ml-2" src="https://api.iconify.design/ic:round-check-circle-outline.svg?color=%2326cf42" width="20">
                                    <button wire:click='removeRAM' class="py-1 px-2 text-white bg-red-600 ml-1 inline-block text-sm rounded-md">Entfernen</button>
                                </div>
                            @endif
                        </div>
                        @if (count($memories))
                            <div class="w-full relative" x-data="{ open: false }">
                                <div x-on:click="open=!open" class="w-full flex items-center justify-between rounded-sm py-3 px-3 bg-dark-light text-white cursor-pointer">
                                    @if (isset($items['ram']))
                                        <p class="text-main">{{ $items['ram']['name'] }}</p>
                                    @else
                                        <span>— Wählen Sie ein Memory aus —</span><img src="https://api.iconify.design/bx:caret-down.svg?color=%237d7d7d" alt="Caret Down">
                                    @endif
                                </div>
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

            <div class="mb-7 w-full">
                <div class="flex items-center">
                    <x-custom-label :value="__('NVME (Storage)')" />
                    @if (isset($items['nvmes']))
                        <div class="flex items-center mb-3">
                            <img class="ml-2" src="https://api.iconify.design/ic:round-check-circle-outline.svg?color=%2326cf42" width="20">
                            <button wire:click='removeNVMES' class="py-1 px-2 text-white bg-red-600 ml-1 inline-block text-sm rounded-md">Entfernen All</button>
                            <button wire:click="addNVME" class="py-1 px-2 text-white bg-blue-600 ml-1 inline-block text-sm rounded-md">hinzufügen</button>
                        </div>
                    @endif
                </div>
                @if ($nvmes)
                    @for($start = 0; $start < $nvme_count; $start++)
                        <div class="w-full relative mb-3" x-data="{ open: false }">
                            <div x-on:click="open=!open" class="w-full flex items-center justify-between rounded-sm py-3 px-3 bg-dark-light text-white cursor-pointer">
                                @if (isset($items['nvmes'][$start]))
                                    <div class="flex items-center justify-between w-full">
                                        @if ($start != 0)
                                            <p class="text-main">{{ $items['nvmes'][$start]['name'] }}</p>
                                            <button wire:click="removeNVME({{ $start }})" class="ml-4 py-1 px-2 text-white bg-red-600 inline-block text-sm rounded-md">Entfernen</button>
                                        @else
                                            <p><span class="text-main">{{ $items['nvmes'][$start]['name'] }}</span> (Primary)</p>
                                        @endif
                                    </div>
                                @else
                                    <span>— Wählen Sie ein NVME aus —</span><img src="https://api.iconify.design/bx:caret-down.svg?color=%237d7d7d" alt="Caret Down">
                                @endif
                            </div>
                            <div x-cloak x-transition x-show="open" class="w-full z-10 absolute top-12 rounded-md left-0 bg-dark-light p-2 text-white max-h-[200px] h-fit overflow-y-scroll">
                                @foreach ($nvmes as $item)
                                    <div wire:click="addNvmeToArray('{{ $start }}', '{{ $item->name }}')" x-on:click="open=false" class="flex items-center cursor-pointer justify-between bg-dark-light rounded-lg mb-2 p-3">
                                        <div class="flex items-center">
                                            <img src="{{ asset('/storage/'. $item->image) }}" class="max-w-[40px] mr-3 w-full" alt="">
                                            <p>{{ substr($item->name, 0, 70) }}...</p>
                                        </div>
                                        <p class="text-main">€ {{ $item->price }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endfor
                @else
                    <p class="text-white">Motherboards für den nvme gibt es nicht!</p>
                @endif
            </div>


            <div class="mb-7 w-full">
                <div class="flex items-center">
                    <x-custom-label :value="__('SSD (Storage)')" />
                    @if (isset($items['ssds']))
                        <div class="flex items-center mb-3">
                            <img class="ml-2" src="https://api.iconify.design/ic:round-check-circle-outline.svg?color=%2326cf42" width="20">
                            <button wire:click='removeSSDS' class="py-1 px-2 text-white bg-red-600 ml-1 inline-block text-sm rounded-md">Entfernen All</button>
                            <button wire:click="addSSD" class="py-1 px-2 text-white bg-blue-600 ml-1 inline-block text-sm rounded-md">hinzufügen</button>
                        </div>
                    @endif
                </div>
                @if ($ssds)
                    @for($start = 0; $start < $ssd_count; $start++)
                        <div class="w-full relative mb-3" x-data="{ open: false }">
                            <div x-on:click="open=!open" class="w-full flex items-center justify-between rounded-sm py-3 px-3 bg-dark-light text-white cursor-pointer">
                                @if (isset($items['ssds'][$start]))
                                    <div class="flex items-center justify-between w-full">
                                        @if ($start != 0)
                                            <p class="text-main">{{ $items['ssds'][$start]['name'] }}</p>
                                            <button wire:click="removeSSD({{ $start }})" class="ml-4 py-1 px-2 text-white bg-red-600 inline-block text-sm rounded-md">Entfernen</button>
                                        @else
                                            <p><span class="text-main">{{ $items['ssds'][$start]['name'] }}</span> (Primary)</p>
                                        @endif
                                    </div>
                                @else
                                    <span>— Wählen Sie ein SSDs aus —</span><img src="https://api.iconify.design/bx:caret-down.svg?color=%237d7d7d" alt="Caret Down">
                                @endif
                            </div>
                            <div x-cloak x-transition x-show="open" class="w-full z-10 absolute top-12 rounded-md left-0 bg-dark-light p-2 text-white max-h-[200px] h-fit overflow-y-scroll">
                                @foreach ($ssds as $item)
                                    <div wire:click="addSsdToArray('{{ $start }}', '{{ $item->name }}')" x-on:click="open=false" class="flex items-center cursor-pointer justify-between bg-dark-light rounded-lg mb-2 p-3">
                                        <div class="flex items-center">
                                            <img src="{{ asset('/storage/'. $item->image) }}" class="max-w-[40px] mr-3 w-full" alt="">
                                            <p>{{ substr($item->name, 0, 70) }}...</p>
                                        </div>
                                        <p class="text-main">€ {{ $item->price }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endfor
                @else
                    <p class="text-white">Motherboards für den SSD gibt es nicht!</p>
                @endif
            </div>


            <div class="mb-7 w-full">
                <div class="flex items-center">
                    <x-custom-label :value="__('GPU')" />
                    @if (isset($items['gpu']))
                        <div class="flex items-center mb-3">
                            <img class="ml-2" src="https://api.iconify.design/ic:round-check-circle-outline.svg?color=%2326cf42" width="20">
                            <button wire:click='removeGPU' class="py-1 px-2 text-white bg-red-600 ml-1 inline-block text-sm rounded-md">Entfernen</button>
                        </div>
                    @endif
                </div>
                <div class="w-full relative" x-data="{ open: false }">
                    <div x-on:click="open=!open" class="w-full flex items-center justify-between rounded-sm py-3 px-3 bg-dark-light text-white cursor-pointer">
                        @if (isset($items['gpu']))
                            <p class="text-main">{{ $items['gpu']['name'] }}</p>
                        @else
                            <span>— Wählen Sie einen GPU aus —</span><img src="https://api.iconify.design/bx:caret-down.svg?color=%237d7d7d" alt="Caret Down">
                        @endif
                    </div>
                    <div x-cloak x-transition x-show="open" class="w-full z-10 absolute top-12 rounded-md left-0 bg-dark-light p-2 text-white max-h-[200px] h-fit overflow-y-scroll">
                        @foreach ($gpus as $item)
                            <div wire:click="$set('gpu', '{{ $item->name }}')" x-on:click="open=false" class="flex items-center cursor-pointer justify-between bg-dark-light rounded-lg mb-2 p-3">
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


            @if ($motherboard)
                <div class="mb-7 w-full">
                    <div class="flex items-center">
                        <x-custom-label :value="__('PC Cases')" />
                        @if (isset($items['case']))
                            <div class="flex items-center mb-3">
                                <img class="ml-2" src="https://api.iconify.design/ic:round-check-circle-outline.svg?color=%2326cf42" width="20">
                                <button wire:click='removeCase' class="py-1 px-2 text-white bg-red-600 ml-1 inline-block text-sm rounded-md">Entfernen</button>
                            </div>
                        @endif
                    </div>
                    <div class="w-full relative" x-data="{ open: false }">
                        <div x-on:click="open=!open" class="w-full flex items-center justify-between rounded-sm py-3 px-3 bg-dark-light text-white cursor-pointer">
                            @if (isset($items['case']))
                                <p class="text-main">{{ $items['case']['name'] }}</p>
                            @else
                                <span>— Wählen Sie einen Case aus —</span><img src="https://api.iconify.design/bx:caret-down.svg?color=%237d7d7d" alt="Caret Down">
                            @endif
                        </div>
                        <div x-cloak x-transition x-show="open" class="w-full z-10 absolute top-12 rounded-md left-0 bg-dark-light p-2 text-white max-h-[200px] h-fit overflow-y-scroll">
                            @foreach ($cases as $item)
                                <div wire:click="$set('case', '{{ $item->name }}')" x-on:click="open=false" class="flex items-center cursor-pointer justify-between bg-dark-light rounded-lg mb-2 p-3">
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
            @endif


            <div class="mb-7 w-full">
                <div class="flex items-center">
                    <x-custom-label :value="__('Cooler Type')" />
                    @if ($coolertype)
                        <div class="flex items-center mb-3">
                            <img class="ml-2" src="https://api.iconify.design/ic:round-check-circle-outline.svg?color=%2326cf42" width="20">
                            <button wire:click='removeCooler' class="py-1 px-2 text-white bg-red-600 ml-1 inline-block text-sm rounded-md">Entfernen</button>
                        </div>
                    @endif
                </div>
                <div class="w-full relative" x-data="{ open: false }">
                    <div x-on:click="open=!open" class="w-full flex items-center justify-between rounded-sm py-3 px-3 bg-dark-light text-white cursor-pointer">
                        @if ($coolertype)
                            <p class="text-main">{{ $coolertype }}</p>
                        @else
                            <span>— Wählen Sie einen Kühlertyp —</span><img src="https://api.iconify.design/bx:caret-down.svg?color=%237d7d7d" alt="Caret Down">
                        @endif
                    </div>
                    <div x-cloak x-transition x-show="open" class="w-full z-10 absolute top-12 rounded-md left-0 bg-dark-light p-2 text-white max-h-[200px] h-fit overflow-y-scroll">
                        @foreach ($cooler_types as $item)
                            <div wire:click="$set('coolertype', '{{ $item }}')" x-on:click="open=false" class="flex items-center cursor-pointer justify-between bg-dark-light rounded-lg mb-2 p-3">
                                <p>{{ $item }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            @if ($coolertype)
                <div class="mb-7 w-full">
                    <div class="w-full relative" x-data="{ open: false }">
                        <div x-on:click="open=!open" class="w-full flex items-center justify-between rounded-sm py-3 px-3 bg-dark-light text-white cursor-pointer">
                            @if (isset($items['cooler']))
                                <p class="text-main">{{ $items['cooler']['name'] }}</p>
                            @else
                                <span>— Wählen Sie einen Cooler aus —</span><img src="https://api.iconify.design/bx:caret-down.svg?color=%237d7d7d" alt="Caret Down">
                            @endif
                        </div>
                        <div x-cloak x-transition x-show="open" class="w-full z-10 absolute top-12 rounded-md left-0 bg-dark-light p-2 text-white max-h-[200px] h-fit overflow-y-scroll">
                            @foreach ($coolers as $item)
                                <div wire:click="$set('cooler', '{{ $item->name }}')" x-on:click="open=false" class="flex items-center cursor-pointer justify-between bg-dark-light rounded-lg mb-2 p-3">
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
            @endif

            <div class="p-4 rounded-xl bg-white/10 text-white mt-[60px] inline-block w-full">
                <h3 class="text-lg mb-3 beyonders">Zusammenfassung der Auswahl</h3>
                @if (count($items))
                    <div class="flex flex-col w-full border-b border-white/20 mb-3">
                        @foreach ($items as $key => $item)
                            @if ($key == "nvmes")
                                @foreach ($item as $nvme)
                                    <div class="p-3 flex items-center justify-between w-full mb-3">
                                        <div class="flex items-center">
                                            <img src="{{ $nvme['image'] }}" class="max-w-[40px]">
                                            <p class="ml-2 w-full">{{ $nvme['name'] }}</p>
                                        </div>
                                        <span class="text-main max-w-[100px] text-end w-full">€ {{ $nvme['price'] }}</span>
                                    </div>
                                @endforeach
                            @elseif ($key == "ssds")
                                @foreach ($item as $ssd)
                                    <div class="p-3 flex items-center justify-between w-full mb-3">
                                        <div class="flex items-center">
                                            <img src="{{ $ssd['image'] }}" class="max-w-[40px]">
                                            <p class="ml-2 w-full">{{ $ssd['name'] }}</p>
                                        </div>
                                        <span class="text-main max-w-[100px] text-end w-full">€ {{ $ssd['price'] }}</span>
                                    </div>
                                @endforeach
                            @else
                                <div class="p-3 flex items-center justify-between w-full mb-3">
                                    <div class="flex items-center">
                                        <img src="{{ $item['image'] }}" class="max-w-[40px]" alt="{{ $key }} image">
                                        <p class="ml-2 w-full">{{ $item['name'] }}</p>
                                    </div>
                                    <span class="text-main max-w-[100px] text-end w-full">€ {{ $item['price'] }}</span>
                                </div>
                            @endif
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