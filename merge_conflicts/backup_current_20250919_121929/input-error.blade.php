<<<<<<< HEAD
<?php

declare(strict_types=1);

?>
=======
>>>>>>> fbc8f8e (.)
@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
<<<<<<< HEAD
@endif
=======
@endif 
>>>>>>> fbc8f8e (.)
