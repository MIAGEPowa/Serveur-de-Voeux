<?php
	class FiliereEnseignementEnseignant extends Model {

		var $table = 'filiere_enseignement_enseignant';
		
		function __construct() {
			$this->table = DB_PREFIX.$this->table;
		}
    
    function getFiliereEnseignementEnseignant($id_filiere_enseignement, $id_utilisateur) {
      return $this->query('
				SELECT *
        FROM '.DB_PREFIX.'filiere_enseignement_enseignant 
        WHERE id_filiere_enseignement = '.$id_filiere_enseignement.' 
        AND id_utilisateur = '.$id_utilisateur);
    }
    
    function update($data, $id_filiere_enseignement, $id_utilisateur) {
      $sql = "UPDATE ".DB_PREFIX."filiere_enseignement_enseignant SET ";
     
      foreach($data as $k=>$v){
        if(($k != $id_filiere_enseignement) && ($k != $id_utilisateur)) {
          $sql .= "$k='$v',";
        }
      }
      
      $sql = substr($sql,0,-1);
      $sql .= " WHERE ".$id_filiere_enseignement."=".$data[$id_filiere_enseignement];
      $sql .= " AND ".$id_utilisateur."=".$data[$id_utilisateur];

      mysql_query($sql) or die(mysql_error()."<br/> => ".mysql_query());
    }
  }
?>