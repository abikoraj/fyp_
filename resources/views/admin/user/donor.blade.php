@extends('admin.layouts.app')
@section('title')
    Donor List
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title line-height-36">Donor List</h3>
                        </div>
                    </div>

                    {{-- Table  --}}
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Organization Type</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if ($users->count() > 0)
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="text-center" tabindex="0">
                                                <img src="{{ asset($user->profile->image ?? 'assets/back/images/avatar.png') }}"
                                                    class="rounded" width="50px" alt="image">
                                            </td>
                                            <td class="text-center" tabindex="0">
                                                <a href="{{ route('user.detail', $user->id) }}" class="">
                                                    {{ $user->name }}
                                                </a>
                                            </td>
                                            <td class="text-center" tabindex="0">
                                                {{ $user->phone }}
                                            </td>
                                            <td class="text-center" tabindex="0">
                                                {{ $user->profile->address ?? '' }}
                                            </td>
                                            <td class="text-center" tabindex="0">
                                                {{ $user->profile->organization_type->name ?? '' }}
                                            </td>

                                            <td class="text-center">

                                                <a href="{{ route('user.detail', $user->id) }}" class="btn bg-primary"><i class="fas fa-eye"></i>
                                                </a>

                                                {{-- <a href="" class="btn bg-info"><i class="fas fa-edit"></i>
                                                </a> --}}

                                                <form action="{{ route('user.delete', $user->id) }}" method="GET"
                                                    class="d-inline">

                                                    @csrf
                                                    <button
                                                        onclick="return confirm('Are you sure you want to delete this item?');"
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
