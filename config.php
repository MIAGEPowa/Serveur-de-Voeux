<?php

	define('WEBROOT', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
	define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
	define('CSS_DIR', WEBROOT.'views/css/');
	define('JS_DIR', WEBROOT.'views/js/');
	define('IMG_DIR', WEBROOT.'views/img/');
	define('LAYOUT_DIR', ROOT.'views/layout/');
	define('SECRET_KEY', 'wh3N57$$GuT$KL@b578ySq4q%dW=$%V7');
	define('EMAIL_ADMIN', 'a.auberton@gmail.com');
	define('EMAIL_LABEL', 'Serveur de voeux administrateur');
	define('DB_PREFIX', 'smed_');
  define('PAGE_TITLE', 'Etat de service');

	require(ROOT.'core/model.php');
	require(ROOT.'core/controller.php');
	
	session_start();
	
	mysql_connect('mysql51-55.perso', 'aymericahk98', 'r338oKQoWwM1');
	mysql_select_db('aymericahk98');
	mysql_query("SET NAMES 'UTF8'");

?>