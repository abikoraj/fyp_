@extends('layouts.app')
@section('title')
    Donation Detail
@endsection

@section('content')
    <div class="single-page-banner">
        <div class="dashboard-right-header pt-2">
            <div class="fs-4 ft-wt-5 ps-3 justify-content-center text-muted">Donation Detail</div>
            <span class="sidebar-open-nav m-2">
                <i class="ph ph-list"></i>
            </span>
        </div>
        <div class="devider">
            <hr>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div
                        class="card jobcardStyle1 bg-transparent border-transparent hover:bg-transparent hover-shadow:none body-0 m-0">
                        <div class="card-body">
                            <div class="rt-single-icon-box  flex-wrap">
                                <a href="" class="icon-thumb rt-mb-10 rt-mb-lg-20">
                                    @if ($donation->image)
                                        <img src="{{ asset($donation->image) }}" alt="" draggable="false">
                                    @else
                                        <img src="{{ asset('assets/front/images/default.jpg') }}" alt=""
                                            draggable="false">
                                    @endif
                                </a>
                                <div class="iconbox-content">
                                    <div class="post-info2">
                                        <div class="post-main-title2">
                                            <a href="#">{{ Str::limit($donation->name, 36, '...') }}</a>
                                            <span class="info-tools text-gray-600"
                                                style="font-size: 0.9rem;">{{ $donation->created_at->diffForHumans() }}</span>
                                            @switch($donation->status)
                                                @case(0)
                                                    <span class="badge rounded-pill bg-primary text-white">Fresh</span>
                                                @break

                                                @case(1)
                                                    <span class="badge rounded-pill bg-secondary text-white">Interested</span>
                                                @break

                                                @case(2)
                                                    <span class="badge rounded-pill bg-warning text-white">Expired</span>
                                                @break

                                                @case(3)
                                                    <span class="badge rounded-pill bg-danger text-white">Wasted</span>
                                                @break

                                                @case(4)
                                                    <span class="badge rounded-pill bg-light text-dark text-muted">Completed</span>
                                                @break

                                                @default
                                                    <span class="badge rounded-pill bg-light text-dark">Unknown</span>
                                            @endswitch
                                        </div>
                                        <div class="body-font-3 text-gray-600 pt-2">
                                            @if ($donation->contact)
                                                <a class="info-tools" href="tel:{{ $donation->contact }}">
                                                    <span><i class="ph ph-phone text-primary-500"></i></span>
                                                    <span class="text-gray-600">{{ $donation->contact }}</span>
                                                </a>
                                            @endif
                                            @if ($profile->email)
                                                <a class="info-tools" href="mailto:{{ $profile->email }}">
                                                    <span><i class="ph ph-envelope-simple text-primary-500"></i></span>
                                                    <span class="text-gray-600">{{ $profile->email }}</span>
                                                </a>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="iconbox-extra align-self-center flex-md-row flex-column">

                                    <div>
                                        <span class="d-block rt-pt-10 text-lg-end text-start f-size-14 text-gray-700 ">
                                            Expires At:
                                            <span class="text-danger-500">
                                                {{ $donation->expires_at }}
                                            </span>
                                        </span>
                                        @if (Auth::user()->role == 1)
                                            @if ($donation->status == 0 && Auth::user()->profile->type == 1)
                                                <form action="{{ route('receiver.donation.request', $donation->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button class="btn btn-primary btn-lg d-block" type="submit"
                                                        onclick="return confirm('Are you sure you want to request for this donation?');">
                                                        <span class="button-content-wrapper ">
                                                            <span class="button-text">Request</span>
                                                        </span>
                                                    </button>
                                                </form>
                                            @endif
                                            @if ($donation->status == 2 && Auth::user()->profile->type == 2)
                                                <form action="{{ route('receiver.donation.request', $donation->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button class="btn btn-primary btn-lg d-block" type="submit"
                                                        onclick="return confirm('Are you sure you want to request for this donation?');">
                                                        <span class="button-content-wrapper ">
                                                            <span class="button-text">Request</span>
                                                        </span>
                                                    </button>
                                                </form>
                                            @endif
                                        @endif
                                        @if ($donation->receiver_id)
                                            @if ($donation->status == 1 && $donation->receiver_id == Auth::user()->id)
                                                <form action="{{ route('receiver.donation.cancel', $donation->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button class="btn btn-danger btn-lg d-block" type="submit"
                                                        onclick="return confirm('Are you sure you want to cancel your request?');">
                                                        <span class="button-content-wrapper ">
                                                            <span class="button-text">Cancel Request</span>
                                                        </span>
                                                    </button>
                                                </form>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="single-job-content rt-pt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 rt-mb-lg-30">
                    <div class="p-32 border border-2 border-primary-50 rt-rounded-12 rt-mb-24 lg:max-536">
                        <div class="body-font-1 ft-wt-5 rt-mb-32 ">Donation Overview</div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-4 rt-mb-32">
                                <div class="single-jSidebarWidget">
                                    <div class="iconbox-content">
                                        <div class="f-size-12 text-gray-500 uppercase text-uppercase rt-mb-6">
                                            Quantity
                                        </div>
                                        <span class="d-block f-size-14 ft-wt-5 text-gray-900">
                                            {{ $donation->quantity }} {{ \App\Helper::getUnit()[$donation->unit] }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-4 rt-mb-32">
                                <div class="single-jSidebarWidget">
                                    <div class="iconbox-content">
                                        <div class="f-size-12 text-gray-500 uppercase text-uppercase rt-mb-6">
                                            Food Category
                                        </div>
                                        <span class="d-block f-size-14 ft-wt-5 text-gray-900">
                                            {{ $donation->food_category->name }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-4 rt-mb-32">
                                <div class="single-jSidebarWidget">
                                    <div class="iconbox-content">
                                        <div class="f-size-12 text-gray-500 uppercase text-uppercase rt-mb-6">
                                            Prepared At
                                        </div>
                                        <span class="d-block f-size-14 ft-wt-5 text-gray-900">
                                            {{ $donation->prepared_at }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-4 rt-mb-32">
                                <div class="single-jSidebarWidget">
                                    <div class="iconbox-content">
                                        <div class="f-size-12 text-gray-500 uppercase text-uppercase rt-mb-6">
                                            Expires At
                                        </div>
                                        <span class="d-block f-size-14 ft-wt-5 text-gray-900">
                                            {{ $donation->expires_at }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-4 rt-mb-32">
                            <div class="single-jSidebarWidget">
                                <div class="iconbox-content">
                                    <div class="f-size-12 text-gray-500 uppercase text-uppercase rt-mb-6">
                                        City
                                    </div>
                                    <span class="d-block f-size-14 ft-wt-5 text-gray-900">
                                        {{ $donation->address }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($donation->desc)
                        <div class="body-font-1 ft-wt-5 rt-mb-20">Description</div>
                        <div class="body-font-3 text-gray-500">
                            {!! $donation->desc !!}
                            {{-- Bio goes here --}}
                        </div>
                        <div class="devider">
                            <hr>
                        </div>
                    @endif
                    <div class="body-font-1 ft-wt-5 rt-mb-20">Location</div>
                    <div class="body-font-3 text-gray-500">
                        <style>
                            #map {
                                height: 300px;
                            }

                            @media (max-width: 767px) {
                                #map {
                                    /* width: 100%; */
                                    height: 300px;
                                }
                            }
                        </style>
                        <div id="map"></div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="cadidate-details-sidebar">
                        <div class="sidebar-widget">
                            <div class="contact">
                                <h2 class="title">
                                    Donor Information
                                </h2>
                                <div class="rt-single-icon-box rt-mb-32">
                                    <a href="{{ route('user.profile.details', $profile->id) }}"class="icon-thumb rt-mr-16">
                                        @if ($profile->image)
                                            <img src="{{ asset($profile->image) }}" alt="">
                                        @else
                                            <img src="{{ asset('assets/back/images/avatar.png') }}" alt="">
                                        @endif
                                    </a>
                                    <div class="iconbox-content">
                                        <a href="{{ route('user.profile.details', $profile->id) }}"
                                            class="f-size-20 text-gray-900 ft-wt-5 rt-mb-6">{{ $profile->user->name }}
                                        </a>
                                    </div>
                                </div>

                                <div class="contact-icon-box">
                                    <div class="fs-2">
                                        <i class="ph ph-map-trifold"></i>
                                    </div>
                                    <div class="info">
                                        <h3 class="subtitle">Organization Type</h3>
                                        <h2 class="title">{{ $profile->organization_type->name }}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="devider">
                                <hr>
                            </div>
                            {{-- </div>
                        <div class="sidebar-widget"> --}}
                            <div class="contact">
                                <h2 class="title">
                                    Contact Details
                                </h2>
                                {{-- <div class="devider">
                                    <hr>
                                </div> --}}

                                <div class="contact-icon-box">
                                    <div class="fs-2">
                                        <i class="ph ph-buildings"></i>
                                    </div>
                                    <div class="info">
                                        <h3 class="subtitle">City</h3>
                                        <h2 class="title">{{ $profile->city->name }}</h2>
                                    </div>
                                </div>
                                <div class="devider">
                                    <hr>
                                </div>
                                {{-- @endif --}}
                                <div class="contact-icon-box">
                                    <div class="fs-2">
                                        <i class="ph ph-map-pin"></i>
                                    </div>
                                    <div class="info">
                                        <h3 class="subtitle">Address</h3>
                                        <h2 class="title">
                                            {{ $profile->address }}
                                        </h2>
                                    </div>
                                </div>

                                <div class="collapse" id="contact-more-collapse">
                                    <div class="devider">
                                        <hr>
                                    </div>
                                    <div class="contact-icon-box">
                                        <div class="fs-2">
                                            <i class="ph ph-phone"></i>
                                        </div>
                                        <div class="info">
                                            <h3 class="subtitle">Phone Number</h3>
                                            <h2 class="title">{{ $profile->user->phone }}</h2>
                                        </div>
                                    </div>
                                    <div class="devider">
                                        <hr>
                                    </div>
                                    @if ($profile->contact)
                                        <div class="contact-icon-box">
                                            <div class="fs-2">
                                                <i class="ph ph-phone-call"></i>
                                            </div>
                                            <div class="info">
                                                <h3 class="subtitle">Secondary Phone</h3>
                                                <h2 class="title">{{ $profile->contact }}</h2>
                                            </div>
                                        </div>
                                        <div class="devider">
                                            <hr>
                                        </div>
                                    @endif
                                    @if ($profile->email)
                                        <div class="contact-icon-box">
                                            <div class="fs-2">
                                                <i class="ph ph-envelope"></i>
                                            </div>
                                            <div class="info">
                                                <h3 class="subtitle">Email</h3>
                                                <h2 class="title">{{ $profile->email }}</h2>
                                            </div>
                                        </div>
                                        {{-- <div class="devider">
                                            <hr>
                                        </div> --}}
                                    @endif
                                </div>
                            </div>
                            <div id="show-more" data-bs-toggle="collapse" data-bs-target="#contact-more-collapse"
                                aria-expanded="false" aria-controls="contact-more-collapse"
                                class="mt-2 rounded show-more">
                                Show Contact Information
                            </div>
                        </div>
                        <!-- contact information END -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="rt-spacer-100 rt-spacer-md-50"></div>
@endsection
@section('css')
    <style>
        .show-more {
            font-size: 14px;
            padding: 6px;
            cursor: pointer;
            opacity: 0.7;
        }

        @media (max-width: 767px) {
            .name-box {
                text-align: center;
            }

            .edit-btn {
                width: 100% !important;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
@endsection

@section('script')
    <script>
        $('#show-more').on('click', function() {
            var value = $(this).attr('aria-expanded');
            if (value == 'true') {
                $('#show-more').html('Hide information');
            } else {
                $('#show-more').html('Show Contact Information');
            }
        })
    </script>
    {{-- Jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/esri-leaflet@2.1.2/dist/esri-leaflet.js"></script>

    <script>
        var map;

        var latitude = {{ $donation->latitude }};
        var longitude = {{ $donation->longitude }};
        console.log(latitude, longitude);

        var latlng = L.latLng(latitude, longitude);
        map = L.map('map').setView(latlng, 15);
        map.setView(latlng, 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
        }).addTo(map);
        addMarker(latlng);


        function addMarker(latlng) {
            var marker = L.marker(latlng, {
                draggable: false
            }).addTo(map);

            // var popupContent = "<button onclick='removeMarker(" + (markers.length - 1) + ")'>Remove Marker</button>";
            // marker.bindPopup(popupContent);
            marker.on('dragend', function(e) {
                console.log(e.target.getLatLng());
            });
        }
    </script>
@endsection
