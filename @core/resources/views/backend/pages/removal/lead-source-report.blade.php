@extends('backend.admin-master')
@section('style')
    <style>
        .report-card { border-radius: 15px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .gradient-primary { background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); color: white; }
        .revenue-text { font-size: 24px; font-weight: bold; }
    </style>
@endsection
@section('site-title')
    {{__('Lead Source Performance Report')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <h4 class="header-title mb-4">{{__('Lead Source ROI Analysis')}}</h4>
            </div>
            
            @foreach($report_data as $data)
            <div class="col-md-4 mb-4">
                <div class="card report-card p-3 @if($loop->first) gradient-primary @endif">
                    <div class="card-body">
                        <h5 class="text-uppercase mb-2 @if(!$loop->first) text-muted @endif">{{ $data->lead_source ?: 'Direct / Unknown' }}</h5>
                        <div class="revenue-text mb-2">{{ amount_with_currency_symbol($data->total_revenue) }}</div>
                        <div class="small">Total Bookings: <strong>{{ $data->total_bookings }}</strong></div>
                        <div class="small mt-1">Average per Booking: <strong>{{ amount_with_currency_symbol($data->total_revenue / ($data->total_bookings ?: 1)) }}</strong></div>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="col-lg-12 mt-4">
                <div class="card report-card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">{{__('Detailed Performance Breakdown')}}</h4>
                        <div class="table-wrap table-responsive">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{__('Source')}}</th>
                                        <th>{{__('Bookings')}}</th>
                                        <th>{{__('Total Revenue')}}</th>
                                        <th>{{__('Profitability Index')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $grand_total = $report_data->sum('total_revenue'); @endphp
                                    @foreach($report_data as $data)
                                    <tr>
                                        <td><strong>{{ $data->lead_source ?: 'Others' }}</strong></td>
                                        <td>{{ $data->total_bookings }}</td>
                                        <td>{{ amount_with_currency_symbol($data->total_revenue) }}</td>
                                        <td>
                                            @php $percentage = ($grand_total > 0) ? ($data->total_revenue / $grand_total) * 100 : 0; @endphp
                                            <div class="progress" style="height: 10px;">
                                                <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%;" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <small>{{ number_format($percentage, 1) }}% of total revenue</small>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
