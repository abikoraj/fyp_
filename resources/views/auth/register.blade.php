@extends('auth.layout')
@section('title', 'Register')
@section('form')
    <div class="row form-wrap shadow mobile-wrapper">
        <div class="col-lg-6 col-md-6"
            style="background: #282828 url('{{ asset('assets/authfile/images/side.jpg') }}') no-repeat center center; background-size: cover;" >
        </div>
        <div class="col-lg-6 col-md-6 bg-white">
            <div class="p-3 form-signin">
                <div class="text-center">
                    <img src="{{ asset('assets/authfile/images/logo.png') }}" alt="wrapkit">
                </div>
                <h2 class="mt-3 text-center">Register</h2>

                <form class="mt-4" method="POST" action="{{ route('register') }}">
                    @csrf
                    {{-- @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show py-1 px-2 " role="alert">
                            <small>{{ session()->get('success') }}</small>
                            <button type="button" class="btn-close p-2" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show py-1 px-2 " role="alert">
                            <small>{{ session()->get('error') }}</small>
                            <button type="button" class="btn-close p-2" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                        <div class="form-floating mb-2 p-0 col-sm-12">
                            <input type="text" class="form-control" name="name" id="floatingInput"
                                value="{{ old('name') }}" placeholder="Enter Full Name" required>
                            <label for="floatingInput" class="text-muted">Full Name</label>
                        </div>
                        <div class="form-floating mb-2 p-0">
                            <input type="tel" class="form-control" name="phone" id="floatingInput"
                                value="{{ old('phone') }}" placeholder="Enter Phone Number" required>
                            <label for="floatingInput" class="text-muted">Phone Number</label>
                        </div>
                        <div class="form-floating mb-2 p-0">
                            <input type="password" class="form-control" name="password" id="floatingInput"
                                placeholder="Password" required>
                            <label for="floatingPassword" class="text-muted">Password</label>
                        </div>
                        <div class="form-floating mb-2 p-0">
                            <input type="password" class="form-control" name="password_confirmation"
                                id="password_confirmation" placeholder="Confirm Password" required>
                            <label for="password_confirmation" class="text-muted">Confirm Password</label>
                        </div>
                        <div class="form-floating mb-2 row py-2">
                            <div class="form-check col-lg-6 col-md-6 col-sm-12">
                                <input class="form-check-input" type="radio" name="role" id="donor" value=2>
                                <label class="form-check-label" for="donor">Donor</label>
                            </div>
                            <div class="form-check col-lg-6 col-md-6 col-sm-12">
                                <input class="form-check-input" type="radio" name="role" id="receiver" value=1>
                                <label class="form-check-label" for="inlineRadio2">Receiver</label>
                            </div>
                        </div>
                        <div class="text-center p-0">
                            <button type="submit" class="w-100 btn btn-dark">Register</button>
                        </div>

                        <div class="col-lg-12 text-center mt-5 mb-1">
                            Already have an account? <a href="{{ route('login') }}" class="text-danger">Sign In</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
