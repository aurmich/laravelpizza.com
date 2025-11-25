<x-layouts.main>
<<<<<<< HEAD
   <x-section slug="header"/>
    {{ $slot }}
    <x-section slug="footer"/>
=======
    {{--  
    <x-ui.marketing.header />
    --}}
    {{ $_theme->headernav() }}

    {{ $slot }}

    {{ $_theme->footer() }}

>>>>>>> 90b9679 (.)
</x-layouts.main>
