<div class="d-sidebar">
    <h3>Donor Dashboard</h3>
    <ul class="sidebar-menu">
        <li>
            <a class="{{ request()->routeIs('donor.dashboard') ? 'active' : '' }}"
                href="{{ route('donor.dashboard') }}">
                <span class="button-content-wrapper ">
                    <span class="button-icon align-icon-left">
                        <i class="ph-stack"></i>
                    </span>
                    <span class="button-text">
                        Overview
                    </span>
                </span>
            </a>
        </li>
        <li>
            <a class=""
                href="{{ route('donor.dashboard') }}">
                <span class="button-content-wrapper ">
                    <span class="button-icon align-icon-left">
                        <i class="ph-suitcase-simple"></i>
                    </span>
                    <span class="button-text">
                        Applied Job
                    </span>
                </span>
            </a>
        </li>
        <li>
            <a class=""
                href="{{ route('donor.dashboard') }}">
                <span class="button-content-wrapper ">
                    <span class="button-icon align-icon-left">
                        <i class="ph-bookmark-simple"></i>
                    </span>
                    <span class="button-text">
                        Favorite Jobs
                    </span>
                </span>
            </a>
        </li>
        <li>
            <a class=""
                href="{{ route('donor.dashboard') }}">
                <span class="button-content-wrapper ">
                    <span class="button-icon align-icon-left">
                        <i class="ph-bell-ringing"></i>
                    </span>
                    <span class="button-text">
                        Job Alert
                    </span>
                </span>
            </a>
        </li>
        <li>
            <a class=""
                href="{{ route('donor.dashboard') }}">
                <span class="button-content-wrapper ">
                    <span class="button-icon align-icon-left">
                        <i class="ph-gear"></i>
                    </span>
                    <span class="button-text">
                        Settings
                    </span>
                </span>
            </a>
        </li>
        <li>
            <a class="{{ request()->routeIs('donor.logout') ? 'active' : '' }}" href="{{ route('donor.logout') }}">
                <span class="button-content-wrapper ">
                    <span class="button-icon align-icon-left">
                        <i class="ph-sign-out"></i>
                    </span>
                    <span class="button-text">
                        Logout
                    </span>
                </span>
            </a>
            {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form> --}}
        </li>
    </ul>
</div>
