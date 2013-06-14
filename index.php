<?php

	require('functions.php');
	require('config.php');
	$error_404 = 0;
	
	if(isset($_GET['p']) && !empty($_GET['p']) && $_SESSION['v_connected']) {
		$params = explode('/', $_GET['p']);
		$controller = ucwords($params[0]).'Controller';
		$action = isset($params[1]) ? $params[1] : 'index';

		if(file_exists('controllers/'.$controller.'.php')) {
			require('controllers/'.$controller.'.php');
			$controller = new $controller();
			if(method_exists($controller, $action)) {
				unset($params[0]);
				unset($params[1]);
			} else {
				$error_404 = 1;
			}
			call_user_func_array(array($controller, $action), $params);
		} else {
			$error_404 = 1;
		}
		
		if($error_404) {
			require('controllers/NotfoundController.php');
			$controller = new NotfoundController();
			$params = array();
			call_user_func_array(array($controller, $action), $params);
		}
		
	} else {
		// Si l'utilisateur est connecté, ne pas lui afficher la page d'authentification mais le rediriger sur le tableau de bord
		if($_SESSION['v_connected']) {
			redirection("tableaudebord", "index");
		} else {
			if(empty($_GET['p'])) {
				require('controllers/AuthentificationController.php');
				$controller = new AuthentificationController();
				$params = array();
				call_user_func_array(array($controller, 'index'), $params);
			} else {
				redirection(false, false, 1);
			}
		}
	}

?>