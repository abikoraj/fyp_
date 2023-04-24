<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/authfile/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/authfile/css/bootstrap.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/authfile/images/fav.png') }}">
    <title>@yield('title') || {{ config('app.name') }}</title>

    <style>
        .form-wrap {
            /* max-width: 800px; */
            width: auto;
            color: #7c8798;
            /* min-width: 1vh; */
            border-radius: 10px 20px !important;
        }
        .mobile-wrapper {
            width: 70%;
        }

        @media (max-width: 768px) {
            .mobile-wrapper {
                width: 100% !important;
                /* min-height: 1vh; */
                height: auto;
                margin-left: 1%;
                margin-right: 1%;
            }
        }
    </style>
</head>

<body>
    @include('layouts.toaster')

    <div class="d-flex justify-content-center align-items-center vh-100 bg-pic w-100" style="background:#F0F5F9">
        {{-- <div class="d-flex justify-content-center align-items-center vh-100 bg-pic"
        style="background:url('{{ asset('assets/images/auth-bg.jpg') }}') no-repeat center center;"> --}}
        @yield('form')
    </div>


    <script src="{{ asset('assets/authfile/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/authfile/js/bootstrap.min.js') }}"></script>
</body>

</html>
