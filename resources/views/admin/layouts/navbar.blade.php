<!-- Navbar -->
<nav id="nav" class="main-header navbar navbar-expand navbar-dark navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a id="" class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                    class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-center align-items-center" data-widget="fullscreen" href="#"
                role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

        <li class="nav-item user-menu">
            <a href="" class="nav-link">
                <img src="{{ asset('assets/back/images/avatar.png') }}" class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
            </a>
        </li>
    </ul>
</nav>

{{-- <script>
    var isNavCollapse = JSON.parse(localStorage.getItem("sidebar_collapse"))
    isNavCollapse ? $('body').addClass('sidebar-collapse') : null;

    $('#nav_collapse').on('click', function() {
        localStorage.setItem("sidebar_collapse", isNavCollapse == true ? false : true);
    });
</script> --}}
