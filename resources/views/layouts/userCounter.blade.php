@php
    $donor_count = App\Models\User::where('role', 2)->where('isVerified', true)->count();
    $receiver_count = App\Models\User::where('role', 1)->where('isVerified', true)->count();
    $user_count = $donor_count + $receiver_count;
@endphp
<h3 class="f-size-16">Users</h3>
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="single-feature-box">
                    <div class="single-feature-data">
                        <h6>{{ $donor_count }}</h6>
                        <p>Donors</p>
                    </div>
                    <div class="single-feature-icon">
                        <i class="ph ph-users"></i>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="single-feature-box">
                    <div class="single-feature-data">
                        <h6>{{ $receiver_count }}</h6>
                        <p>Receivers</p>
                    </div>
                    <div class="single-feature-icon">
                        <i class="ph ph-users"></i>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="single-feature-box bg-danger-50">
                    <div class="single-feature-data">
                        <h6>{{ $user_count }}</h6>
                        <p>Total Users</p>
                    </div>
                    <div class="single-feature-icon">
                        <i class="ph ph-users-three text-danger-500"></i>
                    </div>
                </div>
            </div>
