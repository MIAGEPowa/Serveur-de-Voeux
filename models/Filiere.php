<?php
	class Filiere extends Model {

		var $table = 'filiere';
		
		function __construct() {
			$this->table = DB_PREFIX.$this->table;
		}
		
		function getFiliereName($id_filiere) {
			$req = $this->query('
						SELECT n.libelle as niveau, s.libelle as specialite, f.apprentissage
						FROM '.DB_PREFIX.'filiere f, '.DB_PREFIX.'niveau n, '.DB_PREFIX.'specialite s
						WHERE f.id_niveau = n.id
						AND f.id_specialite = s.id
						AND f.id = '. $id_filiere
			);
			
			$name = $req[0]['niveau'].' '.$req[0]['specialite'];
			if($req[0]['apprentissage'])
				$name .= ' Apprentissage';
			else
				$name .= ' Initial';
			
			return $name;			
		}
		
		function getEnseignements($id_filiere) {
			$req = $this->query('
						SELECT * 
						FROM '.DB_PREFIX.'enseignement e, '.DB_PREFIX.'filiere_enseignement fe
						WHERE e.id = fe.id_enseignement 
						AND fe.id_filiere = '.$id_filiere
			);
			return $req;
		}
		
	}
?>