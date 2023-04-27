@extends('layouts.app')
@section('title')
    Edit Profile
@endsection
@php
    $org_type = App\Models\OrganizationType::all();
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
            .mobile-img{
               max-width: 300px;
               display: block;
            }
        }
        @media (max-width: 310px) {
            .sidebar-open-nav{
               z-index: 1000;
            }
        }
    </style>
@endsection
@section('content')
    <div class="dashboard-wrapper">
        <div class="dashboard-right-header pt-2">
            <div class="fs-4 ft-wt-5 ps-3 justify-content-center text-muted">Edit Profile</div>
            <span class="sidebar-open-nav m-2">
                <i class="ph ph-list"></i>
            </span>
        </div>
        <div class="devider">
            <hr>
        </div>
        <div class="container d-flex justify-content-center align-items-center">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="dashboard-right">
                    <form action="{{ route('profile.update') }}" method="POST" class="mt-4" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-lg-6 rt-mb-20 col-md-6 col-sm-12">
                                <label for="">City</label><span class="form-label-required text-danger">
                                    *</span>
                                <select class="form-control py-0 @error('city_id') is-invalid @enderror" name="city_id">
                                    <option value="">Choose...</option>
                                    @foreach ($city as $city)
                                        <option value="{{ $city->id }}" {{ $city->id== $profile->city_id ? 'selected' : '' }}>{{ $city->name }}</option>
                                    @endforeach
                                </select>
                                @error('city_id')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-6 rt-mb-20 col-md-6 col-sm-12">
                                <label for=""> Orgnization Type </label><span
                                    class="form-label-required text-danger"> *</span>
                                <select class="form-control py-0 @error('city_id') is-invalid @enderror"
                                    name="organization_id">
                                    <option value="">Choose...</option>
                                    @foreach ($org_type as $org)
                                        <option value="{{ $org->id }}" {{ $org->id == $profile->organization_type_id ? 'selected': '' }}>{{ $org->name }}</option>
                                    @endforeach
                                </select>
                                @error('organization_id')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-6 rt-mb-20 col-md-6 col-sm-12">
                                <label for="">Secondary Phone</label>
                                <input value="{{ $profile->contact }}" name="contact"
                                    class="form-control @error('contact') is-invalid @enderror" type="text"
                                    placeholder="Secondary Phone">
                                @error('contact')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-6 rt-mb-20 col-md-6 col-sm-12">
                                <label for="">Email</label>
                                <input value="{{ $profile->email }}" name="email"
                                    class="form-control @error('email') is-invalid @enderror" type="email"
                                    placeholder="Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <div class="row">
                            <div class="rt-mb-20 col-lg-4 col-md-4 col-sm-12 mobile-img">
                                <label>Profile Image</label>
                                <input type="file" class="dropify" id="dropify-event" name="image"
                                    data-default-file="{{ asset($profile->image) }}">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="rt-mb-20 col-lg-8 col-md-8 col-sm-12 mobile-img">
                                <label>Cover Image</label>
                                <input type="file" class="dropify" id="dropify-event" name="cover_image" style="width: 100px;"
                                data-default-file="{{ asset($profile->cover_image) }}">
                                @error('cover_image')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="rt-mb-20 col-md-12 col-sm-12">
                            <label>Address </label> <span class="text-danger"> *</span>
                            <input value="{{ $profile->address }}" name="address"
                                class="form-control @error('address') is-invalid @enderror" type="text"
                                placeholder="Address">
                            @error('address')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
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

                            <input type="hidden" name="latitude" id="lat">
                            <input type="hidden" name="longitude" id="long">
                        </div>
                        @if (Auth::user()->role == 1)
                            <div class="rt-mb-15">
                                <div class="row">
                                    <h4 class="f-size-18 ft-wt-5 rt-mb-20 lh-1">Receiver's Type</h4>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <input class="form-check-input" type="radio" name="type" id="donor"
                                            value=1 {{ $profile->type == 1 ? 'checked': '' }}>
                                        <label class="form-check-label" for="donor">Primary Receiver</label>
                                    </div>
                                    <div class="form-check col-lg-6 col-md-6 col-sm-12 ">
                                        <input class="form-check-input" type="radio" name="type" id="receiver"
                                            value=2 {{ $profile->type == 2 ? 'checked': '' }}>
                                        <label class="form-check-label" for="inlineRadio2">Secondary Receiver</label>
                                    </div>
                                    @error('type')
                                        <span style="color: #dc3545; font-size: .875em;"
                                            role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @endif

                        <div class="post-job-item rt-mb-32">
                            <h4 class="f-size-18 ft-wt-5 rt-mb-20 lh-1">Bio</h4>
                            <div class="col-md-12">
                                <textarea id="default" class="form-control" name="bio" rows="2">{{ $profile->bio }}</textarea>
                                @error('bio')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="rt-mb-15">
                            <button type="submit" class="btn btn-primary">
                                Update Profile
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

        var latitude = {{ $profile->latitude }};
        var longitude = {{ $profile->longitude }};
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
