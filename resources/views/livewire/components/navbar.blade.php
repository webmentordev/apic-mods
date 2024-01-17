<nav class="fixed top-3 left-0 w-full z-50">
    <div class="max-w-7xl m-auto px-4 py-2 rounded-full flex items-center justify-between bg-white">
        <a href="{{ route('home') }}" class="flex items-center">
            <img src="{{ asset('images/apic_logo.png') }}" title="Apic Mods Logo" alt="Apic Mods Logo" width="50px">
            <img class="ml-3" src="{{ asset('images/apic_text.png') }}" title="Apic Mods Text" alt="Apic Mods Text" width="70px">
        </a>
        <ul class="flex items-center font-semibold links">
            <a href="#" class="ml-9">Home</a>
            <a href="{{ route('home') }}#builds" class="ml-9">Builds</a>
            <a href="#" class="ml-9">Contact</a>
            <a href="https://www.facebook.com/APIC.PaYFrog.Modmode" target="_blank" title="APIC Mods Facebook" class="ml-6">
                <img width="35" src="https://api.iconify.design/ri:facebook-circle-fill.svg?color=%23316FF6" title="APIC Mods Facebook" alt="Facebook Logo">
            </a>
        </ul>
    </div>
</nav>