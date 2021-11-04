<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ auth()->user()->business->theme }}">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{ asset('assets/attachment/business/'.auth()->user()->business->icon) }}" type="image/png" />
	<!--plugins-->
	<link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />

	<link href="{{ asset('assets/plugins/datetimepicker/css/classic.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/datetimepicker/css/classic.time.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/datetimepicker/css/classic.date.css') }}" rel="stylesheet" />

	<!-- loader-->
	<link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
	<script src="{{ asset('assets/js/pace.min.js') }}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/dark-theme.css') }}" />
	<link rel="stylesheet" href="{{ asset('assets/css/semi-dark.css') }}" />
	<link rel="stylesheet" href="{{ asset('assets/css/header-colors.css') }}" />
	<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />
	<title>@yield('title',auth()->user()->business->name." - ".auth()->user()->business->slogan)</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		@include('layouts.aside')
		<!--end sidebar wrapper -->
		<!--start header -->
		@include('layouts.header')
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
		@yield('content')
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		@include('layouts.footer')
	</div>
	<!--end wrapper-->
	<!--start switcher-->
	@include('layouts.theme')
	<!--end switcher-->
	<!-- Bootstrap JS -->
	<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
	<!--plugins-->
	<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
	{{-- <script src="{{ asset('assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script> --}}
	<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
	<script src="{{ asset('assets/js/table-datatable.js') }}"></script>

	<script src="{{ asset('assets/plugins/datetimepicker/js/legacy.js') }}"></script>
	<script src="{{ asset('assets/plugins/datetimepicker/js/picker.js') }}"></script>
	<script src="{{ asset('assets/plugins/datetimepicker/js/picker.time.js') }}"></script>
	<script src="{{ asset('assets/plugins/datetimepicker/js/picker.date.js') }}"></script>
	<script src="{{ asset('assets/plugins/bootstrap-material-datetimepicker/js/moment.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/bootstrap-material-datetimepicker/js/moment.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js') }}"></script>
	<script src="{{ asset('assets/js/form-date-time-pickes.js') }}"></script>




	<!--app JS-->
	<script src="{{ asset('assets/js/app.js') }}"></script>

	{{-- Pay Order Bill --}}
	<script>
		$('#received').keyup(function() {
			var net_amount   = parseFloat($('#net_amount').val());
			var received = parseFloat($('#received').val());
			$('#change_return').val(received - net_amount);
			$('#wallet_credit').val(0);
		});
		$('#change_return').keyup(function() {
			var net_amount   = parseFloat($('#net_amount').val());
			var received = parseFloat($('#received').val());
			var change_return   = parseFloat($('#change_return').val());
			$('#wallet_credit').val((received - net_amount) - change_return);
		});
		$('#zero_wallet_debit').click(function() {
			var wallet_debit = parseFloat($('#wallet_debit').val());
			var net_amount   = parseFloat($('#net_amount').val());
			$('#net_amount').val(net_amount + wallet_debit);
			$('#received').val(net_amount + wallet_debit);
			$('#wallet_debit').val(0);
			$('#wallet_credit').val(0);
			$('#change_return').val(0);
		});
	</script>
	</body>
</html>
