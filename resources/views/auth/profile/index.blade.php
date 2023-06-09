@extends('layouts.app')
@section('title')
    Donor Dashboard
@endsection

@section('content')
    <div class="single-page-banner">
        <div class="dashboard-right-header pt-2">
            <div class="fs-4 ft-wt-5 ps-3 justify-content-center text-muted">My Profile</div>
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
                    @if ($profile->cover_image)
                        <div class="pgae-bg bgprefix-cover page-bg-radius"
                            style="background-image: url('{{ asset($profile->cover_image) }}');"></div>
                    @else
                        <div class="pgae-bg bgprefix-cover page-bg-radius"
                            style="background-image: url('{{ asset('assets/front/images/banner.jfif') }}');"></div>
                    @endif

                    <div
                        class="card jobcardStyle1 hover:bg-transparent hover-shadow:none body-24 hover:border-transparent border border-gray-50">
                        <div class="card-body">
                            <div class="rt-single-icon-box flex-column flex-lg-row">
                                <div class="icon-thumb rt-mb-lg-20 company-logo">
                                    @if ($profile->image)
                                        <img src="{{ asset($profile->image) }}" alt="Profile Image" draggable="false">
                                    @else
                                        <img src="{{ asset('assets/back/images/avatar.png') }}" alt="Profile Image"
                                            draggable="false">
                                    @endif
                                </div>
                                <div class="iconbox-content name-box">
                                    <div class="post-info2">
                                        <div class="post-main-title2">
                                            <a href="">
                                                {{ $profile->user->name }}
                                            </a>
                                            <p class="f-size-16 text-gray-600 m-0">
                                                {{ $profile->organization_type->name }}
                                                @if ($profile->type)
                                                    @if ($profile->type == 1)
                                                        - Primary Receiver
                                                    @elseif ($profile->type == 2)
                                                        - Secondary Receiver
                                                    @endif
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="edit-btn align-self-lg-center rt-pt-lg-20 flex-md-row flex-column">
                                    <div>
                                        <a href="{{ route('profile.edit', ['id' => $profile->id]) }}"
                                            class="btn btn-primary btn-sm d-block px-2 py-1 w-100">
                                            <span class="button-text"><small><i class="ph ph-pencil-simple"></i>
                                                    Edit</small></span>
                                        </a>
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
                    @if ($profile->bio)
                        <div class="body-font-1 ft-wt-5 rt-mb-20">Bio</div>
                        <div class="body-font-3 text-gray-500">
                            {!! $profile->bio !!}
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
                            <div class="row">
                                @if ($profile->organization_type_id)
                                    <div class="col-sm-6">
                                        <div class="icon-box">
                                            <div class="fs-2">
                                                <i class="ph ph-map-trifold"></i>
                                            </div>
                                            <h3 class="sub-title">Organization Type</h3>
                                            <h2 class="title">
                                                {{ $profile->organization_type->name }}
                                            </h2>
                                        </div>
                                    </div>
                                @endif
                                @if ($profile->type)
                                    <div class="col-sm-6">
                                        <div class="icon-box">
                                            <div class="fs-2">
                                                <i class="ph ph-tree-structure"></i>
                                            </div>
                                            <h3 class="sub-title">Receiver's Type</h3>
                                            <h2 class="title">
                                                @if ($profile->type == 1)
                                                    Primary Receiver
                                                @elseif ($profile->type == 2)
                                                    Secondary Receiver
                                                @endif
                                            </h2>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- contact information  START -->
                        <div class="sidebar-widget">
                            <div class="contact">
                                <h2 class="title">
                                    Contact Information
                                </h2>

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

    @if (Auth::user()->role == 2)
    <hr class="hr-0">
    <section class="related-jobs-area rt-pt-50" id="open_position">
        <div class="recently-applied-wrap d-flex justify-content-between align-items-center rt-mb-15">
            <h3 class="f-size-16">Recent Donation</h3>
            <a class="view-all text-gray-500 f-size-16 d-flex align-items-center" href="{{ route('donation.mydonation') }}">
                View All
                <i class="ph ph-arrow-right f-size-20 rt-ml-8"></i>
            </a>
        </div>
        <div class="db-job-card-table">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Posted</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Expires At</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($latest_donation->count() > 0)
                        @foreach ($latest_donation as $donation)
                            <tr>
                                <td>
                                    <div class="iconbox-content">
                                        <div class="post-info2">
                                            <div class="post-main-title">
                                                <a href="" class="text-gray-900 f-size-16  ft-wt-5">
                                                    {{ $donation->name }}
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        {{ $donation->created_at->diffForHumans() }}
                                    </div>
                                </td>
                                <td>
                                    <div class="text-success-500 ft-wt-5 d-flex align-items-center">
                                        {{ \App\Helper::getStatus()[$donation->status] }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        {{ $donation->quantity }} {{ \App\Helper::getUnit()[$donation->unit] }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        {{ $donation->expires_at }}
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
    </section>
    <div class="rt-spacer-75 rt-spacer-md-30"></div>
    @endif

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

        var latitude = {{ $profile->latitude }};
        var longitude = {{ $profile->longitude }};
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
