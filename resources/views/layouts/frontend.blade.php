<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<meta charset="utf-8" />
	<title>SAF Artist Form</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<!--end::Fonts-->
	<!--begin::Global Theme Styles(used by all pages)-->
	<link href="{{asset('plugins/global/plugins.bundlef552.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{asset('css/frontend_style.css') }}" rel="stylesheet" type="text/css" />
	<!--end::Global Theme Styles-->
	<!--begin::Layout Themes(used by all pages)-->
	<link href="{{asset('css/themes/layout/header/base/lightf552.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{asset('css/themes/layout/header/menu/lightf552.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{asset('css/themes/layout/brand/darkf552.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{asset('css/themes/layout/aside/darkf552.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/custom.css') }}" rel="stylesheet" type="text/css" />
    <meta name="token" content="{{ csrf_token() }}">
    
	@stack('style')
</head>
<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
	
	
		<div id="app">

	        <main class="">
	        	@if(request()->segment(1) == '')
	        	@else
        			@include('frontend/includes/header')
    			@endif
	            @yield('content')
	        </main>

	    </div>

		<script src="{{asset('plugins/global/plugins.bundlef552.js?v=7.1.8')}}"></script>
		<script src="{{asset('plugins/custom/prismjs/prismjs.bundlef552.js?v=7.1.8')}}"></script>
		<script src="{{asset('js/scripts.bundlef552.js?v=7.1.8')}}"></script>

	    <!-- Custom Scripts -->
	    <script src="{{asset('js/custom/index.js')}}"></script>
	
	</body>
	<!--end::Body-->

	@stack('scripts')

	<script type="text/javascript">

		var KTAppSettings;
		var KTSummernoteDemo = function () {
			// Private functions
			var demos = function () {
				$('.summernote-editor').summernote({
					height: 150
				});
			}

			return {
				// public functions
				init: function() {
					demos();
				}
			};
		}();

		// Initialization
		jQuery(document).ready(function() {
			KTSummernoteDemo.init();
		});
	</script>
	
	<script type="text/javascript">
		// Class definition

		var KTBootstrapDatepicker = function () {

			var arrows;
			if (KTUtil.isRTL()) {
				arrows = {
					leftArrow: '<i class="la la-angle-right"></i>',
					rightArrow: '<i class="la la-angle-left"></i>'
				}
			} else {
				arrows = {
					leftArrow: '<i class="la la-angle-left"></i>',
					rightArrow: '<i class="la la-angle-right"></i>'
				}
			}

			// Private functions
			var demos = function () {
				// minimum setup
				$('.kt_datepicker').datepicker({
					rtl: KTUtil.isRTL(),
					todayHighlight: true,
					orientation: "bottom left",
					templates: arrows,
					autoClose: true,
					format: 'dd-mm-yyyy',
				});
			}

			return {
				// public functions
				init: function() {
					demos();
				}
			};
		}();

		jQuery(document).ready(function() {
			KTBootstrapDatepicker.init();
		});
	</script>

	<script type="text/javascript">
		// Class definition

		var KTBootstrapTimepicker = function () {

			// Private functions
			var demos = function () {
				// minimum setup
				$('.kt_timepicker').timepicker({
					minuteStep: 1,
					defaultTime: '',
					showSeconds: false,
					showMeridian: false,
					snapToStep: true
				});
			}

			return {
				// public functions
				init: function() {
					demos();
				}
			};
		}();

		jQuery(document).ready(function() {
			KTBootstrapTimepicker.init();
		});
	</script>
</html>

<!-- js/pages/crud/file-upload/dropzonejsf552.js -->