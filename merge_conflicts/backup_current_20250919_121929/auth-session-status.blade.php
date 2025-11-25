<<<<<<< HEAD
<?php

declare(strict_types=1);

?>
=======
>>>>>>> fbc8f8e (.)
@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600']) }}>
        {{ $status }}
    </div>
<<<<<<< HEAD
@endif
=======
@endif 
>>>>>>> fbc8f8e (.)
