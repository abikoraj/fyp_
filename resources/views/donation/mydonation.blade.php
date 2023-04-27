@extends('layouts.app')
@section('title')
    My Donations
@endsection
@section('css')
    <style>
        .icon{
            font-size: 1.5rem !important;
        }
    </style>
@endsection
@section('content')
    <div class="dashboard-right pt-0">
        <div class="dashboard-right-header pt-2">
            <div class="fs-4 ft-wt-5 ps-3 justify-content-center text-muted">My Donations</div>
            <span class="sidebar-open-nav m-2">
                <i class="ph ph-list"></i>
            </span>
        </div>
        <div class="devider">
            <hr>
        </div>
        <div class="cadidate-dashboard-tabs">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button
                        class="nav-link {{ !session('type') || session('type') == 'personal' ? 'active' : '' }}"
                        id="pills-personal-tab" data-bs-toggle="pill" data-bs-target="#pills-personal"
                        type="button" role="tab" aria-controls="pills-personal" aria-selected="true">
                        <i class="ph ph-list-bullets" style="font-size: 1.5rem;"></i>&nbsp; All Donations

                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ session('type') == 'profile' ? 'active' : '' }}"
                        id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                        type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                        <i class="ph ph-check-square-offset" style="font-size: 1.5rem;"></i>&nbsp; Active Donations
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ session('type') == 'social' ? 'active' : '' }}"
                        id="pills-social-tab" data-bs-toggle="pill" data-bs-target="#pills-social"
                        type="button" role="tab" aria-controls="pills-social" aria-selected="false">
                        <i class="ph ph-lock" style="font-size: 1.5rem;"></i>&nbsp; Closed Donations

                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button
                        class="nav-link {{ session('type') == 'account' || session('type') == 'password' || session('type') == 'account-delete' || session('type') == 'contact' ? 'active' : '' }} @error('password') active @enderror"
                        id="pills-setting-tab" data-bs-toggle="pill" data-bs-target="#pills-setting"
                        type="button" role="tab" aria-controls="pills-setting" aria-selected="false">
                        <i class="ph ph-eye-slash" style="font-size: 1.5rem;"></i>&nbsp; Hidden Donations
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade {{ session('type') == 'personal' ? 'show active' : '' }} {{ (session('type') ? false : true) ? 'show active' : '' }}"
                    id="pills-personal" role="tabpanel" aria-labelledby="pills-personal-tab">
                    <div class="db-job-card-table">
                        @include('donation.partials.all')
                    </div>
                </div>
                <div class="tab-pane fade {{ session('type') == 'profile' ? 'show active' : '' }}"
                    id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="db-job-card-table">
                        @include('donation.partials.active')
                    </div>
                </div>
                <div class="tab-pane fade {{ session('type') == 'social' ? 'show active' : '' }}"
                    id="pills-social" role="tabpanel" aria-labelledby="pills-social-tab">
                    <div class="db-job-card-table">
                        @include('donation.partials.closed')
                    </div>
                </div>
                <div class="tab-pane fade {{ session('type') == 'account' || session('type') == 'password' || session('type') == 'account-delete' || session('type') == 'contact' ? 'show active' : '' }} @error('password') show active @enderror"
                    id="pills-setting" role="tabpanel" aria-labelledby="pills-setting-tab">
                    <div class="db-job-card-table">
                        @include('donation.partials.hidden')
                    </div>
                </div>
            </div>
        </div>

        <div class="rt-pt-30">
            {{-- @if ($myJobs->total() > $myJobs->count())
                <nav>
                    {{ $myJobs->links('vendor.pagination.frontend') }}
                </nav>
            @endif --}}
        </div>
    </div>
@endsection
