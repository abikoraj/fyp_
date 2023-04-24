<!-- Navbar -->
<nav id="nav"
class="main-header navbar navbar-expand navbar-dark navbar-dark">
<!-- Left navbar links -->
<ul class="navbar-nav">
    <li class="nav-item">
        <a id="nav_collapse" class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item">
        <a title="{{ __('browse_website') }}" target="_blank" class="nav-link" href="{{ url('/') }}"
            class="btn btn-primary mt-4 mx-3 text-white">
            <i class="fas fa-globe fa-2"></i>
        </a>
    </li>
    <li class="nav-item">
        <a title="{{ __('clear_cache') }}" class="nav-link" href=""
            class="btn btn-primary mt-4 mx-3 text-white">
            <i class="fas fa-broom"></i>
        </a>
    </li>
</ul>
<!-- Right navbar links -->
<ul class="navbar-nav ml-auto">
    @include('admin.layouts.rightnav')
</ul>
</nav>
