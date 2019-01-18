<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" href="<?= base_url() ?>assets/css/icon.css">
		<link rel="stylesheet" href="<?= base_url() ?>assets/css/login.css">
	</head>
	<body>
	<div class="wrapper">
		<div class="company valign-wrapper">
			<div class="container">
				<h1>SOLEX ARGO <br> FERRY CORPORATION</h1>
				<p class="ph">Philippines 2016</p>
				<hr>
			</div>
		</div>
		<div class="login valign-wrapper">
			<div class="container">
				<h2>Login to your account</h2>
				<?php 
					if (isset($login_error)) echo '<p>'.$login_error.'</p>';
				?>
				<?= validation_errors(); ?>
				<?= form_open('login/login'); ?>
					<div class="flex">
						<i class="material-icons">perm_identity</i>
						<input type="text" name="username" placeholder="Enter Your Username">
					</div>
					<div class="flex">
						<i class="material-icons">lock_outline</i>
						<input type="password" name="password" placeholder="Enter Your Password">
					</div>
					<button type="submit">LOGIN</button>
				</form>
			</div>
		</div>
	</div>
	</body>
</html>