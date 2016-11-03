<?php include $_SERVER['DOCUMENT_ROOT']."/escala_web/util/init.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>EscalaWeb</title>
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<link href='http://fonts.googleapis.com/css?family=Belgrano'
	rel='stylesheet' type='text/css'>
	<!-- jQuery file -->
	<script src="../js/jquery.min.js"></script>
	<script src="../js/jquery.tabify.js" type="text/javascript"
		charset="utf-8"></script>
	<script type="text/javascript">
		var $ = jQuery.noConflict();
		$(function() {
			$('#tabsmenu').tabify();
			$(".toggle_container").hide();
			$(".trigger").click(function() {
				$(this).toggleClass("active").next().slideToggle("slow");
				return false;
			});
		});
	</script>
</head>
<body>
	<div id="panelwrap">

		<div class="header">
			<div class="title">
				<a href="#">EscalaWeb</a>
			</div>

			<div class="header_right">
				Bem-vindo John, <!-- <a href="#" class="settings">Configurações</a>--> <a href="#"
					class="logout">Sair</a>
			</div>

			<div class="menu">
				<ul>
					<li><a href="#" class="selected">Home</a></li>
			
				</ul>
			</div>

		</div>

		<div class="submenu">
			  <ul>
				<!-- <li><a href="#" class="selected">settings</a></li>
				<li><a href="#">users</a></li>
				<li><a href="#">categories</a></li>
				<li><a href="#">edit section</a></li>
				<li><a href="#">templates</a></li> -->
			</ul>
		</div>

		<div class="center_content">

			<div id="right_wrap">
				<div id="right_content">
					
				