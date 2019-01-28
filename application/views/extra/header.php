<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" href="<?= base_url() ?>assets/css/main.css">
		<link rel="stylesheet" href="<?= base_url() ?>assets/css/icon.css">
	</head>
	<body>
	<div id="overlay">
		<aside class="side-hide">
			<i id="side-close" class="material-icons">dehaze</i>
			<h1><?= $agent ?></h1>
			<ul>
				<li>
					<a href="<?= base_url()?>agent/index">Booking</a>
				</li>
				<li>
					<a href="<?= base_url()?>agent/history">Ticket History</a>
				</li>
				<li>
					<a href="<?= base_url()?>login/logout">Logout</a>
				</li>
			</ul>
		</aside>
	</div>
	<nav>
		<div class="container">
			<p>Solex Argo Ferry Corporation</p>
			<!-- REMOVE A TAG ONCE SIDEBAR DESIGN IS UP -->
			<i id="side-open" class="material-icons">dehaze</i>
		</div>
	</nav>