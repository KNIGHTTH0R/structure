<!DOCTYPE html>
<html>
	<head>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?=site_url( 'assets/css/styles2.css' );?>">
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
		
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<title><?=$page_title;?></title>
	</head>
	<body>
		<div class="page-container">
			<nav class="top-nav">
				<div class="nav-logo">
				</div>
				<ul class="nav-menu">
					<?=fr_get_menu_items();?>
				</ul>	
			</nav>
			<div class="page-content">
				<div class="container">
					<div class="row">
						<div class="col-md-12">