<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') || {{ config('app.name') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/authfile/images/fav.png') }}">

    <link rel="stylesheet" href="{{ asset('assets/front/css/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/app.min.css') }}">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @yield('css')
</head>

<body>
    @include('layouts.header')

    <div class="dashboard-wrapper">
        <div class="container" style="min-height: 70vh;">
            <div class="row">
                <div class="col-lg-3">
                    @if (Auth::user()->role == 1)
                    @include('receiver.sidebar')
                    @elseif (Auth::user()->role == 2)
                    @include('donor.sidebar')
                    @endif
                </div>
                @include('layouts.toaster')

                <div class="col-lg-9">
                    @yield('content')
                </div>
            </div>
        </div>
        <div class="dashboard-footer text-center body-font-4 text-gray-500" style="max-height: 20vh;">
            @include('layouts.footer')
        </div>
    </div>


    <script src="{{ asset('assets/front/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/app.min.js') }}"></script>
    {{-- <script src="https://unpkg.com/phosphor-icons"></script> --}}
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"
        integrity="sha512-zYXldzJsDrNKV+odAwFYiDXV2Cy37cwizT+NkuiPGsa9X1dOz04eHvUWVuxaJ299GvcJT31ug2zO4itXBjFx4w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        @yield('script')



</body>

</html>
