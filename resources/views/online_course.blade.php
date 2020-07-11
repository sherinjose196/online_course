<!DOCTYPE HTML>
<!--
	Caminar by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Online Course</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="{{ asset('assets/frontend/css/main.css')}}" />
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<div class="logo"><a href="#">Online <span>Course</span></a></div>
			</header>

		<!-- Main -->
			<section id="main">
				<div class="inner">

				<!-- One -->
					<section id="one" class="wrapper style1">

						<div class="image fit flush">
							<video  poster="{{ url('data/temp/'.$course->video) }}" controls>
                           <source src="{{ url('data/temp/'.$course->video) }}" type="video/mp4">
						</div>
						<header class="special">
							<h2>{{$course->category}}</h2>
							<p>vehicula urna sed justo bibendum</p>
						</header>
						<div class="content">
							<p>{{$course->description}}</p>
							
						</div>
					</section>

				<!-- Two -->
					

		<!-- Footer -->
			<footer id="footer">
				<div class="container">
					<ul class="icons">
						<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
					</ul>
				</div>
				<div class="copyright">
					&copy; Untitled. All rights reserved. Images <a href="https://unsplash.com">Unsplash</a> Design <a href="https://templated.co">TEMPLATED</a>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="{{ asset('assets/frontend/js/jquery.min.js')}}"></script>
			<script src="{{ asset('assets/frontend/js/jquery.poptrox.min.js')}}"></script>
			<script src="{{ asset('assets/frontend/js/skel.min.js')}}"></script>
			<script src="{{ asset('assets/frontend/js/util.js')}}"></script>
			<script src="{{ asset('assets/frontend/js/main.js')}}"></script>

	</body>
</html>