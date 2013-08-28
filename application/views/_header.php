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

	<link href="<?=THEME?>/css/blog.css" rel="stylesheet" media="screen">
	<script src="/js/jquery-1.8.2.min.js"></script>
	<link href="/css/ui-lightness/jquery-ui-1.9.1.custom.css" rel="stylesheet">
	<script src="/js/jquery-ui-1.9.1.custom.min.js"></script>
	<!-- Bootstrap -->
	<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<script src="/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$('.dropdown-toggle').dropdown()
	</script>

	

	
</head>
<body>
	<?php
		if(isset($page)){
			$this->blog->adminBar($page['post_id']);
		}else
		{
			$this->blog->adminBar();
		}
	?>
	
	<div id="page-wrap" class="container-fluid">
		<header class="jumbotron subhead" id="overview">
			<div class="container">
				<h1><?=SITENAME?></h1>
				<p class="lead"><?=TAGLINE?></p>
			</div>
		</header>
		<div class="container-fluid">
