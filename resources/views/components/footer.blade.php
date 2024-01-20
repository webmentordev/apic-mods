<footer class="bg-white px-4 relative" id="contact">
    <img src="{{ asset('images/blob.png') }}" alt="Blog" class="top-0 left-0 w-full absolute">
    <div class="max-w-7xl m-auto">
        <div class="text-center py-[80px]">
            <div class="flex items-center m-auto w-fit mb-6">
                <img src="{{ asset('images/apic_logo.png') }}" class="max-w-[90px] w-full" alt="APIC ModMode Logo" class="mr-4">
                <img src="{{ asset('images/apic_text.png') }}" class="max-w-[120px] w-full" alt="APIC ModMode Text Logo">
            </div>
            <p>Willkommen in der innovativen Welt von APIC ModMode, wo Innovation auf Individualisierung im Bereich des PC-Baus trifft. Als führender Anbieter für maßgeschneiderte PCs widmet sich APIC ModMode der Gestaltung persönlicher Computererlebnisse, die auf Ihre individuellen Vorlieben und Anforderungen zugeschnitten sind.</p>
            <ul class="w-fit m-auto flex items-center font-semibold mt-6 links">
                <a class="mx-7" href="{{ route('home') }}">Home</a>
                <a class="mx-7" href="{{ route('home') }}#builds">Builds</a>
                <a class="mx-7" href="{{ route('home') }}">Contact</a>
            </ul>
        </div>
        <p class="py-6 border-t border-gray-200 text-center">Copyrights &copy; {{ date('Y') }} All Reserved.</p>
    </div>
</footer>