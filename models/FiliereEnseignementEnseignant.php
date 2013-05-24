<?php
	class FiliereEnseignementEnseignant extends Model {

		var $table = 'filiere_enseignement_enseignant';
		
		function __construct() {
			$this->table = DB_PREFIX.$this->table;
		}
  }
?>