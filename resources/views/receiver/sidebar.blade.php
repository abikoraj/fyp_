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
            <a class="{{ request()->routeIs('receiver.donations') ? 'active' : '' }}"
                href="{{ route('receiver.donations') }}">
                <span class="button-content-wrapper ">
                    <span class="button-icon align-icon-left">
                        <i class="ph ph-hand-heart"></i>
                    </span>
                    <span class="button-text">
                        Donations
                    </span>
                </span>
            </a>
        </li>
        <li>
            <a class="{{ request()->routeIs('receiver.donations.nearme') ? 'active' : '' }}"
                href="{{ route('receiver.donations.nearme') }}">
                <span class="button-content-wrapper ">
                    <span class="button-icon align-icon-left">
                        <i class="ph ph-map-pin-line"></i>
                    </span>
                    <span class="button-text">
                        Donations Near Me
                    </span>
                </span>
            </a>
        </li>
        {{-- <li>
            <a class=""
                href="{{ route('receiver.donations.requested') }}">
                <span class="button-content-wrapper ">
                    <span class="button-icon align-icon-left">
                        <i class="ph ph-hand-palm"></i>
                    </span>
                    <span class="button-text">
                        Requested Donations
                    </span>
                </span>
            </a>
        </li>
        <li>
            <a class=""
                href="{{ route('receiver.dashboard') }}">
                <span class="button-content-wrapper ">
                    <span class="button-icon align-icon-left">
                        <i class="ph ph-hand-coins"></i>
                    </span>
                    <span class="button-text">
                        Received Donations
                    </span>
                </span>
            </a>
        </li> --}}
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
