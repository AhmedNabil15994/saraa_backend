<!DOCTYPE html>
<html lang="{{ LANGUAGE_PREF }}" dir="{{ DIRECTION }}">
	<head>
		<meta charset="UTF-8" />
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, height=device-height ,  maximum-scale=1 , initial-scale=1">
		<title>{{config('modules.site_configs.app_name_'.LANGUAGE_PREF)}} | @yield('title')</title>
		<meta name="description" content="#" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		@yield('extra-metas')
		@include('dashboard.Layouts.auth.head')
	</head>
	
	<body>
		<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Login-->
			<div class="login login-2 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
				<!--begin::Aside-->
				<div class="login-aside order-2 order-lg-1 d-flex flex-row-auto position-relative overflow-hidden">
					<!--begin: Aside Container-->
					<div class="d-flex flex-column-fluid flex-column justify-content-between py-9 px-7 py-lg-13 px-lg-35">
						<!--begin::Logo-->
						<a href="#" class="text-center pt-2">
							<img src="assets/media/logos/logo.png" class="max-h-75px" alt="" />
						</a>
						<!--end::Logo-->
						<!--begin::Aside body-->
						<div class="d-flex flex-column-fluid flex-column flex-center">
							@yield('content')
						</div>
						<!--end::Aside body-->
					</div>
					<!--end: Aside Container-->
				</div>
				<!--begin::Aside-->
				<!--begin::Content-->
				<div class="content order-1 order-lg-2 d-flex flex-column w-100 pb-0" style="background-color: #B1DCED;">
					<!--begin::Image-->
					<div class="content-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center" style="background-image: url({{asset('assets/dashboard/media/svg/illustrations/login-visual-2.svg')}});"></div>
					<!--end::Image-->
				</div>
				<!--end::Content-->
			</div>
			<!--end::Login-->
		</div>
			@include('dashboard.Layouts.auth.scripts')
	        @include('dashboard.Partials.notf_messages')
	    </div>
	</body>
</html>