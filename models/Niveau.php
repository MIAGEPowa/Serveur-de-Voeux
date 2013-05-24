<?php
	class Niveau extends Model {

		var $table = 'niveau';
		
		function __construct() {
			$this->table = DB_PREFIX.$this->table;
		}
		
		function getAll() {
			return $this->query('
				SELECT N.id as id_niveau, N.libelle as libelle_niveau, D.libelle as libelle_diplome
				FROM '.DB_PREFIX.'niveau N, '.DB_PREFIX.'diplome D 
				WHERE N.id_diplome = D.id 
				ORDER BY libelle_niveau ASC
				'
			);
		}
    
    function checkNiveauLibelle($libelle) {
			return $this->find(array(
				'conditions' => 'libelle = "' . $libelle . '"'
			));
		}
    
    function getNiveau($id) {
			return $this->find(array(
				'conditions' => 'id='.$id
			));
		}
	}
?>