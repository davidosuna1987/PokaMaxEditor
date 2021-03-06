@extends('layouts.app')

@section('content')
    <div class="container p-b-100">
        <div class="columns is- is-marginless is-centered">
            <div class="column is-10">
                <p class="title is-3 has-text-info">{{$company->address->company}} postcards</p>
                <postcards company-prop="{{$company}}" postcards-prop="{{$postcards}}"></postcards>
            </div>
        </div>
    </div>
@endsection
