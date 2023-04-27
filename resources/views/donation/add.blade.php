@extends('layouts.app')
@section('title')
    Make Donation
@endsection
@php
    $food_cat = App\Models\FoodCategory::all();
    $city = App\Models\City::all();
@endphp
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/dropify/css/dropify.min.css') }}">

    <style>
        .ck-editor__editable_inline {
            min-height: 100px;
        }

        .mymap {
            border-radius: 12px;
        }

        .mt-n-11 {
            margin-top: -11px;
        }

        @media (max-width: 768px) {
            .ck-file-dialog-button {
                display: none !important;
            }

            .ck-dropdown {
                display: none !important;
            }

            .ck-disabled {
                display: none !important;
            }
        }
    </style>
@endsection
@section('content')
    <div class="dashboard-wrapper ">
        <div class="dashboard-right-header pt-2">
            <div class="fs-4 ft-wt-5 ps-3 justify-content-center text-muted">Make Donation</div>
            <span class="sidebar-open-nav m-2">
                <i class="ph ph-list"></i>
            </span>
        </div>
        <div class="devider">
            <hr>
        </div>
        <div class="container d-flex justify-content-center align-items-center px-0">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="dashboard-right pt-0">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('donation.submit') }}" method="POST" class="mt-4" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-lg-6 rt-mb-20 col-md-6 col-sm-12">
                                <label for="">City</label><span class="form-label-required text-danger">
                                    *</span>
                                <select class="form-control py-0 @error('city_id') is-invalid @enderror" name="city_id">
                                    <option value="">Choose...</option>
                                    @foreach ($city as $city)
                                        <option value="{{ $city->id }}" {{ $city->id== Auth::user()->profile->city_id ? 'selected' : '' }}>{{ $city->name }}</option>
                                    @endforeach
                                </select>
                                @error('city_id')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-6 rt-mb-20 col-md-6 col-sm-12">
                                <label for=""> Food Category </label><span class="form-label-required text-danger">
                                    *</span>
                                <select class="form-control py-0 @error('food_category_id') is-invalid @enderror"
                                    name="food_category_id">
                                    <option value="">Choose...</option>
                                    @foreach ($food_cat as $fcat)
                                        <option value="{{ $fcat->id }}">{{ $fcat->name }}</option>
                                    @endforeach
                                </select>
                                @error('food_category_id')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-12 rt-mb-20 col-md-12 col-sm-12 row" style="padding-right: 0;">
                                <div class="col-lg-4 col-md-6 col-sm-12 rt-mb-20">
                                    <label>Image</label>
                                    <input type="file" class="dropify" id="dropify-event" name="image">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-8 col-md-6 col-sm-12" style="padding-right: 0;">
                                    <div class="rt-mb-10 col-md-12 col-sm-12">
                                        <label for="">Food Name</label> <span class="text-danger"> *</span>
                                        <input value="{{ old('name') }}" name="name"
                                            class="form-control @error('name') is-invalid @enderror" type="text"
                                            placeholder="Food Name">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="rt-mb-10 col-md-12 col-sm-12 row">
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <label for="">Quantity</label> <span class="text-danger"> *</span>
                                            <input value="{{ old('quantity') }}" name="quantity" type="text"
                                                class="form-control @error('quantity') is-invalid @enderror"
                                                placeholder="Quantity">
                                            @error('quantity')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4" style="padding-right: 0;">
                                            <label for="">Unit</label> <span class="text-danger"> *</span>
                                            <select class="form-control py-0 @error('unit') is-invalid @enderror"
                                                name="unit">
                                                <option value=""></option>
                                                @foreach (\App\Helper::getUnit() as $key => $unit)
                                                    <option value="{{ $key }}">{{ $unit }}</option>
                                                @endforeach
                                            </select>
                                            @error('unit')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="rt-mb-10 col-md-12 col-sm-12 row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label for="">Prepared At</label> <span class="text-danger"> *</span>
                                            <input value="{{ old('prepared_at') }}" name="prepared_at"
                                                type="datetime-local"
                                                class="form-control @error('prepared_at') is-invalid @enderror"
                                                placeholder="Prepared At" max="{{ \Carbon\Carbon::now('Asia/Kathmandu')->format('Y-m-d\TH:i') }}">
                                            @error('prepared_at')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12" style="padding-right: 0;">
                                            <label for="">Expires At</label> <span class="text-danger"> *</span>
                                            <input value="{{ old('expires_at') }}" name="expires_at" type="datetime-local"
                                                class=" @error('expires_at') is-invalid @enderror" placeholder="Expires At"
                                                min="{{ \Carbon\Carbon::now('Asia/Kathmandu')->format('Y-m-d\TH:i') }}">
                                                @php

                                                    // dd(now()->timezone('Asia/Kathmandu')->format('Y-m-d\TH:i'));
                                                @endphp
                                            @error('expires_at')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="rt-mb-10 col-lg-6 col-md-6 col-sm-12">
                                <label>Address </label><span class="text-danger"> *</span>
                                <input value="{{ Auth::user()->profile->address }}" name="address"
                                    class="form-control @error('address') is-invalid @enderror" type="text"
                                    placeholder="Address">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="rt-mb-10 col-lg-6 col-md-6 col-sm-12">
                                <label>Contact </label><span class="text-danger"> *</span>
                                @if (Auth::user()->profile->contact)
                                    <input value="{{ Auth::user()->profile->contact }}" name="contact"
                                        class="form-control @error('contact') is-invalid @enderror" type="text"
                                        placeholder="Contact">
                                @else
                                    <input value="{{ Auth::user()->phone }}" name="contact"
                                        class="form-control @error('contact') is-invalid @enderror" type="text"
                                        placeholder="contact">
                                @endif
                                @error('contact')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="post-job-item rt-mb-32">
                                <h4 class="f-size-18 ft-wt-5 rt-mb-20 lh-1">Description</h4>
                                <div class="col-md-12">
                                    <textarea id="default" class="form-control" name="bio" rows="2"></textarea>
                                    @error('bio')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="post-job-item rt-mb-15 col-lg-12 col-md-12 col-sm-12">
                            <h4 class="f-size-18 ft-wt-5 rt-mb-20 lh-1">
                                Location <span class="text-danger">*</span>
                                <small class="h6">
                                    (Drag the marker to adjust)
                                </small>
                            </h4>

                            <div class="col-lg-12 col-md-12 col-sm-12 rt-mb-24">
                                <style>
                                    #map {
                                        min-width: 100%;
                                        height: 500px;
                                    }

                                    @media (max-width: 767px) {
                                        #map {
                                            width: 100%;
                                            height: 300px;
                                        }
                                    }
                                </style>
                                <div id="map"></div>
                            </div>

                            <input type="hidden" name="latitude" id="lat" value="{{ Auth::user()->profile->latitude }}">
                            <input type="hidden" name="longitude" id="long" value="{{ Auth::user()->profile->longitude }}">
                        </div>

                        <div class="rt-mb-15">
                            <button type="submit" class="btn btn-primary">
                                Make Donaion
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {{-- Jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- CKEditor --}}
    <script src="{{ asset('assets/front/js/ckeditor.min.js') }}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#default'))
            .catch(error => {
                console.error(error);
            });
    </script>

    {{-- Leaflet - For map --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/esri-leaflet@2.1.2/dist/esri-leaflet.js"></script>

    {{-- Dropify --}}
    <script src="{{ asset('assets/dropify/js/dropify.min.js') }}"></script>
    <script>
        $('.dropify').dropify();
    </script>

    <script>
        var map;

        var latitude = {{ Auth::user()->profile->latitude }};
        var longitude = {{ Auth::user()->profile->longitude }};
        console.log(latitude, longitude);

        // navigator.geolocation.getCurrentPosition(function(location) {
        //     var latlng = L.latLng(location.coords.latitude, location.coords.longitude);
        //     map = L.map('map').setView(latlng, 15);
        //     map.setView(latlng, 13);
        //     L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        //         attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
        //     }).addTo(map);
        //     addMarker(latlng);
        // });
        var latlng = L.latLng(latitude, longitude);
        map = L.map('map').setView(latlng, 15);
        map.setView(latlng, 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
        }).addTo(map);
        addMarker(latlng);


        function addMarker(latlng) {
            var marker = L.marker(latlng, {
                draggable: true
            }).addTo(map);

            // document.getElementById('lat').value = latlng.lat;
            // document.getElementById('long').value = latlng.lng;
            // var popupContent = "<button onclick='removeMarker(" + (markers.length - 1) + ")'>Remove Marker</button>";
            // marker.bindPopup(popupContent);
            marker.on('dragend', function(e) {
                console.log(e.target.getLatLng());
                document.getElementById('lat').value = e.target.getLatLng().lat;
                document.getElementById('long').value = e.target.getLatLng().lng;
            });
        }
    </script>
@endsection
