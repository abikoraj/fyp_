@extends('admin.layouts.app')
@section('title')
    Donation List
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title line-height-36">Rejected Donations</h3>
                        </div>
                    </div>

                    {{-- Table  --}}
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                    <th>Donor</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if ($donations->count() > 0)
                                    @foreach ($donations as $donation)
                                        <tr>
                                            <td class="text-center" tabindex="0">
                                                {{ $loop->index + 1 }}
                                            </td>
                                            <td class="text-center" tabindex="0">
                                                <img src="{{ asset($donation->image ?? 'assets/front/images/default.jpg') }}"
                                                    class="rounded" width="50px" alt="image">
                                            </td>
                                            <td class="text-center" tabindex="0">
                                                <a href="{{ route('admin.donation.details', $donation->id) }}" class="">
                                                    {{ $donation->name }}
                                                </a>
                                            </td>
                                            <td class="text-center" tabindex="0">
                                                {{ $donation->quantity }} {{ \App\Helper::getUnit()[$donation->unit] }}
                                            </td>
                                            <td class="text-center" tabindex="0">
                                                {{ \App\Helper::getStatus()[$donation->status] }}
                                            </td>
                                            <td class="text-center" tabindex="0">
                                                {{ $donation->user->name }}
                                            </td>

                                            <td class="text-center">

                                                <a href="{{ route('admin.donation.details', $donation->id) }}"
                                                    class="btn bg-info ml-1"><i class="fas fa-eye"></i></a>

                                                <form action="{{ route('admin.donation.hide', $donation->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    <button
                                                        onclick="return confirm('Are you sure you want to hide this donation?');"
                                                        class="btn bg-danger"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="8">
                                            No Data Found
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
