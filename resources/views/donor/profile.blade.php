@extends('layouts.app')
@section('title')
    Donor Dashboard
@endsection
@php
    $user = Auth::user();
@endphp
@section('content')
    {{-- <div class="dashboard-right"> --}}
        {{-- <div class="breadcrumbs breadcrumbs-height">
            <div class="container">
                <div class="breadcrumb-menu">
                    <h6 class="f-size-18 m-0">Profile</h6>
                    <ul>
                        <li><a href="{{ route('donor.dashboard') }}">{{ __('home') }}</a></li>
                        <li>/</li>
                        <li>{{ $user->name }}</li>
                    </ul>
                </div>
            </div>
        </div> --}}
        <div class="single-page-banner">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="pgae-bg bgprefix-cover page-bg-radius"
                            style="background-image: url('{{ asset('assets/front/images/banner.jfif') }}');"></div>
                        {{-- <div class="pgae-bg bgprefix-cover page-bg-radius"
                            style="background-image: url('{{ $user->company->banner_url }}');"></div> --}}
                        <div
                            class="card jobcardStyle1 hover:bg-transparent hover-shadow:none body-24 hover:border-transparent border border-gray-50">
                            <div class="card-body">
                                <div class="rt-single-icon-box flex-column flex-lg-row">
                                    <div class="icon-thumb rt-mb-lg-20 company-logo">
                                        {{-- <img src="{{ $user->company->logo_url }}" alt="" draggable="false"> --}}
                                        <img src="{{ asset('assets/back/images/avatar.png') }}" alt=""
                                            draggable="false">
                                    </div>
                                    <div class="iconbox-content">
                                        <div class="post-info2">
                                            <div class="post-main-title2">
                                                <a href="">
                                                    {{ $user->name }}
                                                </a>
                                                {{-- @if ($companyDetails->industry) --}}
                                                <p class="f-size-16 text-gray-600 m-0">
                                                    Organization Type</p>
                                                {{-- @endif --}}
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="iconbox-extra align-self-start align-self-lg-center rt-pt-lg-20 flex-md-row flex-column">
                                        <div class="max-311">
                                            <a href="#open_position" type="button" class="btn btn-primary btn-lg d-block">
                                                <span class="button-content-wrapper ">
                                                    <span class="button-icon align-icon-right">
                                                        <i class="ph-arrow-right"></i>
                                                    </span>
                                                    <span class="button-text">
                                                        {{ __('open_position') }}
                                                    </span>
                                                </span>
                                            </a>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Single job content Area-->
        <div class="single-job-content rt-pt-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 rt-mb-lg-30">
                        <div class="body-font-1 ft-wt-5 rt-mb-20">{{ __('company_description') }}</div>
                        <div class="body-font-3 text-gray-500">
                            {{-- {!! $user->company->bio !!} --}}
                            Bio goes here
                        </div>
                        {{-- <div class="share-job rt-pt-50">
                            <ul class="rt-list gap-8">
                                <li class="d-inline-block body-font-3">
                                    {{ __('share_this_profile') }}:
                                </li>
                                <li class="d-inline-block ms-3">
                                    <a href="{{ socialMediaShareLinks(url()->current(), 'facebook') }}">
                                        <button class="btn btn-outline-plain hover-fb">
                                            <span class="f-size-18 text-primary-500">
                                                <x-svg.facebook-icon width="1em" height="1em" />
                                            </span>
                                            <span class="text-primary-500">{{ __('facebook') }}</span>
                                        </button>
                                    </a>
                                </li>
                                <li class="d-inline-block">
                                    <a href="{{ socialMediaShareLinks(url()->current(), 'twitter') }}">
                                        <button class="btn btn-outline-plain hover-tw">
                                            <span class="f-size-18 text-twitter">
                                                <x-svg.twitter-icon width="1em" height="1em" />
                                            </span>
                                            <span class="text-twitter">{{ __('twitter') }}</span>
                                        </button>
                                    </a>
                                </li>
                                <li class="d-inline-block">
                                    <a href="{{ socialMediaShareLinks(url()->current(), 'pinterest') }}">
                                        <button class="btn btn-outline-plain hover-pin">
                                            <span class="f-size-18 text-pinterest me-1">
                                                <x-svg.pinterest-icon />
                                            </span>
                                            <span class="text-pinterest">{{ __('pinterest') }}</span>
                                        </button>
                                    </a>
                                </li>
                            </ul>
                        </div> --}}
                    </div>
                    <div class="col-lg-5">
                        <div class="cadidate-details-sidebar">
                            {{-- @if ($user->company->establishment_date || $companyDetails->organization || $companyDetails->team_size)
                                <div class="sidebar-widget">
                                    <div class="row">
                                        @if ($user->company->establishment_date)
                                            <div class="col-sm-6">
                                                <div class="icon-box">
                                                    <div class="icon-img">
                                                        <x-svg.birth-date-icon />
                                                    </div>
                                                    <h3 class="sub-title">{{ __('founded_in') }}</h3>
                                                    <h2 class="title">
                                                        {{ date('j F, Y', strtotime($user->company->establishment_date)) }}
                                                    </h2>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($companyDetails->organization)
                                            <div class="col-sm-6">
                                                <div class="icon-box">
                                                    <div class="icon-img">
                                                        <x-svg.fold-icon />
                                                    </div>
                                                    <h3 class="sub-title">{{ __('organization_type') }}</h3>
                                                    <h2 class="title">
                                                        {{ $companyDetails->organization ? ucfirst($companyDetails->organization->name) : '' }}
                                                    </h2>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($companyDetails->team_size)
                                            <div class="col-sm-6">
                                                <div class="icon-box">
                                                    <div class="icon-img">
                                                        <x-svg.board-icon />
                                                    </div>
                                                    <h3 class="sub-title">{{ __('company_size') }}</h3>
                                                    <h2 class="title">
                                                        {{ $companyDetails->team_size ? $companyDetails->team_size->name : '' }}
                                                    </h2>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif --}}
                            <!-- contact information  START -->
                            <div class="sidebar-widget">
                                <div class="contact">
                                    <h2 class="title">
                                        {{ __('contact_information') }}
                                    </h2>
                                    {{-- @if ($user->company->website) --}}
                                    <div class="contact-icon-box">
                                        <div class="icon-img">
                                            {{-- <x-svg.globe-icon /> --}} Icon
                                        </div>
                                        <div class="info">
                                            <h3 class="subtitle">{{ __('website') }}</h3>
                                            <h2 class="title">www.example.com</h2>
                                        </div>
                                    </div>
                                    <div class="devider">
                                        <hr>
                                    </div>
                                    {{-- @endif --}}
                                    <div class="contact-icon-box">
                                        <div class="icon-img">
                                            {{-- <x-svg.location2-icon /> --}}Icon
                                        </div>
                                        <div class="info">
                                            <h3 class="subtitle">{{ __('location') }}</h3>
                                            <h2 class="title">
                                                {{-- {{ $user->company->full_address }} --}}
                                                Rajbanshi Tole, Biratnagar, Nepal
                                            </h2>
                                        </div>
                                    </div>
                                    {{-- @auth --}}
                                    <div class="collapse" id="contact-more-collapse">
                                        {{-- @if ($user->contactInfo->phone) --}}
                                        <div class="devider">
                                            <hr>
                                        </div>
                                        <div class="contact-icon-box">
                                            <div class="icon-img">
                                                {{-- <x-svg.telephone-icon /> --}}Icon
                                            </div>
                                            <div class="info">
                                                <h3 class="subtitle">{{ __('phone') }}</h3>
                                                <h2 class="title">+977 982-535-3558</h2>
                                            </div>
                                        </div>
                                        {{-- @endif --}}
                                        {{-- @if ($user->contactInfo->email) --}}
                                        <div class="devider">
                                            <hr>
                                        </div>
                                        <div class="contact-icon-box">
                                            <div class="icon-img">
                                                {{-- <x-svg.envelope-icon height="32" width="32" /> --}}
                                                Icon
                                            </div>
                                            <div class="info">
                                                <h3 class="subtitle">{{ __('email_address') }}</h3>
                                                email@host.com
                                                {{-- <h2 class="title">{{ $user->contactInfo->email }}</h2> --}}
                                            </div>
                                        </div>
                                        {{-- @endif --}}
                                    </div>
                                    {{-- @endauth --}}
                                </div>
                                <div id="show-more" data-bs-toggle="collapse" data-bs-target="#contact-more-collapse"
                                    aria-expanded="false" aria-controls="contact-more-collapse"
                                    class="mt-2 rounded show-more">Show
                                    Contact Information</div>
                            </div>
                            <!-- contact information END -->
                            {{-- @if ($user->contactInfo->count() > 0) --}}
                            <div class="p-32 border border-1.5 border-primary-50 rt-rounded-12  max-536">
                                <div class="row g-0">
                                    <div class="col-12 d-flex align-items-center">
                                        <div class="f-size-18 text-gray-900 follow-us">
                                            {{ __('Follow us on') }}:
                                        </div>
                                    </div>
                                    <div class="col-12 rt-pt-lg-10">
                                        <ul class="rt-list gap-8">
                                            social links goes here
                                            {{-- @foreach ($user->socialInfo as $contact)
                                                    <li class="d-inline-block">
                                                        <a target="__blank" href="{{ $contact->url }}"
                                                            class="social-icon icon-44 bg-gray-10 bg-primary-50 text-primary-500 hover:border-primary-500">
                                                            @switch($contact)
                                                                @case($contact->social_media === 'facebook')
                                                                    <x-svg.facebook-icon />
                                                                @break

                                                                @case($contact->social_media === 'twitter')
                                                                    <x-svg.twitter-icon />
                                                                @break

                                                                @case($contact->social_media === 'instagram')
                                                                    <x-svg.instagram-icon />
                                                                @break

                                                                @case($contact->social_media === 'youtube')
                                                                    <x-svg.youtube-icon />
                                                                @break

                                                                @case($contact->social_media === 'linkedin')
                                                                    <x-svg.linkedin-icon />
                                                                @break

                                                                @case($contact->social_media === 'pinterest')
                                                                    <x-svg.pinterest-icon />
                                                                @break

                                                                @case($contact->social_media === 'reddit')
                                                                    <x-svg.reddit-icon />
                                                                @break

                                                                @case($contact->social_media === 'github')
                                                                    <x-svg.github-icon />
                                                                @break

                                                                @case($contact->social_media === 'other')
                                                                    <x-svg.link-icon />
                                                                @break

                                                                @default
                                                            @endswitch
                                                        </a>
                                                    </li>
                                                @endforeach --}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            {{-- @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="rt-spacer-100 rt-spacer-md-50"></div>
        <!--Related candidate Area-->
        <hr class="hr-0">
        <section class="related-jobs-area rt-pt-100 rt-pt-md-50" id="open_position">
            <div class="container">
                <div class="row">
                    <div class="flex-grow-1 mb-4">
                        <h4>{{ __('open_positions') }} (5)</h4>
                    </div>
                    @foreach (App\Models\User::all() as $job)
                        <div class="col-xl-4 col-md-6 fade-in-bottom rt-mb-24 cat-1 cat-3 ">
                            <div class="card jobcardStyle1 gradient-bg">
                                <div class="card-body">
                                    <div class="rt-single-icon-box">
                                        <div class="icon-thumb company-logo">
                                            <img src="{{ asset('assets/back/images/avatar.png') }}" alt=""
                                                draggable="false">
                                        </div>
                                        <div class="iconbox-content">
                                            <div class="job-mini-title">
                                                {{-- <a href="{{ route('website.job.details', $job->slug) }}">{{ $job->company->user->name }}</a> --}}
                                                <a href="">Job name</a>
                                                @if ($job->isVerified)
                                                    <span
                                                        class="badge rounded-pill bg-danger-50 text-danger-500">{{ __('verified') }}</span>
                                                @endif
                                            </div>
                                            <span class="loacton text-gray-400 d-inline-flex ">
                                                <i class="ph-map-pin"></i>
                                                {{ $job->phone }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="post-info">
                                        <div class="post-main-title">
                                            <a href="">Job Title</a>
                                            {{-- <a href="{{ route('website.job.details', $job->slug) }}">{{ $job->title }}</a> --}}
                                        </div>
                                        <div class="body-font-4 text-gray-600">
                                            <span class="info-tools">Job type name</span>
                                            <span class="info-tools has-dot">1000 -
                                                5000</span>
                                            {{-- <span class="info-tools has-dot">{{ currencyPosition($job->min_salary) }} -
                                                {{ currencyPosition($job->max_salary) }}</span> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="card text-center">
                        {{ __('no_data_found') }}
                    </div>
                    {{-- @endforelse --}}
                </div>
            </div>
        </section>
        <div class="rt-spacer-75 rt-spacer-md-30"></div>
    {{-- </div> --}}
@endsection
@section('css')
    <style>
        .show-more {
            font-size: 14px;
            padding: 6px;
            cursor: pointer;
            opacity: 0.7;
        }
    </style>
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
@endsection
