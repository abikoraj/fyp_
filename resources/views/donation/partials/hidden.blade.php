<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Status</th>
            <th>Quantity</th>
            <th>Expires At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if ($hidden->count() > 0)
            @foreach ($hidden as $all)
                <tr>
                    <td>
                        <div class="iconbox-content">
                            <div class="post-info2">
                                <div class="post-main-title">
                                    <a href=""
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
                        <div class="db-job-btn-wrap d-flex justify-content-end">

                            <button type="button" class="btn bg-gray-50 text-primary-500" id="dropdownMenuButton5"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ph ph-dots-three-outline-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end company-dashboard-dropdown"
                                aria-labelledby="dropdownMenuButton5">
                                <li>
                                    <a class="dropdown-item" href="">
                                        View Details
                                    </a>
                                </li>
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
