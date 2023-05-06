@extends('layouts.app')
@section('title')
    Receiver Dashboard
@endsection
@section('content')
    <div class="dashboard-right pt-0">
        <div class="dashboard-right-header pt-2">
            <div class="fs-4 ft-wt-5 ps-3 justify-content-center text-muted">Dashboard</div>
            <span class="sidebar-open-nav m-2">
                <i class="ph ph-list"></i>
            </span>
        </div>
        <div class="devider">
            <hr>
        </div>
        <div class="row">
            @include('layouts.userCounter')
        </div>
        <div class="row">
            <h3 class="f-size-16">Donations</h3>
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="single-feature-box bg-success-50">
                    <div class="single-feature-data">
                        <h6>{{ $active_count }}</h6>
                        <p>Active Donation</p>
                    </div>
                    <div class="single-feature-icon">
                        <i class="ph ph-circle-wavy-check text-success-500"></i>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="single-feature-box bg-warning-50">
                    <div class="single-feature-data">
                        <h6>{{ $success_count }}</h6>
                        <p>Completed Donations</p>
                    </div>
                    <div class="single-feature-icon">
                        <i class="ph ph-hand-heart text-warning-500"></i>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="single-feature-box bg-danger-50">
                    <div class="single-feature-data">
                        <h6>{{ $wasted_count }}</h6>
                        <p>Wasted Donations</p>
                    </div>
                    <div class="single-feature-icon">
                        <i class="ph ph-x-circle text-danger-500"></i>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="single-feature-box">
                    <div class="single-feature-data">
                        <h6>{{ $donation_count }}</h6>
                        <p>Total Donations</p>
                    </div>
                    <div class="single-feature-icon">
                        <i class="ph ph-hand-coins text-primary-500"></i>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

