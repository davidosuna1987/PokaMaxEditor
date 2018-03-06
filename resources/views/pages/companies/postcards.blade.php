@extends('layouts.app')

@section('content')
    <div class="container p-b-100">
        <div class="columns is- is-marginless is-centered">
            <div class="column">
                <postcards company-prop="{{$company}}"></postcards>
            </div>
        </div>
    </div>
@endsection
