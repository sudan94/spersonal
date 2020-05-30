<!DOCTYPE html>
<html lang="en">


<head>

	<!-- Meta -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<!-- Title -->
	<title>Sudan - Blog</title>

	<!-- CSS Plugins -->
	<link rel="stylesheet" href="{{url('website/css/plugins/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{url('website/css/plugins/font-awesome.css')}}">
	<link rel="stylesheet" href="{{url('website/css/plugins/magnific-popup.css')}}">
	<link rel="stylesheet" href="{{url('website/css/plugins/simplebar.css')}}">
	<link rel="stylesheet" href="{{url('website/css/plugins/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{url('website/css/plugins/owl.theme.default.min.css')}}">
	<link rel="stylesheet" href="{{url('website/css/plugins/jquery.animatedheadline.css')}}">

	<!-- CSS Base -->
	<link rel="stylesheet" class="back-color" href="{{url('css/style-dark.css')}}">
	<link rel="stylesheet" href="{{url('website/css/style-demo.css')}}">

	<!-- Settings Style -->
	<link rel="stylesheet" class="posit-nav" href="{{url('website/css/settings/left-nav.css')}}" />
	<link rel="stylesheet" class="theme-color" href="{{url('website/css/settings/green-color.css')}}" />
	<link rel="stylesheet" class="box-st" href="{{url('website/css/settings/circle-box.css')}}" />

</head>

<body>
	<!--Blog Page-->
	@foreach($blog as $blogs)
	<div class="blog-page" data-simplebar>
		<div class="blog-image">
		<?php $name= $blogs->file; ?>
			<img src="{{url('uploads/'.$name)}}" alt="">
		</div>
		<div class="row blog-container">
			<div class="col-md-10 offset-md-1">

				<!-- Heading -->
				<div class="blog-heading pt-70 pb-100">
					<h2>
						{{$blogs->title}}
					</h2>
					<span><i class="fas fa-home"></i><a href="#">{{$blogs->category}}</a></span>
					<!-- <span><i class="fas fa-comment"></i><a href="#">5 comments</a></span> -->
					<span><i class="fas fa-calendar-alt"></i>{{$blogs->date}}</span>
				</div>

				<!-- Content -->
				<div class="blog-content">
					<?php echo $blogs->description; ?>
				</div>
			</div>
		</div>
	</div>
@endforeach
	<!-- All Script -->
	<script src="{{url('website/js/isotope.pkgd.min.js')}}"></script>
	<script src="{{url('website/js/bootstrap.min.js')}}"></script>
	<script src="{{url('website/js/simplebar.js')}}"></script>
	<script src="{{url('website/js/owl.carousel.min.js')}}"></script>
	<script src="{{url('website/js/jquery.magnific-popup.min.js')}}"></script>
	<script src="{{url('website/js/jquery.animatedheadline.min.js')}}"></script>
	<script src="{{url('website/js/jquery.easypiechart.js')}}"></script>
	<script src="{{url('website/js/jquery.validation.js')}}"></script>
	<script src="{{url('website/js/tilt.js')}}"></script>
	<script src="{{url('website/js/main.js')}}"></script>
	<script src="{{url('website/js/main-demo.js')}}"></script>
	<script src="https://maps.google.com/maps/api/js?sensor=false"></script>
</body>


</html>