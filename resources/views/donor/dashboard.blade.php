@extends('layouts.app')
@section('title')
    Donor Dashboard
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
            @include('layouts.donationCounter')
        </div>
        <div class="recently-applied-wrap d-flex justify-content-between align-items-center rt-mb-15">
            <h3 class="f-size-16">My Recent Donations</h3>
            <a class="view-all text-gray-500 f-size-16 d-flex align-items-center" href="">
                View All
                <i class="ph ph-arrow-right f-size-20 rt-ml-8"></i>
            </a>
        </div>
        <div class="db-job-card-table">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Quantity</th>
                        <th>Expires At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($all->count() > 0)
                        @foreach ($all as $all)
                            <tr>
                                <td>
                                    <div class="iconbox-content">
                                        <div class="post-info2">
                                            <div class="post-main-title">
                                                <a href="{{ route('donation.details', $all->id) }}"
                                                    class="text-gray-900 f-size-16  ft-wt-5">
                                                    {{ $all->name }}
                                                </a>
                                            </div>
                                            <div class="body-font-4 text-gray-600 pt-2">
                                                <span class="info-tools rt-mr-8">
                                                    {{-- {{ ucfirst($job->job_type->name) }} --}}
                                                    {{ $all->created_at->diffForHumans() }}
                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-success-500 ft-wt-5 d-flex align-items-center">
                                        <i class="ph-check-circle f-size-18 mt-1 rt-mr-4"></i>
                                        {{ \App\Helper::getStatus()[$all->status] }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="ph-users f-size-20 rt-mr-4"></i>
                                        {{ $all->quantity }} {{ \App\Helper::getUnit()[$all->unit] }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="ph-users f-size-20 rt-mr-4"></i>
                                        {{ $all->expires_at }}
                                    </div>
                                </td>
                                <td>
                                    <div class="db-job-btn-wrap d-flex justify-content-end">

                                        <button type="button" class="btn bg-gray-50 text-primary-500" id="dropdownMenuButton5"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ph ph-dots-three-outline-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end company-dashboard-dropdown"
                                            aria-labelledby="dropdownMenuButton5">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('donation.details', $all->id) }}">
                                                    View Details
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        @include('layouts.notfound')
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
