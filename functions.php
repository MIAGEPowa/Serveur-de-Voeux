<?php

	/**
	* Redirige l'utilisateur vers la vue que l'on souhaite
	*
	* @param string $model Nom du model
	* @param string $action Nom de l'action
	* @param integer $homepage Redirige vers WEBROOT si à 1 
	*/
	function redirection($model, $action = "index", $homepage = 0) {
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		if($homepage)
			header("Location: ".WEBROOT);
		else
			header("Location: ".WEBROOT.$model."/".$action."/");
		
		exit;
	}
	
	/**
	* Génére une chaine de caractère aléatoire
	*
	* @param integer $length Nombre de caractère de la chaine retournée
	*/
	function stringGen($length = 8) {
		$str = 'abcdefghijkmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		for ($i = 0, $passwd = ''; $i < $length; $i++)
			$passwd .= substr($str, mt_rand(0, strlen($str) - 1), 1);
		return $passwd;
	}
	
	/**
	* Transforme une date de la forme "DD/MM/AAAA" en "AAAA-MM-DD"
	*
	* @param string $date Date à transformer
	*/
	function dateNormalToBDD($date) { 
		$date = explode("/", $date);
		$dateTime = $date[2].'-'.$date[1].'-'.$date[0];
		return $dateTime;
	}
	
	/**
	* Transforme une date de la forme "AAAA-MM-DD" en "DD/MM/AAAA"
	*
	* @param string $date Date à transformer
	*/
	function dateBDDToNormal($date) { 
		$date = explode("-", $date);
		$dateTime = $date[2].'/'.$date[1].'/'.$date[0];
		return $dateTime;
	}
?>