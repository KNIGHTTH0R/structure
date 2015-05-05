<!DOCTYPE html>
<html>
	<head>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?=site_url( 'assets/css/styles2.css' );?>">
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
		<link href="<?=site_url();?>assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css"/>
		<title><?=$page_title;?></title>
	</head>
	<body>
		<div class="page-container">
			<nav class="top-nav">
				<div class="nav-logo">
					<img src="<?=site_url( 'images/logo.PNG' );?>" alt="logo">
				</div>
				<ul class="nav-menu">
					<?=fr_get_menu_items( $page_current );?>
					<?php if( ! $this->session->userdata( 'name' ) ): ?>
					<li class="front-login">
						<a href="#front-modal" data-toggle="modal" class="sign-in">
							<i class="fa fa-sign-in"></i> 
							<div class="nav-item">Login</div>
						</a>
					</li>
					<?php else: ?>
					<li class="front-login">
						<a href="javascript:;" class="sign-out">
							<div class="nav-item"><?=$this->session->userdata( 'name' );?></div>
							<i class="fa fa-sign-out"></i>
						</a>
					</li>
					<?php endif ?>
				</ul>	
			</nav>
			<div class="page-content">
				<div class="container">
					<div class="row">
						<div class="col-md-12">