<?php
	class FiliereEnseignementEnseignant extends Model {

		var $table = 'filiere_enseignement_enseignant';
		
		function __construct() {
			$this->table = DB_PREFIX.$this->table;
		}
    
    function getAllByUser($id_utilisateur) {
      return $this->query('
				SELECT F.apprentissage as filiere_apprentissage, S.libelle as specialite_libelle, N.libelle as niveau_libelle, E.libelle as enseignement_libelle, annee, FEE.nbr_h_cours as fee_nbr_h_cours, FEE.nbr_h_td as fee_nbr_h_td, FEE.nbr_h_tp as fee_nbr_h_tp
        FROM '.DB_PREFIX.'filiere_enseignement_enseignant FEE, '.DB_PREFIX.'utilisateur U, '.DB_PREFIX.'filiere_enseignement FE, '.DB_PREFIX.'filiere F, '.DB_PREFIX.'enseignement E, '.DB_PREFIX.'niveau N, '.DB_PREFIX.'specialite S
        WHERE FEE.id_utilisateur = U.id
        AND FEE.id_filiere_enseignement	= FE.id
        AND FE.id_enseignement = E.id
        AND FE.id_filiere = F.id
        AND F.id_niveau = N.id
        AND F.id_specialite = S.id
        AND U.id = '.$id_utilisateur);
    }
    
    function getAllByFiliereEnseignement($id_filiere_enseignement) {
      return $this->query('
				SELECT *
        FROM '.DB_PREFIX.'filiere_enseignement_enseignant FEE, '.DB_PREFIX.'utilisateur U 
        WHERE FEE.id_utilisateur = U.id
        AND FEE.id_filiere_enseignement = '.$id_filiere_enseignement);
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
    
    function delete($id_filiere_enseignement, $id_utilisateur) {
      $this->deleteQuery('DELETE FROM '.DB_PREFIX.'filiere_enseignement_enseignant 
                          WHERE id_filiere_enseignement	= '.$id_filiere_enseignement.' 
                          AND id_utilisateur = '.$id_utilisateur);
    }
  }
?>