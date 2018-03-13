@extends('layouts.app')

@section('content')
    <div class="container p-b-100">
        <div class="columns is- is-marginless is-centered">
            <div class="column">
                <postcard-configurator company-id-prop="{{auth()->user()->isAdmin() ? '' : auth()->user()->id}}"></postcard-configurator>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah|Indie+Flower|Nanum+Pen+Script|Pacifico" rel="stylesheet">
@endpush
