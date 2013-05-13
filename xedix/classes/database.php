<?php
//Database
class Database {

	public function __construct($serveur,$login,$password){
		$url_appel=$serveur."client?X2Admin+13++login=".$login."&pwd=".urlencode($password)."&output=xml";
	
if($xml=simplexml_load_file(rawurlencode($url_appel))){
		

		if(isset($xml->erreur)){
			echo "Erreur - ".$xml->erreur;
		}else{
			echo "Connexion - ID de session ".$xml->clefsession;
		}



}else{

echo "Erreur - Connexion au serveur impossible";

}
		
		
		

	}



}


?>