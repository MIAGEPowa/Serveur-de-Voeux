<?php
	class Filiere extends Model {

		var $table = 'smed_filiere';
		
		function getFiliereName($id_filiere) {
			$req = $this->query('
						SELECT n.libelle as niveau, s.libelle as specialite, f.apprentissage
						FROM smed_filiere f, smed_niveau n, smed_specialite s
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
		
	}
?>