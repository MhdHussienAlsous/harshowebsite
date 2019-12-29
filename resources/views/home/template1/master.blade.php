<?php

function printRecursive($item) {
	if ($item->children->count() != 0) {
		?>
		<li class="dropdown" >
			<a href="section/{{$item->id}}" class="test" tabindex="-1"><span class="caret"></span> <?php echo $item->name ?> </a>
			<ul class="dropdown-menu"> 
				<?php 
				foreach($item->children as $subMenu) {
					?>
					<?php printRecursive($subMenu); ?>
					<?php
				}
				?>
			</ul>
		</li>
		<?php
	} else { ?>
		<li><a href="/section/{{$item->id}}"><?php echo $item->name ?></a></li>
	<?php  }
}
?>
@php
$menus = App\Menu::where('parent',0)->orderBy('menus.id', 'asc')->with('children')->get();
@endphp
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Hashtag هاشتاغ  </title>

	<link rel="icon" href="/icontab.png" type="image/png">
	<!-- include bootstrap files -->
	<link rel="stylesheet" type="text/css" href="{{ asset('home/template1/css/bootstrap.min.css') }}">
	<script type="text/javascript" src="{{ asset('home/template1/js/jquery-3.4.1.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('home/template1/js/bootstrap.min.js') }}"></script>

	<!-- include fontawesome  -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- include custom css -->
	<link rel="stylesheet" type="text/css" href="{{ asset('home/template1/css/style.css') }}">


	<!-- include custom js -->
	<script type="text/javascript" src="{{ asset('home/template1/js/custom.js') }}"></script>

	<!-- include social share  -->
	<link rel="stylesheet" type="text/css" href="{{ asset('home/template1/css/jquery.floating-social-share.min.css') }}">
	<script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
	<script type="text/javascript" src="{{ asset('home/template1/js/jquery.floating-social-share.min.js') }}"></script>
	<script async src="//pagead2.googlesyndication.com//js/adsbygoogle.js"></script>
	<script>
		(adsbygoogle = window.adsbygoogle || []).push({
		google_ad_client: "pub-6099542737160054",
		enable_page_level_ads: true
		});
	</script>
	@yield('header')

</head>
<body>
	<!-- start navbar -->
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>                        
				</button>
				<a class="navbar-brand" href="/">
					<img src="{{ asset('home/template1/images/logo.png') }}" class="img-responsive">
				</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<?php 
					foreach($menus as $item){
						printRecursive($item);
					}
					?>
				</ul>
				<ul class="nav navbar-nav navbar-right text-center">
                    <li><a href="https://www.facebook.com/hashtagsyriaOfficial2/" target="_blank"><i class="fa fa-facebook"></i></a></li>
					<li><a href="#"><i class="fa fa-instagram" target="_blank"></i></a></li>
					<li><a href="https://t.me/hashtagsy" target="_blank"><i class="fa fa-telegram"></i></a></li>
					<li><a href="https://www.youtube.com/channel/UCMmc8UM93WUdBefvbJoN2jg" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
					<p class="text-center date">{{ \Carbon\Carbon::today()->format('Y-m-d')}}</p>
				</ul>
			</div>
		</div>
	</nav>
	<!-- end navbar -->


	<!-- start content section -->
	@yield('content')
	<!-- end content section -->





	<!-- start footer -->

	<div class="footer">
		<div class="footer-up">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 text-center">
						<div class="logo pull-left">
							<img src="{{ asset('home/template1/images/logo.png') }}" class="img-responsive">
						</div>
					</div>
					<div class="col-lg-4">
						
					</div>
					<div class="col-lg-4">
						<div class="social ">
							<ul class="nav navbar-nav navbar-right text-center pull-right">
								<li><a href="https://www.facebook.com/hashtagsyriaOfficial2/"><i class="fa fa-facebook"></i></a></li>
            					<li><a href="#"><i class="fa fa-instagram"></i></a></li>
            					<li><a href="https://t.me/hashtagsy"><i class="fa fa-telegram"></i></a></li>
				                <li><a href="https://www.youtube.com/channel/UCMmc8UM93WUdBefvbJoN2jg"><i class="fa fa-youtube-play"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-down text-center">
			<div class="container">
				<p>COPYRIGHT BY Yala-Group</p>
			</div>
		</div>
	</div>

	<!-- end footer -->

</body>
</html>