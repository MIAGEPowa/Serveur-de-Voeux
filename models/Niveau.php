<?php
	class Niveau extends Model {

		var $table = 'smed_niveau';
		
		function getAll() {
			return $this->query('
				SELECT N.id as id_niveau, N.libelle as libelle_niveau, D.libelle as libelle_diplome
				FROM smed_niveau N, smed_diplome D 
				WHERE N.id_diplome = D.id 
				ORDER BY libelle_niveau ASC
				'
			);
		}		
	}
?>