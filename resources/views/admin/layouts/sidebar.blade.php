<aside id="sidebar" class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset('assets/authfile/images/fav.png') }}" alt="{{ __('logo') }}" class="elevation-3">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-nav-wrapper">
            <!-- Sidebar Menu -->
            <nav class="sidebar-main-nav mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}"
                            class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('city.index') }}"
                            class="nav-link {{ Route::is('city.index') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-map-marker-alt"></i>
                            <p>Cities</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('org-type.index') }}"
                            class="nav-link {{ Route::is('org-type.index') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-industry"></i>
                            <p>Organization Type</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('food-cat.index') }}"
                            class="nav-link {{ Route::is('food-cat.index') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>Food Category</p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="javascript:void(0)" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Users<i class="right fas fa-angle-down"></i></p>
                        </a>
                        <ul class="collapse">
                            <li class="nav-item">
                                <a href="{{ route('donor.list') }}"
                                    class="nav-link {{ Route::is('donor.list') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user-friends"></i>
                                    <p>Donors</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('receiver.list') }}"
                                    class="nav-link {{ Route::is('receiver.list') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user-friends"></i>
                                    <p>Receiver</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('unverified.list') }}"
                                    class="nav-link {{ Route::is('unverified.list') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user-times"></i>
                                    <p>Unverified Users</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="javascript:void(0)" class="nav-link">
                            <i class="nav-icon fas fa-hand-holding-heart"></i>
                            <p>Donations<i class="right fas fa-angle-down"></i></p>
                        </a>
                        <ul class="collapse">
                            <li class="nav-item">
                                <a href="{{ route('admin.donation.pending') }}"
                                    class="nav-link {{ Route::is('admin.donation.pending') ? 'active' : '' }}">
                                    <i class="nav-icon far fa-hourglass"></i>
                                    <p>Pending</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.donation.approved') }}"
                                    class="nav-link {{ Route::is('admin.donation.approved') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-check"></i>
                                    <p>Approved</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.donation.rejected') }}"
                                    class="nav-link {{ Route::is('admin.donation.rejected') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-ban"></i>
                                    <p>Rejected</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.donation.hidden') }}"
                                    class="nav-link {{ Route::is('admin.donation.hidden') ? 'active' : '' }}">
                                    <i class="nav-icon far fa-eye-slash"></i>
                                    <p>Hidden</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </nav>
            <!-- Sidebar Menu -->
            <nav class="mt-2 nav-footer pt-3 border-top border-secondary">
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" role="menu"
                    data-accordion="false">
                    {{-- <li class="nav-item">
                        <a target="_blank" href="/" class="nav-link text-light">
                            <i class="nav-icon fas fa-globe"></i>
                            <p>Visit Website</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a target="_blank" href="/" class="nav-link text-light">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>Settings</p>
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a href="{{ route('admin.logout') }}" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- /.sidebar -->
</aside>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
    integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $('.nav-item.has-treeview > a').click(function() {
            $(this).siblings('ul').slideToggle();
            $(this).find('i.right').toggleClass('fa-angle-up fa-angle-down');
        });
    });
</script>
