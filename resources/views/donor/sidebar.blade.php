<div class="d-sidebar">
    <h3>Donor Dashboard</h3>
    <ul class="sidebar-menu">
        <li>
            <a class="{{ request()->routeIs('donor.dashboard') ? 'active' : '' }}"
                href="{{ route('donor.dashboard') }}">
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
            <a class="{{ request()->routeIs('donation.add') ? 'active' : '' }}"
                href="{{ route('donation.add') }}">
                <span class="button-content-wrapper ">
                    <span class="button-icon align-icon-left">
                        <i class="ph ph-circles-three-plus"></i>
                    </span>
                    <span class="button-text">
                        Make Donation
                    </span>
                </span>
            </a>
        </li>
        <li>
            <a class="{{ request()->routeIs('donation.mydonation') ? 'active' : '' }}"
                href="{{ route('donation.mydonation') }}">
                <span class="button-content-wrapper ">
                    <span class="button-icon align-icon-left">
                        <i class="ph ph-hand-coins"></i>
                    </span>
                    <span class="button-text">
                        My Donations
                    </span>
                </span>
            </a>
        </li>
        {{-- <li>
            <a class=""
                href="{{ route('donor.dashboard') }}">
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
                href="{{ route('donor.dashboard') }}">
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
                href="{{ route('donor.dashboard') }}">
                <span class="button-content-wrapper ">
                    <span class="button-icon align-icon-left">
                        <i class="ph ph-gear"></i>
                    </span>
                    <span class="button-text">
                        Settings
                    </span>
                </span>
            </a>
        </li> --}}
        <li>
            <a class="{{ request()->routeIs('donor.logout') ? 'active' : '' }}" href="{{ route('donor.logout') }}">
                <span class="button-content-wrapper ">
                    <span class="button-icon align-icon-left">
                        <i class="ph ph-sign-out"></i>
                    </span>
                    <span class="button-text">
                        Logout
                    </span>
                </span>
            </a>

        </li>
    </ul>
</div>
