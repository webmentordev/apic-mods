@props(['text' => ''])
<section class="fixed bottom-3 max-w-[300px] w-full left-3 p-6 rounded-lg bg-black text-white flex items-center shadow-lg z-30">
    <img src="https://api.iconify.design/mdi:checkbox-outline.svg?color=%231ecc41" width="50" alt="Spinner">
    <p class="ml-4 text-lg price font-semibold">{{ $text }}</p>
</section>