@extends('admin.layouts.app')
@section('title')
    Food Category
@endsection

@section('content')
<div class="container-fluid">
    {{-- @include('layouts.toaster') --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title line-height-36">Create New</h3>
                    </div>
                </div>
                {{-- @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show py-1 px-2 " role="alert">
                        <span>{{ session()->get('success') }}</span>
                        <button type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show py-1 px-2 " role="alert">
                        <span>{{ session()->get('error') }}</span>
                        <button type="button" class="btn-close p-2" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif --}}
                <form id="formSubmit" action="{{ route('food-cat.submit') }}" method="POST">
                    @csrf
                    <div class="card-body border-bottom row">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <label>Food Category <span class="form-label-required text-danger">*</span></label>
                            <input name="name" type="text" placeholder="Food Category" class="form-control" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <button type="submit" class="btn btn-success offset-sm-2">
                                <i class="fas fa-plus"></i>
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title line-height-36">Food Categories</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Food Category</th>
                                <th>State</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (App\Models\FoodCategory::all() as $foodCat)
                                <tr>
                                    <form id="formSubmit" action="{{ route('food-cat.update', ['foodCat'=> $foodCat->id]) }}" method="POST">
                                        @csrf
                                        <td>{{ $foodCat->id }}</td>
                                        <td>
                                            <input name="name" type="text" placeholder="Organization Type"
                                                class="form-control" value="{{ $foodCat->name }}" required>
                                        </td>
                                        <td>
                                            <input type="submit" class=" btn btn-primary" value="Update">
                                            <a href="{{ route('food-cat.delete', $foodCat->id) }}" class="btn btn-danger">
                                                Delete</a>
                                        </td>
                                    </form>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
