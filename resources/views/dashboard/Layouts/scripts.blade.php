<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Tajawal" };
</script>
<script src="{{asset('assets/dashboard/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('assets/dashboard/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
<script src="{{asset('assets/dashboard/js/scripts.bundle.js')}}"></script>
<script src="{{asset('assets/dashboard/plugins/custom/datatables/datatables.bundle.js')}}"></script>

<script src="{{ asset('assets/dashboard/plugins/moment/moment.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/toastr.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/components/notifications.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/intlTelInput-jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/dashboard/js/utils.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/dashboard/plugins/sweet-alert/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/sweet-alert/jquery.sweet-alert.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/photoswipe.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/photoswipe-ui-default.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/components/myPhotoSwipe.js') }}"></script> 
<script src="{{asset('ckeditor5/js/ckeditor.js')}}"></script>
<script src="{{asset('ckeditor5/js/ckEditorScripts.js')}}"></script>
<script src="{{ asset('assets/dashboard/components/globals.js') }}"></script>
<script src="{{ asset('assets/dashboard/components/categories-tree.js') }}"></script>

<!-- third party js -->


@yield('scripts')
@stack('js')
<!-- third party js ends -->