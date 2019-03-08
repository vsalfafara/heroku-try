<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Solex Argo Ferry Corporation</title>
		<link rel="stylesheet" href="<?= base_url() ?>assets/css/admin.css">
		<link rel="stylesheet" href="<?= base_url() ?>assets/css/icon.css">
	</head>
	<body>
		<aside>
			<div class="company">
				<h3>Solex Argo Ferry <br>Corporation</h3>
			</div>
			<div class="profile">
				<div class="circle">
					<img src="<?= base_url()?>assets/images/profile.png" alt="">
				</div>
				<div class="profile-name">
					<p><?= $admin ?></p>
					<p><?= $username ?></p>
				</div>
			</div>
			<ul>
				<li><a href="<?= base_url()?>admin/index"><i class="material-icons">insert_chart</i>Administration</a></li>
				<li><a href="<?= base_url()?>admin/dashboard"><i class="material-icons">insert_chart</i>Dashboard</a></li>
				<li><a href="<?= base_url()?>auth/logout"><i class="material-icons">exit_to_app</i>Logout</a></li>
			</ul>
		</aside>
		<div class="white-space"></div>
		<div class="content">