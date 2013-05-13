<?php
	class Enseignement extends Model {

		var $table = 'smed_enseignement';
		
		function deleteEnseignement($id=null) {
			// delete des keywords associés
			$this->deleteQuery("DELETE FROM smed_keyword WHERE id_enseignement=$id");
			// delete de l'enseignement
			$this->del($id);
		}
	}
?>