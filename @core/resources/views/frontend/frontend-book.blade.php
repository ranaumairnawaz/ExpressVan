@include('frontend.partials.header')
@yield('content')
<!-- load all script -->

<script src="https://maps.googleapis.com/maps/api/js?key={{ get_static_option('google_api_key') }}&callback=initAutocomplete&libraries=places&v=weekly" defer ></script>
@yield('scripts')

</body>
</html>