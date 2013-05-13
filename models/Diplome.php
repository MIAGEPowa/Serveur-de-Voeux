<?php
	class Diplome extends Model {

		var $table = 'smed_diplome';
		
		function getAll() {
			return $this->find(array(
				'order' => 'libelle ASC'
			));
		}
	}
?>