<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>Unknown : <?=$pageTitle?></title>
	<meta name="description" content="Directory of Design and Marketing Professionals">
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" /> 
	<meta name="viewport" content="width=device-width">

	<link href="/css/blog.css" rel="stylesheet" media="screen">
	<!-- Bootstrap -->
	<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<script src="/bootstrap/js/bootstrap.min.js"></script>
	<script src="/js/jquery-1.8.2.min.js"></script>
	
</head>
<body>
	<?php
		if($this->tank_auth->is_logged_in()){
	?>
			<div class="navbar navbar-inverse navbar-fixed-top">
				<div class="navbar-inner">
					<a class="brand" href="#">Title</a>
					<ul class="nav">
						<?php
							if($this->uri->rsegment(1) == "admin"){
						?>
							<li><a href="/">Visit</a></li>
						<?php
							}else{
						?>
								<li><a href="/admin/">Admin</a></li>
								<li><a href="#">Edit</a></li>
						<?php
							}
						?>
						<li><a href="/auth/logout">Logout</a></li>
					</ul>
				</div>
			</div>
	<?php
		}
	?>


	<div id="page-wrap" class="container-fluid">
		<header class="jumbotron subhead" id="overview">
			<div class="container">
				<h1>Components</h1>
				<p class="lead">Dozens of reusable components built to provide navigation, alerts, popovers, and more.</p>
			</div>
		</header>
