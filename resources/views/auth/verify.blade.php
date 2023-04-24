@extends('auth.layout')
@section('title', 'Verify')
@section('form')
    <div class="row form-wrap shadow m-2">

        <div class="col-lg-12 col-md-12 bg-white">
            <div class="p-3 form-signin">
                {{-- @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show py-1 px-2 " role="alert">
                        <small>{{ session()->get('success') }}</small>
                        <button type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show py-1 px-2 " role="alert">
                        <small>{{ session()->get('error') }}</small>
                        <button type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif --}}
                <div class="text-center">
                    <img src="{{ asset('assets/authfile/images/logo.png') }}" alt="wrapkit">
                </div>
                <h2 class="mt-3 text-center">OPT Verification</h2>
                <p class="text-center">Enter OTP code to verify your phone number.</p>
                <form action="{{ route('verified') }}" method="POST" class="mt-4">
                    @csrf
                    <div class="row">
                        <div class="form-floating mb-2 p-0">
                            <input type="text" name="code" class="form-control" id="floatingInput"
                                placeholder="OTP Code" required>
                            <label for="code" class="text-muted">OTP Code</label>
                            @error('phone')<span role="alert" class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <input type="text" name="phone" hidden value="{{ $phone }}">
                        <div class="text-center p-0">
                            <button type="submit" class="w-100 btn btn-dark">Verify</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
