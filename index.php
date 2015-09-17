<!DOCTYPE html>
<html>
<head>
	<title>Phone Book</title>
	<link rel='stylesheet' href='index.css'>
	<link rel="shortcut icon" href="Phone.png" type="image/png">
	<meta name="description" content="Free Phone Book">
	<meta name="keywords" content="Phone Book">
	<meta name="author" content="Slobodan Nedeljkovic">
</head>
<body>
	<div class="username">
		<?php require('common.php');?>
	</div>
	<div class="header">
		<h1>Your best Phone Book!</h1>
		<?php
		if($_SESSION['MessageU'] !== ""){
			echo $_SESSION['MessageU'];
		}
		if($_SESSION['MessageA'] !== ""){
			echo $_SESSION['MessageA'];
		}
		$_SESSION['MessageU'] = "";
		$_SESSION['MessageA'] = "";
		?>
	</div>
	<div class="container">
		<div class="containerLeft">
			<?php require('search.php'); ?>
		</div>
		<div class="containerRight">
			<?php
			if($_SESSION['UserId'] == 1 || $_SESSION['UserId'] == 2){
				require('form.php');
			}
			?>
		</div>
		<div class="clearFix">
		</div>
	</div>
	<div class="footer">
	</div>
</body>
</html>