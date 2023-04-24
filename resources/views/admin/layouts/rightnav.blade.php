@php
    $user = Auth::user();
@endphp
<li class="nav-item dropdown">
    <a class="nav-link d-flex justify-content-center align-items-center" data-toggle="dropdown" href="#"
        aria-expanded="false">
        <i class="fas fa-plus"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">{{ __('quick_actions') }}</span>
        <div class="dropdown-divider"></div>
        <div class="row row-paddingless">
            <div class="col-6 p-0 border-bottom border-right">
                <a href="" class="d-block text-center py-3 bg-hover-light"> <i class="fas fa-briefcase"></i>
                    <span class="w-100 d-block text-muted">{{ __('Add Request') }}</span>
                </a>
            </div>


                <div class="col-6 p-0 border-bottom border-right">
                    <a href="" class="d-block text-center py-3 bg-hover-light"> <i
                            class="fas fa-building"></i>
                        <span class="w-100 d-block text-muted">{{ __('Add Donor') }}</span>
                    </a>
                </div>


                <div class="col-6 p-0 border-bottom border-right">
                    <a href="" class="d-block text-center py-3 bg-hover-light"> <i
                            class="fas fa-user"></i>
                        <span class="w-100 d-block text-muted"> {{ __('Add') }} {{ __('Receiver') }}</span>
                    </a>
                </div>


                <div class="col-6 p-0 border-bottom border-right">
                    <a href="" class="d-block text-center py-3 bg-hover-light"> <i
                            class="fas fa-cog"></i>
                        <span class="w-100 d-block text-muted">{{ __('settings') }}</span>
                    </a>
                </div>

        </div>
        <div class="dropdown-divider"></div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link d-flex justify-content-center align-items-center" data-widget="fullscreen" href="#"
        role="button">
        <i class="fas fa-expand-arrows-alt"></i>
    </a>
</li>
{{-- <li class="nav-item dropdown" onclick="ReadNotification()"> --}}
<li class="nav-item dropdown" onclick="">
    <a class="nav-link d-flex justify-content-center align-items-center" data-toggle="dropdown" href="#"
        aria-expanded="true">
        <i class="fas fa-bell"></i>
        {{-- @if (adminUnNotifications() != 0) --}}
            <span class="badge badge-warning navbar-badge" id="unNotifications">
                {{-- {{ adminUnNotifications() }} --}} 1
            </span>
        {{-- @endif --}}
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="notification-panel">
        <span class="dropdown-item dropdown-header text-md card-header">{{ __('notifications') }}</span>
        {{-- @if (adminNotifications()->count() > 0)
            @foreach (adminNotifications() as $notification)
                <div class="dropdown-divider"></div>
                <a href="{{ $notification->data['url'] }}" class="dropdown-item word-break">
                    <p>
                        @if ($notification->type == 'App\Notifications\Admin\NewJobAvailableNotification')
                            <i class="fas fa-briefcase"></i>
                        @elseif ($notification->type == 'App\Notifications\Admin\NewPlanPurchaseNotification')
                            <i class="fas fa-credit-card"></i>
                        @elseif ($notification->type == 'App\Notifications\Admin\NewUserRegisteredNotification')
                            <i class="fas fa-user"></i>
                        @endif
                        &nbsp;
                        {{ $notification->data['title'] }}
                    </p>
                    <span class="float-right text-muted text-sm">
                        {{ $notification->created_at->diffForHumans() }}
                    </span>
                </a>
            @endforeach
        @else
            <span class="d-flex justify-content-center mb-2 p-2 text-sm">
                {{ __('no_notification') }}
            </span>
        @endif
        @if (adminNotifications()->count() > 6)
            <div class="dropdown-divider"></div>
            <a href="{{ route('admin.all.notification') }}"
                class="dropdown-item dropdown-footer">{{ __('see_all_notifications') }}
            </a>
        @endif --}}
    </div>
</li>
<li class="nav-item dropdown user-menu">
    <a href="" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <img src="{{ asset('assets/back/images/avatar.png') }}" class="user-image img-circle elevation-2" alt="User Image">
        <span class="d-none d-md-inline">{{ $user->name }}</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right rounded border-0">
        <!-- User image -->
        <li class="user-header bg-primary rounded-top">
            <img src="{{ asset('assets/back/images/avatar.png') }}" class="user-image img-circle elevation-2"
                alt="{{ __('user_image') }}">
            <p>
                {{ $user->name }} - {{ $user->role }}
                {{-- @foreach ($user->getRoleNames() as $role)
                    (<span>{{ ucwords($role) }}</span>)
                @endforeach --}}
                <small>{{ __('member_since') }} {{ $user->created_at->format('M d, Y') }}</small>
            </p>
        </li>
        <!-- Menu Footer-->
        <li class="user-footer border-bottom d-flex">
            <a href="" class="btn btn-default">{{ __('profile') }}</a>
            <a href="javascript:void(0)"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                class="btn btn-default ml-auto">{{ __('log_out') }}</a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none invisible">
                @csrf
            </form>
        </li>
    </ul>
</li>
