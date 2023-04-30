<div class="row">
    <div class="col-12">
        <ul class="rt-list">
            @foreach ($donations as $donation)
                <li class="d-block fade-in-bottom  rt-mb-24">
                    <div class="card iconxl-size jobcardStyle1">
                        <div class="card-body">
                            <div class="rt-single-icon-box icb-clmn-lg ">
                                <a href="{{ asset($donation->image ?? 'assets/front/images/default.jpg') }}"
                                    class="icon-thumb">
                                    <img src="{{ asset($donation->image ?? 'assets/front/images/default.jpg') }}"
                                        alt="" draggable="false">
                                </a>
                                <a href="{{ route('donation.details', $donation->id) }}" class="iconbox-content">
                                    <div class="post-info2">

                                        <div class="post-main-title">
                                            {{ $donation->name }}
                                            &nbsp;
                                            @switch($donation->status)
                                                @case(0)
                                                    <span
                                                        class="badge rounded-pill bg-success-100 text-success-500">Fresh</span>
                                                @break

                                                @case(1)
                                                    <span class="badge rounded-pill bg-light text-dark">Interested</span>
                                                @break

                                                @case(2)
                                                    <span
                                                        class="badge rounded-pill bg-warning-100 text-warning-500">Expired</span>
                                                @break

                                                @case(3)
                                                    <span class="badge rounded-pill bg-danger-100 text-danger-500">Wasted</span>
                                                @break

                                                @case(4)
                                                    <span
                                                        class="badge rounded-pill bg-light text-dark text-muted">Completed</span>
                                                @break

                                                @default
                                                    <span class="badge rounded-pill bg-light text-dark">Unknown</span>
                                            @endswitch
                                            &nbsp;
                                            <span class="body-font-5 text-gray-600">
                                                {{ $donation->created_at->diffForHumans() }}
                                                {{ $donation->expires_at }}
                                            </span>
                                        </div>
                                        <div class="body-font-4 text-gray-600 pt-2">
                                            <span class="info-tools">
                                                <i class="ph ph-diamonds-four"></i>
                                                {{ $donation->quantity }} {{ \App\Helper::getUnit()[$donation->unit] }}
                                            </span>
                                            <span class="info-tools">
                                                <i class="ph ph-map-pin"></i>
                                                {{ $donation->city_id ? $donation->city->name : '' }}
                                                -
                                                {{ $donation->address ?? '' }}
                                            </span>

                                        </div>
                                    </div>
                                </a>
                                <div class="iconbox-extra align-self-center">
                                    <div>
                                        @if ($donation->status == 0  && Auth::user()->profile->type == 1)
                                            <button type="button" class="btn btn-primary2-50">
                                                <span class="button-content-wrapper ">
                                                    <span class="button-icon align-icon-right"><i
                                                            class="ph ph-arrow-right"></i></span>
                                                    <span class="button-text">Interested</span>
                                                </span>
                                            </button>
                                        @endif
                                        @if ($donation->status == 0 && Auth::user()->profile->type == 2)
                                            <button type="button" class="btn btn-primary2-50">
                                                <span class="button-content-wrapper ">
                                                    <span class="button-icon align-icon-right"><i
                                                            class="ph ph-arrow-right"></i></span>
                                                    <span class="button-text">Interested</span>
                                                </span>
                                            </button>
                                        @endif
                                        {{-- <button type="button"
                                            onclick="applyJobb({{ $job->id }}, '{{ $job->title }}')"
                                            class="btn btn-primary2-50"> --}}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
