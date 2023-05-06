@php
    $all = App\Models\Donation::where('user_id', Auth::user()->id)->where('hidden', false)->count();
    $active = App\Models\Donation::where('user_id', Auth::user()->id)->whereIn('status', [0, 1, 2])->where('hidden', false)->where('approval', 1)->count();
    $closed = App\Models\Donation::where('user_id', Auth::user()->id)->where('status', [4, 3])->where('hidden', false)->where('approval', 1)->count();
@endphp
<h3 class="f-size-16">My Donations</h3>
<div class="col-xl-4 col-lg-6 col-md-6">
    <div class="single-feature-box">
        <div class="single-feature-data">
            <h6>{{ $active }}</h6>
            <p>Active Donations</p>
        </div>
        <div class="single-feature-icon">
            <i class="ph ph-users"></i>
        </div>
    </div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
    <div class="single-feature-box">
        <div class="single-feature-data">
            <h6>{{ $closed }}</h6>
            <p>Closed Donations</p>
        </div>
        <div class="single-feature-icon">
            <i class="ph ph-users"></i>
        </div>
    </div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
    <div class="single-feature-box bg-danger-50">
        <div class="single-feature-data">
            <h6>{{ $all }}</h6>
            <p>Total Donations</p>
        </div>
        <div class="single-feature-icon">
            <i class="ph ph-users-three text-danger-500"></i>
        </div>
    </div>
</div>
