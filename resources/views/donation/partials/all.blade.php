<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Status</th>
            <th>Quantity</th>
            <th>Expires At</th>
            <th>Approval</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if ($all->count() > 0)
            @foreach ($all as $all)
                <tr>
                    <td>
                        <div class="iconbox-content">
                            <div class="post-info2">
                                <div class="post-main-title">
                                    <a href="{{ route('donation.details', $all->id) }}"
                                        class="text-gray-900 f-size-16  ft-wt-5">
                                        {{ $all->name }}
                                    </a>
                                </div>
                                <div class="body-font-4 text-gray-600 pt-2">
                                    <span class="info-tools rt-mr-8">
                                        {{-- {{ ucfirst($job->job_type->name) }} --}}
                                        {{ $all->created_at->diffForHumans() }}
                                    </span>

                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        {{-- <form method="POST" action="{{ route('donation.status', $all->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <select name="status" class="form-control py-0 px-1" style="border: none;" onchange="this.form.submit()">
                                    @foreach(\App\Helper::getStatus() as $key => $value)
                                        <option value="{{ $key }}" {{ $all->status == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form> --}}
                        <div class="text-success-500 ft-wt-5 d-flex align-items-center">
                            <i class="ph-check-circle f-size-18 mt-1 rt-mr-4"></i>
                            {{ \App\Helper::getStatus()[$all->status] }}
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <i class="ph-users f-size-20 rt-mr-4"></i>
                            {{ $all->quantity }} {{ \App\Helper::getUnit()[$all->unit] }}
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <i class="ph-users f-size-20 rt-mr-4"></i>
                            {{ $all->expires_at }}
                        </div>
                    </td>
                    <td>
                        <div class="text-success-500 ft-wt-5 d-flex align-items-center">
                            <i class="ph-check-circle f-size-18 mt-1 rt-mr-4"></i>
                            {{ \App\Helper::getApproval()[$all->approval] }}
                        </div>
                    </td>
                    <td>
                        <div class="db-job-btn-wrap d-flex justify-content-end">

                            <button type="button" class="btn bg-gray-50 text-primary-500" id="dropdownMenuButton5"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ph ph-dots-three-outline-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end company-dashboard-dropdown"
                                aria-labelledby="dropdownMenuButton5">
                                {{-- @if ($all->status == 0 )
                                    <li>
                                        <a class="dropdown-item" href="">
                                            Edit
                                        </a>
                                    </li>
                                @endif --}}
                                <li>
                                    <a class="dropdown-item" href="{{ route('donation.details', $all->id) }}">
                                        View Details
                                    </a>
                                </li>
                                @if ($all->approval == 1)
                                    @if ($all->status == 0 || $all->status == 1)
                                        <li>
                                            <form action="{{ route('donation.status', $all->id) }}" method="post">
                                                @csrf
                                                <button class="dropdown-item" type="submit">
                                                    <input type="hidden" name="status" value=2>
                                                    Mark as Expired
                                                </button>
                                            </form>
                                        </li>
                                    @endif
                                    @if ( $all->status != 3 && $all->status != 4 )
                                        <li>
                                            <form action="{{ route('donation.status', $all->id) }}" method="post">
                                                @csrf
                                                <button class="dropdown-item" type="submit">
                                                    <input type="hidden" name="status" value=3>
                                                    Mark as Wasted
                                                </button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="{{ route('donation.status', $all->id) }}" method="post">
                                                @csrf
                                                <button class="dropdown-item" type="submit">
                                                    <input type="hidden" name="status" value=4>
                                                    Mark as Complete
                                                </button>
                                            </form>
                                        </li>
                                    @endif
                                @endif
                                @if ( $all->status == 0 )
                                    <li>
                                        <form action="{{ route('donation.hide', $all->id) }}" method="POST">
                                            @csrf
                                            {{-- <input type="hidden" name="hidden" value="true"> --}}
                                            <button class="dropdown-item" type="submit">
                                                Hide Donation
                                            </button>
                                        </form>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            @include('layouts.notfound')
        @endif
    </tbody>
</table>
