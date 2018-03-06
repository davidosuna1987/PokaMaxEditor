<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

@if(auth()->user())
  <script>
    jQuery(document).ready(function($) {
      if( !localStorage.getItem('user') ){
        localStorage.setItem('user', JSON.stringify({!!auth()->user()->load('role')!!}));
      }
    });
  </script>
@endif
