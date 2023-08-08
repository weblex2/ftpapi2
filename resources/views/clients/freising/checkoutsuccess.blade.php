@extends('layouts.freisinglayout')
@section('content')
    <div class="content-wrapper bg-[#1fc8a9]">
        <div class="content flex items-center pt-5">
            <h1 class="mt-4">Willkommen bei Fair Trade Power</h1>
        </div>
    </div>
    @if ($success === true) 
        all Good
    @else    
        not good
    @endif

    <div class="content-wrapper">
        <div class="content ">
            <p class="my-5">Herzlich willkommen bei Fair Trade Power. Sie haben sich für 100% Ökostrom entschieden und damit den ersten Schritt zur Energiewende getan.</p>
            <p class="my-5">In Kürze erhalten Sie eine E-Mail mit der Bestätigung Ihres Auftrages. Den genauen Beginn der Belieferung mit unserem Ökostrom teilen wir Ihnen gesondert mit.</p>
            <p class="my-5"><strong>Wichtig: </strong>Falls Sie Ihren Vertrag bei Ihrem alten Energieanbieter selbst kündigen wollten, vergessen Sie dies bitte nicht.</p>
        </div>
    </div>

@endsection
