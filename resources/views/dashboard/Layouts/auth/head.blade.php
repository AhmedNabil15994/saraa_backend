<link rel="shortcut icon" href="{{asset(config('modules.site_configs.app_favicon'))}}">
<link rel="preconnect" href="https://fonts.gstatic.com">
<!--begin::Fonts-->
<link href="https://fonts.googleapis.com/css?family=Cairo:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
<!--end::Fonts-->
<!--begin::Page Custom Styles(used by this page)-->
<link href="{{asset('assets/dashboard/css/pages/login/login-2.css')}}" rel="stylesheet" type="text/css" />
<!--end::Page Custom Styles-->
<!--begin::Global Theme Styles(used by all pages)-->
<link href="{{asset('assets/dashboard/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/dashboard/plugins/custom/prismjs/prismjs.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/dashboard/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
<!--end::Global Theme Styles-->
<!--begin::Layout Themes(used by all pages)-->
<link href="{{asset('assets/dashboard/css/themes/layout/header/base/light.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/dashboard/css/themes/layout/header/menu/light.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/dashboard/css/themes/layout/brand/dark.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/dashboard/css/themes/layout/aside/dark.css')}}" rel="stylesheet" type="text/css" />
<!--end::Layout Themes-->
<link href="{{ asset('assets/dashboard/css/toastr.min.css') }}" rel="stylesheet" type="text/css">
@stack('css')
<style type="text/css">
	html,body{
		font-family: "Cairo", sans-serif !important;
	}
</style>