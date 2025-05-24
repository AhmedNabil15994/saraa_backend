@extends('dashboard.Layouts.master')
@section('title',trans('Dashboard::dashboard.dashboard'))
@section('pageName',trans('Dashboard::dashboard.dashboard'))

@section('breadcrumbs')
@include('dashboard.Layouts.breadcrumb',[
    'breadcrumbs' => [
        [
            'title' => trans('Dashboard::dashboard.menu'),
            'url' => \URL::to('/dashboard')
        ],
    ],
])
@endsection

@section('content')
<div class="row">
	<div class="col-xl-3">
		<div class="card card-custom bgi-no-repeat card-stretch gutter-b" style="background-position: right top; background-size: 30% auto; background-image: url({{asset('assets/dashboard/media/svg/shapes/abstract-3.svg')}})">
			<div class="card-body my-4">
				<a href="#" class="card-title font-weight-bolder text-info font-size-h6 mb-4 text-hover-state-dark d-block">{{trans('Dashboard::dashboard.stores')}}</a>
				<div class="font-weight-bold text-muted font-size-sm">
				<span class="text-dark-75 font-weight-bolder font-size-h2 mr-2">{{$counts['stores']}}</span></div>
				<div class="progress progress-xs mt-7 bg-info-o-60">
					<div class="progress-bar bg-info" role="progressbar" style="width: 67%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3">
		<div class="card card-custom bg-info card-stretch gutter-b">
			<div class="card-body my-4">
				<a href="#" class="card-title font-weight-bolder text-white font-size-h6 mb-4 text-hover-state-dark d-block">{{trans('Dashboard::dashboard.sellers')}}</a>
				<div class="font-weight-bold text-white font-size-sm">
				<span class="font-size-h2 mr-2">{{$counts['sellers']}}</span></div>
				<div class="progress progress-xs mt-7 bg-white-o-90">
					<div class="progress-bar bg-white" role="progressbar" style="width: 87%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3">
		<div class="card card-custom bg-primary card-stretch gutter-b">
			<div class="card-body my-4">
				<a href="#" class="card-title font-weight-bolder text-white font-size-h6 mb-4 text-hover-state-dark d-block">{{trans('Dashboard::dashboard.clients')}}</a>
				<div class="font-weight-bold text-white font-size-sm">
				<span class="font-size-h2 mr-2">{{$counts['clients']}}</span></div>
				<div class="progress progress-xs mt-7 bg-white-o-90">
					<div class="progress-bar bg-white" role="progressbar" style="width: 87%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3">
		<div class="card card-custom bg-dark card-stretch gutter-b">
			<div class="card-body my-4">
				<a href="#" class="card-title font-weight-bolder text-white font-size-h6 mb-4 text-hover-state-dark d-block">{{trans('Dashboard::dashboard.cars')}}</a>
				<div class="font-weight-bold text-white font-size-sm">
				<span class="font-size-h2 mr-2">{{$counts['cars']}}</span></div>
				<div class="progress progress-xs mt-7 bg-white-o-90">
					<div class="progress-bar bg-white" role="progressbar" style="width: 52%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xl-3">
		<div class="card card-custom bgi-no-repeat card-stretch gutter-b" style="background-position: right top; background-size: 30% auto; background-image: url({{asset('assets/dashboard/media/svg/shapes/abstract-1.svg')}})">
			<div class="card-body">
				<span class="svg-icon svg-icon-2x svg-icon-info">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
						<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
							<rect x="0" y="0" width="24" height="24"></rect>
							<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>
							<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
							<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
							<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
						</g>
					</svg>
				</span>
				<span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">{{$counts['all_orders']}}</span>
				<span class="font-weight-bold text-muted font-size-sm">{{trans('Dashboard::dashboard.reservations')}}</span>
			</div>
		</div>
	</div>
	<div class="col-xl-3">
		<div class="card card-custom bg-success card-stretch gutter-b">
			<div class="card-body">
				<span class="svg-icon svg-icon-2x svg-icon-white">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
						<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
							<rect x="0" y="0" width="24" height="24"></rect>
							<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>
							<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
							<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
							<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
						</g>
					</svg>
				</span>
				<span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{$counts['paid_orders']}}</span>
				<span class="font-weight-bold text-white font-size-sm">{{trans('Dashboard::dashboard.paid_reservations')}}</span>
			</div>
		</div>
	</div>
	<div class="col-xl-3">
		<div class="card card-custom bg-danger card-stretch gutter-b">
			<div class="card-body">
				<span class="svg-icon svg-icon-2x svg-icon-white">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
						<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
							<rect x="0" y="0" width="24" height="24"></rect>
							<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>
							<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
							<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
							<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
						</g>
					</svg>
				</span>
				<span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{$counts['uncompleted_orders']}}</span>
				<span class="font-weight-bold text-white font-size-sm">{{trans('Dashboard::dashboard.unCompleted_reservations')}}</span>
			</div>
		</div>
	</div>
	<div class="col-xl-3">
		<div class="card card-custom bg-dark card-stretch gutter-b">
			<div class="card-body">
				<span class="svg-icon svg-icon-2x svg-icon-white">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
						<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
							<rect x="0" y="0" width="24" height="24"></rect>
							<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>
							<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
							<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
							<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
						</g>
					</svg>
				</span>
				<span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 text-hover-primary d-block">{{$counts['pending_orders']}}</span>
				<span class="font-weight-bold text-white font-size-sm">{{trans('Dashboard::dashboard.pending_reservations')}}</span>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xl-3">
		<div class="card card-custom bgi-no-repeat card-stretch gutter-b" style="background-position: right top; background-size: 30% auto; background-image: url({{asset('assets/dashboard/media/svg/shapes/abstract-1.svg')}})">
			<div class="card-body">
				<span class="svg-icon svg-icon-2x svg-icon-info">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
						<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
							<rect x="0" y="0" width="24" height="24"></rect>
							<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>
							<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
							<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
							<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
						</g>
					</svg>
				</span>
				<span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">{{$counts['today_profit']}}</span>
				<span class="font-weight-bold text-muted font-size-sm">{{trans('Dashboard::dashboard.today_profit')}}</span>
			</div>
		</div>
	</div>
	<div class="col-xl-3">
		<div class="card card-custom bg-success card-stretch gutter-b">
			<div class="card-body">
				<span class="svg-icon svg-icon-2x svg-icon-white">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
						<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
							<rect x="0" y="0" width="24" height="24"></rect>
							<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>
							<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
							<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
							<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
						</g>
					</svg>
				</span>
				<span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{$counts['month_profit']}}</span>
				<span class="font-weight-bold text-white font-size-sm">{{trans('Dashboard::dashboard.month_profit')}}</span>
			</div>
		</div>
	</div>
	<div class="col-xl-3">
		<div class="card card-custom bg-danger card-stretch gutter-b">
			<div class="card-body">
				<span class="svg-icon svg-icon-2x svg-icon-white">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
						<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
							<rect x="0" y="0" width="24" height="24"></rect>
							<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>
							<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
							<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
							<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
						</g>
					</svg>
				</span>
				<span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{$counts['year_profit']}}</span>
				<span class="font-weight-bold text-white font-size-sm">{{trans('Dashboard::dashboard.year_profit')}}</span>
			</div>
		</div>
	</div>
	<div class="col-xl-3">
		<div class="card card-custom bg-dark card-stretch gutter-b">
			<div class="card-body">
				<span class="svg-icon svg-icon-2x svg-icon-white">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
						<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
							<rect x="0" y="0" width="24" height="24"></rect>
							<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>
							<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
							<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
							<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
						</g>
					</svg>
				</span>
				<span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 text-hover-primary d-block">{{$counts['total_profit']}}</span>
				<span class="font-weight-bold text-white font-size-sm">{{trans('Dashboard::dashboard.total_profit')}}</span>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<div class="card card-custom gutter-b">
			<div class="card-header h-auto">
				<div class="card-title py-5">
					<h3 class="card-label">{{trans('Dashboard::dashboard.order_monthly')}}</h3>
				</div>
			</div>
			<div class="card-body">
				<div id="chart_1"></div>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="card card-custom gutter-b">
			<div class="card-header">
				<div class="card-title">
					<h3 class="card-label">{{trans('Dashboard::dashboard.clients')}}</h3>
				</div>
			</div>
			<div class="card-body">
				<div id="chart_2"></div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<div class="card card-custom gutter-b">
			<div class="card-header">
				<div class="card-title">
					<h3 class="card-label">{{trans('Dashboard::dashboard.order_status')}}</h3>
				</div>
			</div>
			<div class="card-body">
				<div id="chart_12" class="d-flex justify-content-center"></div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('js')
