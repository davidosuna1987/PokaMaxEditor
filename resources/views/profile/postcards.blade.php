@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="columns is- is-marginless is-centered">
      <div class="column is-10">
        <nav class="card">
          <header class="card-header">
            <p class="card-header-title">Here you have your wonderful postcards</p>
          </header>

          <div class="card-content">
            <div class="columns is-multiline">
              @if($postcards->count())
                @foreach($postcards as $postcard)
                  <div class="column is-one-quarter">
                    <div class="my-postcard-container">
                      <img src="{{$postcard->front_cropped_file_path}}" alt="Postcard front image" class="my-postcard-image">
                    </div>
                  </div>
                @endforeach
              @else
                <p class="has-message-and-button">
                  You don't have postcards yet, wanna create it one now?
                  <a href="{{route('editor')}}" class="button is-info">Let's do it!</a>
                </p>
              @endif
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection
