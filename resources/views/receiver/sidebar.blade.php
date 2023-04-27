<div class="d-sidebar">
    <h3>Receiver Dashboard</h3>
    <ul class="sidebar-menu">
        <li>
            <a class="{{ request()->routeIs('receiver.dashboard') ? 'active' : '' }}"
                href="{{ route('receiver.dashboard') }}">
                <span class="button-content-wrapper ">
                    <span class="button-icon align-icon-left">
                        <i class="ph ph-stack"></i>
                    </span>
                    <span class="button-text">
                        Overview
                    </span>
                </span>
            </a>
        </li>
        <li>
            <a class="{{ request()->routeIs('profile.index') ? 'active' : '' }}"
                href="{{ route('profile.index') }}">
                <span class="button-content-wrapper ">
                    <span class="button-icon align-icon-left">
                        <i class="ph ph-user-circle"></i>
                    </span>
                    <span class="button-text">
                        Profile
                    </span>
                </span>
            </a>
        </li>
        <li>
            <a class=""
                href="{{ route('receiver.dashboard') }}">
                <span class="button-content-wrapper ">
                    <span class="button-icon align-icon-left">
                        <i class="ph ph-suitcase-simple"></i>
                    </span>
                    <span class="button-text">
                        Applied Job
                    </span>
                </span>
            </a>
        </li>
        <li>
            <a class=""
                href="{{ route('receiver.dashboard') }}">
                <span class="button-content-wrapper ">
                    <span class="button-icon align-icon-left">
                        <i class="ph ph-bookmark-simple"></i>
                    </span>
                    <span class="button-text">
                        Favorite Jobs
                    </span>
                </span>
            </a>
        </li>
        <li>
            <a class=""
                href="{{ route('receiver.dashboard') }}">
                <span class="button-content-wrapper ">
                    <span class="button-icon align-icon-left">
                        <i class="ph ph-bell-ringing"></i>
                    </span>
                    <span class="button-text">
                        Job Alert
                    </span>
                </span>
            </a>
        </li>
        <li>
            <a class=""
                href="{{ route('receiver.dashboard') }}">
                <span class="button-content-wrapper ">
                    <span class="button-icon align-icon-left">
                        <i class="ph ph-gear"></i>
                    </span>
                    <span class="button-text">
                        Settings
                    </span>
                </span>
            </a>
        </li>
        <li>
            <a class="{{ request()->routeIs('receiver.logout') ? 'active' : '' }}" href="{{ route('receiver.logout') }}">
                <span class="button-content-wrapper ">
                    <span class="button-icon align-icon-left">
                        <i class="ph ph-sign-out"></i>
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
