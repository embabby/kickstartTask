@include('layouts.header')


@yield('body')

<script src="{{asset("jQuery/jQuery-2.1.4.min.js")}}"></script>
@include('layouts.footer')
@section('scrips')
 @include('layouts.scripts')
  @yield('page_scripts')
@show
</body>
</html>

