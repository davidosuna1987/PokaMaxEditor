@extends('layouts.app')

@section('content')
    <div class="container p-b-100">
        <div class="columns is- is-marginless is-centered">
            <div class="column is-10">
                <p class="title is-3 has-text-info">Your postcards</p>
                <postcards postcards-prop="{{$postcards}}"></postcards>
            </div>
        </div>
    </div>
@endsection
