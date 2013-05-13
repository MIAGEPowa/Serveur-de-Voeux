<?php
	class Controller {

		var $vars = array();
		var $layout = 'default';

		function __construct() {
			if(isset($_POST)) {
				foreach(array_keys($_POST) as $key) {
					if(is_array($_POST[$key])) {
						// pour les input tableau
						foreach(array_keys($_POST[$key]) as $key2) {
							$_POST[$key][$key2] = mysql_real_escape_string($_POST[$key][$key2]);
						}
					}
					else {
						$_POST[$key] = mysql_real_escape_string($_POST[$key]);
					}
				}
			}
			if(isset($this->models)){
				foreach($this->models as $v){
					$this->loadModel($v); 
				}
			}		
		}

		function set($d) {
			$this->vars = array_merge($this->vars, $d);
		}

		function render($filename) {
			extract($this->vars);
			
			// On stocke le contenu de la vue dans $content_for_layout et on affiche le layout par défaut
			ob_start(); 
			require(ROOT.'views/'.get_class($this).'/'.$filename.'.php');
			$content_for_layout = ob_get_clean();
			require(ROOT.'views/layout/'.$this->layout.'.php');
		}

		function loadModel($name) {
			require_once(ROOT.'models/'.$name.'.php');
			$this->$name = new $name(); 
		}
	}
?>