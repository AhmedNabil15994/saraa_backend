<link rel="shortcut icon" href="{{asset(config('modules.site_configs.app_favicon'))}}">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Cairo:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">

<link href="{{asset('assets/dashboard/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/dashboard/plugins/global/plugins.bundle.css')}}" rel="stylesheet">
<link href="{{asset('assets/dashboard/plugins/custom/prismjs/prismjs.bundle.css')}}" rel="stylesheet">
@if(DIRECTION == 'ltr')
<link href="{{ asset('assets/dashboard/css/style.bundle.css') }}" rel="stylesheet">
@else
<link href="{{ asset('assets/dashboard/css/style.bundle.rtl.css') }}" rel="stylesheet">
@endif
<link href="{{ asset('assets/dashboard/css/themes/layout/header/base/light.css') }}" rel="stylesheet">
<link href="{{ asset('assets/dashboard/css/themes/layout/header/menu/light.css') }}" rel="stylesheet">
<link href="{{ asset('assets/dashboard/css/themes/layout/brand/dark.css') }}" rel="stylesheet">
<link href="{{ asset('assets/dashboard/css/themes/layout/aside/dark.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/plugins/sweet-alert/sweetalert.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/plugins/sweet-alert/sweetalert.css') }}">
<link href="{{ asset('assets/dashboard/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/dashboard/css/toastr.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ asset('assets/dashboard/css/intlTelInput.css') }}">
<link href="{{asset('ckeditor5/css/ckeditor.css')}}" rel="stylesheet" id="style_components" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/dashboard/css/photoswipe.css') }}" />

<link href="{{ asset('assets/dashboard/css/touches.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/dashboard/css/categories-tree.css') }}" rel="stylesheet" type="text/css" />


<!-- third party css -->
@yield('styles')
@stack('css')
<!-- third party css end -->