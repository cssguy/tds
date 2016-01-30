<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>TDS - Панель администратора</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="<?php echo "$home_url";?>/favicon.ico" type="image/x-icon" >
<script src="<?php echo "$home_url";?>/javascripts/jquery.js"></script>
<link href="<?php echo "$home_url";?>/stylesheets/datepicker.min.css" rel="stylesheet" type="text/css">
<script src="<?php echo "$home_url";?>/javascripts/datepicker.min.js"></script>
<script src="<?php echo "$home_url";?>/javascripts/datepicker_setting.js"></script>
<script type="text/javascript" src="<?php echo "$home_url";?>/javascripts/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo "$home_url";?>/javascripts/new.js"></script>
</head>
<body>
<div class="wrapper">
<header>
<a href="index.php" class="logo">TDS</a>
<ul class="nav">
<li><a href="index.php?view=drivers">Пользователи</a></li>
<li><a href="index.php?view=transports">Транспорт</a></li>
<li><a href="index.php?view=cargos">Груз</a></li>
		<li><a href="transport_new.php">Добавить транспорт</a></li>
		<li><a href="cargo_new.php">Добавить груз</a></li>
		<li><a href="index.php?do=logout">Выход</a></li>
</ul>
</header>