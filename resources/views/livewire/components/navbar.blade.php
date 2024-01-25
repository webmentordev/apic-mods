<nav class="fixed top-3 left-0 w-full z-50 530px:px-4">
    <div class="max-w-7xl m-auto px-4 py-2 rounded-full flex items-center justify-between bg-white">
        <a href="{{ route('home') }}" class="flex items-center">
            <img src="https://cdn.discordapp.com/attachments/649926592700743681/1198592559744827482/Asset_33x.png" title="Apic ModMode Logo" alt="Apic Mods Logo" width="200px">
            {{-- <img class="ml-3" src="{{ asset('images/apic_text.png') }}" title="Apic Mods Text" alt="Apic Mods Text" width="70px"> --}}
        </a>
        <ul class="flex items-center links 530px:hidden">
            <a href="#" class="ml-9">Home</a>
            <a href="{{ route('home') }}#builds" class="ml-9">Builds</a>
            <a href="#contact" class="ml-9">Contact</a>
            @auth
                <a href="{{ route('dashboard') }}" class="ml-9">Dashboard</a>
            @endauth
            <a href="https://www.facebook.com/APIC.PaYFrog.Modmode" target="_blank" title="APIC Mods Facebook" class="ml-6">
                <img width="35" src="https://api.iconify.design/ri:facebook-circle-fill.svg?color=%23316FF6" title="APIC Mods Facebook" alt="Facebook Logo">
            </a>
        </ul>
        <div class="relative hidden 530px:block" x-data="{ open: false}">
            <img src="https://api.iconify.design/charm:menu-hamburger.svg?color=%23363636" width="30" alt="Expand Icon" x-on:click="open = !open">
            <ul x-show="open" x-cloak x-transition class="bg-white absolute top-8 right-0 w-[200px] p-3 rounded-lg flex flex-col shadow-lg border border-gray-100">
                <a class="mb-3 p-2 border-b border-gray-200" href="{{ route('home') }}">Home</a>
                <a class="mb-3 p-2 border-b border-gray-200" href="{{ route('home') }}#builds">Builds</a>
                <a class="mb-3 p-2 border-b border-gray-200" href="{{ route('home') }}#contact">Contact</a>
                <a href="https://www.facebook.com/APIC.PaYFrog.Modmode" target="_blank" class="flex items-center p-2"><img width="25" src="https://api.iconify.design/ri:facebook-circle-fill.svg?color=%23316FF6" class="mr-2" title="APIC Mods Facebook" alt="Facebook Logo"> Facebook</a>
            </ul>
        </div>
    </div>
</nav>