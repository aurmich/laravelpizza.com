<<<<<<< HEAD
<?php

declare(strict_types=1);

?>
=======
>>>>>>> e1b0bf9 (.)
<div>
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <button type="button" class="btn btn-primary" wire:click="try()">TRY !</button>
</div>
