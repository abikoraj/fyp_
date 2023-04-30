<header class="header rt-fixed-top">
    <div class="n-header">
        <div class="n-header--bottom">
            <div class="container position-relative">
                <div class="d-flex">

                    <div class="n-header--bottom__left d-flex align-items-center">
                        <a href="{{ route('donor.dashboard') }}" class="brand-logo">
                            <img src="{{ asset('assets/authfile/images/logo.png') }}" alt="">
                        </a>
                        {{-- <form action="" method="GET" id="search-form" class="mx-width-300 d-lg-block d-none">
                            <div class="search-box form-item position-relative">
                                <input name="keyword" class="search-input w-100" type="text"
                                    placeholder="{{ __('job_title_keyword') }}" value="{{ request('keyword') }}"
                                    id="global_search">
                                <svg class="position-absolute" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                                        stroke="#0A65CC" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M21 20.9999L16.65 16.6499" stroke="#0A65CC" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>

                            </div>
                        </form> --}}
                    </div>

                    <div class="n-header--bottom__right">
                        <div class="d-flex align-items-center ">
                            {{-- <div class="search-icon mx-2 d-lg-none">
                                <svg id="searchIcon" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                                        stroke="#18191C" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M20.9999 21L16.6499 16.65" stroke="#18191C" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div class="togglesearch ">
                                <form action="" method="GET" id="search-form"
                                    class="shadow px-md-5 py-md-3 p-3 rounded w-sm-75 w-100">
                                    <div class="search-box form-item position-relative">
                                        <input name="keyword" class="search-input w-100" type="text"
                                            placeholder="{{ __('job_title_keyword') }}" value="{{ request('keyword') }}"
                                            id="global_search">
                                        <svg class="position-absolute" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                                                stroke="#0A65CC" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M21 20.9999L16.65 16.6499" stroke="#0A65CC" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </form>
                            </div> --}}

                            <ul class="custom-border list-unstyled d-flex align-items-center justify-content-between">
                                <span>{{ Auth::user()->name }}</span>
                                <li class="relative">
                                    <a href="{{ route('profile.index') }} " class="candidate-profile">
                                        <img src="{{ asset(Auth::user()->profile->image ?? 'assets/authfile/images/profile_dummy.png') }}" alt="Profile Image">
                                        {{-- @if (Auth::user()->profile)
                                        @else
                                            <img src="{{ asset('assets/authfile/images/profile_dummy.png') }}" alt="Profile Image">
                                        @endif --}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="rt-mobile-menu-overlay"></div>
    </div>
</header>
