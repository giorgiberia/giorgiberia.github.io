<!DOCTYPE HTML>
<html>
<head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- Bootstrap Core CSS -->
    <link href="<?=base_url('/assets/css/bootstrap.min.css')?>" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="<?=base_url('/assets/css/style.css')?>" rel='stylesheet' type='text/css' />

    <link href="<?=base_url('/assets/css/morris.css')?>" rel="stylesheet"  type="text/css"/>
    <script src="https://unpkg.com/sweetalert2@7.13.1/dist/sweetalert2.all.js"></script>
    <!-- Graph CSS -->
    <link href="<?=base_url('/assets/css/font-awesome.css')?>" rel="stylesheet">
    <!-- jQuery -->
    <script src="<?=base_url('/assets/js/jquery-2.1.4.min.js')?>"></script>
    <!-- //jQuery -->

    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/table-style.css')?>" />
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/basictable.css')?>" />

    <link href='https://fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <!-- lined-icons -->
    <link rel="stylesheet" href="<?=base_url('/assets/css/icon-font.min.css')?>" type='text/css' />
    <!-- //lined-icons -->
</head>
<body>
<div class="main-wthree">
	<div class="container">
	<div class="sin-w3-agile">
		<?php if (isset($alert) && $alert): ?>
                <div class="alert alert-danger" role="alert">
                  მომხ. სახელი ან პაროლი არასწორია
                </div>
         <?php endif ?>
		<h2>ავტორიზაცია</h2>
		<form action="<?=base_url('main/login')?>" method="POST">
			<div class="username">
				<span class="username">მომხმარებელი:</span>
				<input type="text" name="username" class="name" placeholder="" required="">
				<div class="clearfix"></div>
			</div>
			<div class="password-agileits">
				<span class="username">პაროლი:</span>
				<input type="password" name="password" class="password" placeholder="" required="">
				<div class="clearfix"></div>
			</div>
		<!-- 	<div class="rem-for-agile">
				<input type="checkbox" name="remember" class="remember">Remember me<br>
				<a href="#">Forgot Password</a><br>
			</div> -->
			<div class="login-w3">
					<input type="submit" class="login" value="შესვლა">
			</div>
			<div class="clearfix"></div>
		</form>
<!-- 				<div>
					<a href="<?base_url();?>">მთავარი</a>
				</div> -->
				
	</div>
	</div>	</div>


</div> <!-- mother-grid-inner -->
</div> <!-- left content -->
</div> <!-- page container -->
<!--js -->
<script src="<?=base_url()?>/assets/js/jquery.nicescroll.js"></script>
<script src="<?=base_url()?>/assets/js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?=base_url()?>/assets/js/bootstrap.min.js"></script>
<!-- /Bootstrap Core JavaScript -->

</body>
</html>

