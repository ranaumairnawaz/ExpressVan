@extends('backend.admin-master')
@section('site-title')
    Calendar Settings
@endsection
@section('content')
<div class="col-lg-12 col-ml-12 padding-bottom-30">
    <div class="row">
        <div class="col-lg-12">
            <div class="margin-top-40">
                @include('backend.partials.message')
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card dashboard-card-ten">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3><i class="fa fa-calendar-check text-primary"></i> Calendar Sync Settings</h3>
                            <p class="text-muted mb-0">Connect your Google (or Microsoft) Calendar so that every new removal booking is automatically added as an event on <strong>your</strong> calendar.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- GOOGLE CALENDAR CARD --}}
        <div class="col-lg-6 mt-4">
            <div class="card dashboard-card-ten h-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://www.gstatic.com/images/branding/product/2x/calendar_2020q4_48dp.png"
                             width="40" class="mr-3" alt="Google Calendar">
                        <div>
                            <h5 class="mb-0 font-weight-bold">Google Calendar</h5>
                            <small class="text-muted">Sync bookings via Google Calendar API</small>
                        </div>
                    </div>

                    @if($google)
                        <div class="alert alert-success py-2 d-flex align-items-center" role="alert">
                            <i class="fa fa-check-circle mr-2"></i>
                            <span>Connected &amp; Active
                                @if($google->expires_at)
                                    <small class="d-block text-muted">Token expires: {{ \Carbon\Carbon::parse($google->expires_at)->diffForHumans() }}</small>
                                @endif
                            </span>
                        </div>
                        <div class="mt-auto d-flex gap-2 flex-wrap">
                            <a href="{{ route('admin.calendar.google.auth') }}" class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-sync-alt mr-1"></i> Re-authorize
                            </a>
                            <form method="POST" action="{{ route('admin.calendar.disconnect') }}" class="d-inline">
                                @csrf
                                <input type="hidden" name="provider" value="google">
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Disconnect Google Calendar?')">
                                    <i class="fa fa-unlink mr-1"></i> Disconnect
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="alert alert-warning py-2 d-flex align-items-center" role="alert">
                            <i class="fa fa-exclamation-circle mr-2"></i>
                            <span>Not connected. Click below to authorize.</span>
                        </div>
                        <div class="mt-auto">
                            <a href="{{ route('admin.calendar.google.auth') }}" class="btn btn-primary btn-sm">
                                <i class="fab fa-google mr-1"></i> Connect Google Calendar
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- MICROSOFT (COMING SOON) CARD --}}
        <div class="col-lg-6 mt-4">
            <div class="card dashboard-card-ten h-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/43/Microsoft_Office_Outlook_%282019%E2%80%93present%29.svg/120px-Microsoft_Office_Outlook_%282019%E2%80%93present%29.svg.png"
                             width="40" class="mr-3" alt="Outlook">
                        <div>
                            <h5 class="mb-0 font-weight-bold">Microsoft Outlook</h5>
                            <small class="text-muted">Sync bookings via Microsoft Graph API</small>
                        </div>
                    </div>
                    <div class="alert alert-secondary py-2 d-flex align-items-center" role="alert">
                        <i class="fa fa-clock mr-2"></i>
                        <span>Coming soon — Microsoft integration is being prepared.</span>
                    </div>
                    <div class="mt-auto">
                        <button class="btn btn-secondary btn-sm" disabled>
                            <i class="fab fa-microsoft mr-1"></i> Connect Outlook (Soon)
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- HELP PANEL --}}
        <div class="col-lg-12 mt-4">
            <div class="card dashboard-card-ten">
                <div class="card-body">
                    <h5><i class="fa fa-info-circle text-info mr-1"></i> How It Works</h5>
                    <ul class="mb-0" style="line-height: 2rem;">
                        <li>Each admin account can independently connect their own calendar.</li>
                        <li>When <strong>any</strong> new removal booking is confirmed, an event is automatically added to <strong>every</strong> admin's connected calendar.</li>
                        <li>The event includes the customer name, phone, booking time &amp; duration, and a direct link to the admin order view.</li>
                        <li>The API credentials (Client ID &amp; Secret) are managed in <a href="{{ route('admin.removal.settings') }}">Removal Settings</a>.</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