<script>
	$(function(){
		"use strict";

		var chart_1_data = [0,0,0,0,0,0,0,0,0,0,0,0];
		var chart_2_data = [0,0,0,0,0,0,0,0,0,0,0,0];
      	@foreach($counts['month_reservations'] as $chartKey => $one)
      	chart_1_data[{{ $one->month }}] = '{{$one->data}}';
      	@endforeach
      	@foreach($counts['month_clients'] as $key => $item)
      	chart_2_data[{{ $item->month }}] = {{$item->data}};
      	@endforeach


		// Shared Colors Definition
		const primary = '#6993FF';
		const success = '#1BC5BD';
		const info = '#8950FC';
		const warning = '#FFA800';
		const danger = '#F64E60';
		var KTApexChartsDemo = function () {
			var _demo1 = function () {
				const apexChart = "#chart_1";
				var options = {
					series: [{
						name: "{{trans('Dashboard::dashboard.reservations')}}",
						data: chart_1_data
					}],
					chart: {
						height: 350,
						type: 'line',
						zoom: {
							enabled: false
						}
					},
					dataLabels: { 	
						enabled: false
					},
					stroke: {
						curve: 'straight'
					},
					grid: {
						row: {
							colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
							opacity: 0.5
						},
					},
					xaxis: {
						categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct' , 'Nov' ,'Dec'],
					},
					colors: [primary]
				};

				var chart = new ApexCharts(document.querySelector(apexChart), options);
				chart.render();
			}
			var _demo2 = function () {
				const apexChart = "#chart_2";
				var options = {
					series: [{
						name: '{{trans('Dashboard::dashboard.clients')}}',
						data: chart_2_data
					}],
					chart: {
						height: 350,
						type: 'area'
					},
					dataLabels: {
						enabled: false
					},
					stroke: {
						curve: 'smooth'
					},
					xaxis: {
						categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct' , 'Nov' ,'Dec'],
					},
					colors: [primary, success]
				};

				var chart = new ApexCharts(document.querySelector(apexChart), options);
				chart.render();
			}
			var _demo12 = function () {
				const apexChart = "#chart_12";
				var options = {
					series: [{{$counts['uncompleted_orders']}}, {{$counts['paid_orders']}}, {{$counts['pending_orders']}},],
					chart: {
						width: 380,
						type: 'pie',
					},
					labels: ['{{trans('Dashboard::dashboard.unCompleted_reservations')}}', '{{trans('Dashboard::dashboard.paid_reservations')}}', '{{trans('Dashboard::dashboard.pending_reservations')}}'],
					responsive: [{
						breakpoint: 480,
						options: {
							chart: {
								width: 200
							},
							legend: {
								position: 'bottom'
							}
						}
					}],
					colors: [danger, success, warning,]
				};

				var chart = new ApexCharts(document.querySelector(apexChart), options);
				chart.render();
			}
		return {
				// public functions
				init: function () {
					_demo1();
					_demo2();
					_demo12();
				}
			};
		}();

		jQuery(document).ready(function () {
			KTApexChartsDemo.init();
		});

	})
</script>
@endpush