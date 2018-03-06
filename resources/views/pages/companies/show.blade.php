@extends('layouts.app')

@section('content')
    <div class="container p-b-100">
        <div class="columns is- is-marginless is-centered">
            <div class="column">
                <company company-id="{{$company_id}}"></company>
            </div>
        </div>
    </div>
@endsection
