@extends('admin.layouts.app')
@section('title')
    Donation Details
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">
                            Donation Details
                        </h3>
                        <a href="{{ url()->previous() }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                            <i class="fas fa-arrow-left"></i>
                            &nbsp; Back
                        </a>
                    </div>
                    <div class="row m-2">
                        <div class="col-md-4">
                            <img src="{{ asset($donation->image ?? 'assets/front/images/default.jpg') }}" alt="image"
                                class="image-fluid" width="350px">
                        </div>
                        <div class="col-md-8">
                            <table id="datatable-responsive"
                                class="ml-1 table table-striped     table-bordered dt-responsive nowrap" cellspacing="0"
                                width="100%">
                                <tbody>
                                    <tr class="mb-5">
                                        <th width="30%">Food Name</th>
                                        <td width="80%">{{ $donation->name }}</td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="30%">Food Category</th>
                                        <td width="80%">{{ $donation->food_category->name ?? '' }}</td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="30%">Quantity</th>
                                        <td width="70%">{{ $donation->quantity }} {{ $donation->quantity }}
                                            {{ \App\Helper::getUnit()[$donation->unit] }}</td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="30%">Status</th>
                                        <td width="70%">{{ \App\Helper::getStatus()[$donation->status] }}</td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="30%">Description</th>
                                        <td width="70%">{!! $donation->desc ?? '' !!}</td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="30%">Prepared At</th>
                                        <td width="70%">{{ $donation->prepared_at ?? '' }}</td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="30%">Expires At</th>
                                        <td width="70%">{{ $donation->expires_at }}</td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="30%">City</th>
                                        <td width="70%">{{ $donation->city->name ?? '' }}</td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="30%">Address</th>
                                        <td width="70%">{{ $donation->address ?? '' }}</td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="30%">Donor</th>
                                        <td width="70%"><a href="{{ route('user.detail', $donation->user_id) }}" class="">{{ $donation->user->name }}</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">
                            Location
                        </h3>
                    </div>
                    <div class="card-body">
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
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/esri-leaflet@2.1.2/dist/esri-leaflet.js"></script>

    <script>
        var map;

        var latitude = {{ $donation->latitude ?? 0 }};
        var longitude = {{ $donation->longitude ?? 0 }};
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
