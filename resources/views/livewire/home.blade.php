<main class="w-full">
    <header class="h-screen bg-cover bg-center relative px-4 w-full flex items-center justify-center" style="background-image: url({{ asset('images/header_apic.png') }})">
        <div class="absolute top-0 left-0 w-full h-full bg-black/50 backdrop-blur-sm"></div>
        <div class="w-full text-white relative z-10 max-w-6xl 620px:text-center">
            {{-- <img data-aos="fade-up" src="{{ asset('images/processor.webp') }}" alt="APIC Logo" class="m-auto max-w-[400px] w-full"> --}}
            <h2 data-aos="fade-up" data-aos-duration="1000" class="font-bold text-7xl uppercase mb-4 620px:text-5xl 480px:text-4xl"><span class="text-4xl">Welcome to</span> <br> <span class="text-main">APICMODMODE</span></h2>
            <p class="text-lg 480px:text-base pl-5 max-w-3xl w-full border-l border-main py-4 620px:px-0 620px:border-none" data-aos="fade-up" data-aos-duration="1200">APIC Modmode crafts bespoke computing experiences, blending cutting-edge technology with artistic design. Elevate your gaming or professional setup with our meticulously tailored custom PC builds. At APIC Modmode, we redefine performance and aesthetics, delivering a seamless fusion of power and style. Unleash your imagination; let APIC Modmode bring your dream PC to life</p>
            <a data-aos="fade-up" data-aos-duration="1500" href="https://www.facebook.com/APIC.PaYFrog.Modmode" target="_blank" title="APIC ModMode Facebook" class="mt-6 font-semibold  rounded-md inline-block bg-main text-dark py-3 px-4">Build Your PC</a>
        </div>
    </header>


    @if (count($packages))
        <section class="w-full px-4 py-[150px] bg-center bg-cover bg-dark">
            {{-- style="background-image: url({{ asset('images/header_banner.webp') }})" --}}
            <div class="max-w-7xl m-auto py-5">
                <h2 class="mb-12 bebas text-center text-7xl text-white 530px:text-4xl">OUR <span class="text-main bebas">CUSTOM PC</span> BUILD PACKAGES</h2>
                <div class="max-w-7xl m-auto grid grid-cols-5 gap-3 text-white 1110px:grid-cols-4 890px:grid-cols-3 750px:grid-cols-2 530px:grid-cols-1">
                    
                    @foreach ($packages as $package)
                        <div data-aos="fade-up" class="bg-dark-light h-full flex justify-between flex-col p-6 rounded-lg text-center transition-all hover:translate-y-6">
                            <div>
                                <h3 class="bebas text-5xl mb-3 w-full border-b pb-2 border-white/10">{{ $package->title }}</h3>
                                <span class="text-white/80 font-semibold uppercase">{{ $package->category }}</span>
                                <p class="mb-12 mt-6">{{ $package->description }}</p>
                            </div>
                            <a href="#" class="bg-main p-3 px-6 w-full rounded-lg text-dark font-semibold">STARTING AT €{{ number_format($package->price, 2) }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="w-full px-4 py-[150px] bg-dark-light">
        <div class="max-w-6xl m-auto py-5">
            <h2 class="mb-12 bebas text-center text-7xl text-white 650px:text-4xl">BEST <span class="text-main bebas">VALUE</span> CUSTOM GAMING PC</h2>
            <div class="grid grid-cols-2 gap-8 900px:flex flex-col" data-aos="fade-up">
                <img class="rounded-lg 900px:order-2" src="{{ asset('images/games_grid-1.png') }}" title="Games Grid" alt="Games Grid">
                <div class="flex items-center 900px:order-1">
                    <div class="px-4 py-4">
                        <h3 class="font-bold uppercase text-3xl mb-6 text-white">Highest <span class="text-main bebas">FPS</span> Per EURO 💸</h3>
                        <p class="text-white/80">Get the highest FPS per euro by building a gaming PC from APIC. We focus on quality and customer care. Our goal is to set gaming standards worldwide. Utilize our Custom PC Builder for Highly optimized PC.</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-8 mt-[60px] 900px:flex flex-col" data-aos="fade-up">
                <div class="flex items-center">
                    <div class="px-4 py-4">
                        <h3 class="font-bold uppercase text-3xl mb-6 text-white">Professional Builders With <span class="text-main bebas">World Class</span> Customer Support</h3>
                        <p class="text-white/80 mb-4">Builds by professional PC builders. The builders are experts in the field with more than 5 years of experience.</p>
                        <p class="text-white/80 mb-4">Build your custom PC in Germany from APIC</p>
                        <p class="text-white/80">Evert Gaming PC from APIC includes professional cable management and world-class customer support. We belive in quality and build PCs with love and care so that you have the best gaming experience ever.</p>
                    </div>
                </div>
                <img class="rounded-lg" src="{{ asset('images/games_grid-2.png') }}" title="Games Grid" alt="Games Grid">
            </div>
        </div>
    </section>


    <section class="w-full px-4 py-[150px] bg-dark">
        <div class="max-w-6xl m-auto py-5">
            <h2 class="mb-12 bebas text-center text-7xl text-white 650px:text-5xl">WE WORK WITH ONLY <span class="text-main bebas">BEST BRANDS</span></h2>
            <img data-aos="fade-up" class="m-auto w-full max-w-3xl" src="{{ asset('images/brand_logos.png') }}" title="Brands Logo" alt="Brands Logo">
            <div class="grid grid-cols-3 gap-6 mt-12 890px:grid-cols-2 530px:grid-cols-1">
                <div data-aos="fade-up" class="bg-dark-light border hover:border-main hover:transition-all border-white/20 text-white h-full flex justify-between flex-col p-6 rounded-lg text-center transition-all hover:translate-y-6">
                    <img src="https://api.iconify.design/twemoji:shield.svg?color=%23ffffff" class="m-auto mb-4" alt="Shield icon" width="60">
                    <h3 class="bebas text-3xl mb-3 w-full border-b pb-2 border-white/10">10 MONTHS WARRANTY</h3>
                    <p class="pb-5 pt-3">Every Gaming Pc from APIC includes 10 months of local warranty for your peace of mind.</p>
                </div>

                <div data-aos="fade-up" data-aos-duration="1000" class="bg-dark-light border hover:border-main hover:transition-all border-white/20 text-white h-full flex justify-between flex-col p-6 rounded-lg text-center transition-all hover:translate-y-6">
                    <img src="https://api.iconify.design/twemoji:delivery-truck.svg?color=%23ffffff" class="m-auto mb-4" alt="Shield icon" width="60">
                    <h3 class="bebas text-3xl mb-3 w-full border-b pb-2 border-white/10">FAST SERVICE</h3>
                    <p class="pb-5 pt-3">Fast pace service at APIC. We deliver all over the world. Assembly time is 3-4 days and 2-3 days for shipping.</p>
                </div>

                <div data-aos="fade-up" data-aos-duration="2000" class="bg-dark-light border hover:border-main hover:transition-all border-white/20 text-white h-full flex justify-between flex-col p-6 rounded-lg text-center transition-all hover:translate-y-6">
                    <img src="https://api.iconify.design/material-symbols:battery-charging-full.svg?color=%2310da54" class="m-auto mb-4" alt="Shield icon" width="60">
                    <h3 class="bebas text-3xl mb-3 w-full border-b pb-2 border-white/10">100% GENUINE PRODUCTS</h3>
                    <p class="pb-5 pt-3">At APIC quality comes first. We only work with trusted brands, and deal in genuine products.</p>
                </div>
            </div>
        </div>
    </section>

    @if (count($categories))
        <section class="w-full px-4 py-[150px] bg-dark-light" id="builds">
            <h2 class="mb-12 bebas text-center text-7xl text-white 650px:text-5xl" title="APIC PC Custom Builds">OUR <span class="text-main bebas">CUSTOM</span> PC BUILDS</h2>
            <div class="m-auto max-w-6xl flex flex-col">
                @foreach ($categories as $category)
                    <div class="w-full text-center text-white">
                        <h3 class="font-bold text-4xl mb-2">{{ $category->title }}</h3>
                        <p class="max-w-3xl m-auto mb-2">{{ $category->detail }}</p>
                        @foreach($category->images as $index => $image)
                            <div class="grid grid-cols-4 gap-6 ">
                                <img src="{{ asset('/storage/'. $image->image) }}" title="APIC ModMode PC Builds {{ $index }}" alt="APIC ModMode PC Builds {{ $index }}">
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    <x-content-list />
</main>