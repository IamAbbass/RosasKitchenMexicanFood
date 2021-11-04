<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{ asset('assets/attachment/business/'.auth()->user()->business->icon) }}" type="image/png" />
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
	<style>
		body {
			color: #000000;
		}
		.page-content {
			padding: 0 !important;
		}
		.page-breadcrumb {
			padding: 10px !important;
		}
		.price_header {
			text-align: right;
			font-weight: bold;
			margin: 0;
		}
		.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
			color: #000000 !important;
		}
		.hidden-view
		{
			visibility: hidden !important;
			display: none !important;
		}
		@media print
		{    
			.hidden-view
			{
				visibility: visible !important;
				display: block !important;
			}
			.hidden-print
			{
				visibility: hidden !important;
				display: none !important;
			}
			.card {
				border: none;
				border-radius: unset;
				margin-bottom: unset;
				box-shadow: none;
				margin-bottom: 1.0rem;
			}
		}
	</style>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--start page wrapper -->
		<!-- <div class="page-wrapper"> -->
		@yield('content')
		<!-- </div> -->
		<!--end page wrapper -->
	</div>
	<!--end wrapper-->
</body>
</html>