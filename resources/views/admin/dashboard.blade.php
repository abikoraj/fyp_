@extends('admin.layouts.app')
@section('title')
    Admin Dashboard
@endsection
@section('content')
    <div class="row">
        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Receivers</span>
                    <span class="info-box-number">{{ $receiver_count }}</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('Total Donors') }}</span>
                    <span class="info-box-number">{{ $donor_count }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user-check"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Verified Users</span>
                    <span class="info-box-number">{{ $user_count }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-times"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Unverified Users</span>
                    <span class="info-box-number">{{ $unverified_count }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-hand-holding-heart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('Active Donations') }}</span>
                    <span class="info-box-number">{{ $active_count }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-hand-holding-heart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('Wasted Donations') }}</span>
                    <span class="info-box-number">{{ $wasted_count }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-hand-holding-heart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('Pending Donations') }}</span>
                    <span class="info-box-number">{{ $pending_count }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-hand-holding-heart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('All Donations') }}</span>
                    <span class="info-box-number">{{ $donation_count }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class=" d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Latest Users</h3>
                        <div class="d-flex justify-content-center align-items-center">
                            <a href="{{ route('receiver.list') }}" class="btn btn-info mr-1">View All Receiver</a>
                            <a href="{{ route('donor.list') }}" class="btn btn-success">View All Donor</a>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Created Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($users->count() > 0)
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="text-muted">
                                                {{ $user->name }}
                                            </td>
                                            <td class="text-muted">
                                                {{ $user->phone }}
                                            </td>
                                            <td class="text-muted">
                                                @if ($user->role == 1)
                                                    <span class="badge badge-info">
                                                        {{-- {{ ucfirst($user->role) }} --}}
                                                        Receiver
                                                    </span>
                                                @else
                                                    <span class="badge badge-success">
                                                        Donor
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center" tabindex="0">
                                                {{ $user->phone_verified_at ?? '' }}
                                            </td>
                                            <td class="text-muted">
                                                {{ $user->created_at->diffForHumans() }}
                                            </td>
                                            <td class="d-flex">
                                                <a href="{{ route('user.detail', $user->id) }}"
                                                    class="btn bg-primary mr-1">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                {{-- <a href="{{ $user->role == 'company' ? route('company.show', $user->company->id) : route('candidate.show', $user->candidate->id) }}"
                                                    class="btn bg-primary mr-1">
                                                    <i class="fas fa-eye"></i>
                                                </a> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="text-center">
                                        <td colspan="7">
                                            <div class="empty py-5">
                                                no_data_found
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
