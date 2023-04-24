<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') || {{ config('app.name') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/authfile/images/fav.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/back/css/combined.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <div class="wrapper">

        @include('admin.layouts.navbar')

        @include('admin.layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @include('layouts.toaster')

            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    @yield('breadcrumbs')
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <!-- Main Footer -->
        @include('admin.layouts.footer')
    </div>

    <script>
        // Navbar Collapse Toggle
        var isNavCollapse = JSON.parse(localStorage.getItem("sidebar_collapse"))
        isNavCollapse ? $('body').addClass('sidebar-collapse') : null;

        $('#nav_collapse').on('click', function() {
            localStorage.setItem("sidebar_collapse", isNavCollapse == true ? false : true);
        });
    </script>
</body>

</html>
