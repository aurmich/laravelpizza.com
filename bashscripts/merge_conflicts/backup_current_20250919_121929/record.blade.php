<<<<<<< HEAD
<?php

declare(strict_types=1);

?>
=======
>>>>>>> f1d4085 (.)
@extends('xot::layouts.email')

@section('content')
<div class="record-data">
    <h2>Dati Record</h2>
    
    <table class="data-table">
        @foreach($data as $key => $value)
            <tr>
                <th>{{ ucfirst($key) }}</th>
                <td>{{ is_array($value) ? json_encode($value) : $value }}</td>
            </tr>
        @endforeach
    </table>
</div>
<<<<<<< HEAD
@endsection
=======
@endsection 
>>>>>>> f1d4085 (.)
