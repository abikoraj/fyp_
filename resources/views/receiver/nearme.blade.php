@extends('layouts.app')
@section('title')
    Donations Near Me
@endsection
@section('content')
    <div class="dashboard-right">
        <div class="dashboard-right-header">
            <div class="left-text">
                <h5>Donations Near Me</h5>
            </div>
            <span class="sidebar-open-nav">
                <i class="ph ph-list"></i>
            </span>
        </div>
        @include('donation.list')
    </div>
@endsection

