<?php
	class FiliereEnseignementEnseignant extends Model {

		var $table = 'filiere_enseignement_enseignant';
		
		function __construct() {
			$this->table = DB_PREFIX.$this->table;
		}
		
		function getConflitsByFiliereEnseignement($id_filiere_enseignement) {
			$req = $this->query('SELECT fe.id_filiere, fe.nbr_h_cours, fe.nbr_h_td, fe.nbr_h_tp, fe.nbr_groupes_cours, fe.nbr_groupes_td, fe.nbr_groupes_tp, fee.id_filiere_enseignement, SUM(fee.nbr_h_cours) as v_cours, SUM(fee.nbr_h_td) as v_td, SUM(fee.nbr_h_tp) as v_tp
								 FROM '.DB_PREFIX.'filiere_enseignement fe, '.DB_PREFIX.'filiere_enseignement_enseignant fee
								 WHERE fe.id = fee.id_filiere_enseignement
								 AND fee.id_filiere_enseignement = '.$id_filiere_enseignement);
			
			$arrayConflits = array();
			foreach($req as $r) {
				// Cours
				$volume_h_cours = $r['nbr_h_cours'] * $r['nbr_groupes_cours'];
				$volume_h_td = $r['nbr_h_td'] * $r['nbr_groupes_td'];
				$volume_h_tp = $r['nbr_h_tp'] * $r['nbr_groupes_tp'];
				
				
				if($volume_h_cours != $r['v_cours']) {
					// Il manque des heures
					if($r['v_cours'] < $volume_h_cours) {
						$arrayConflits['cours'] = $volume_h_cours - $r['v_cours'];
						$arrayConflits['cours_conflit'] = 0;
					}
					
					// Il y a trop d'heures
					if($r['v_cours'] > $volume_h_cours) {
						$arrayConflits['cours'] = $r['v_cours'] - $volume_h_cours;
						$arrayConflits['cours_conflit'] = 1;
					}
				}
				
				// TD
				if($volume_h_td != $r['v_td']) {
					// Il manque des heures
					if($r['v_td'] < $volume_h_td) {
						$arrayConflits['td'] = $volume_h_td - $r['v_td'];
						$arrayConflits['td_conflit'] = 0;
					}
					
					// Il y a trop d'heures
					if($r['v_td'] > $volume_h_td) {
						$arrayConflits['td'] = $r['v_td'] - $volume_h_td;
						$arrayConflits['td_conflit'] = 1;
					}
				}
				
				// TP
				if($volume_h_tp != $r['v_tp']) {
					// Il manque des heures
					if($r['v_tp'] < $volume_h_tp) {
						$arrayConflits['tp'] = $volume_h_tp - $r['v_tp'];
						$arrayConflits['tp_conflit'] = 0;
					}
					
					// Il y a trop d'heures
					if($r['v_tp'] > $volume_h_tp) {
						$arrayConflits['tp'] = $r['v_tp'] - $volume_h_tp;
						$arrayConflits['tp_conflit'] = 1;
					}
				}
			}
			
			return $arrayConflits;
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
		
		function getFiliereEnseignementByEnseignant($id_utilisateur) {
			return $this->query('SELECT fe.id_filiere as id_filiere, fe.annee, fee.id_filiere_enseignement, fee.nbr_h_cours, fee.nbr_h_td, fee.nbr_h_tp, e.libelle
								 FROM '.DB_PREFIX.'filiere_enseignement_enseignant fee, '.DB_PREFIX.'filiere_enseignement fe, '.DB_PREFIX.'enseignement e
								 WHERE fee.id_filiere_enseignement = fe.id
								 AND e.id = fe.id_enseignement
								 AND fee.id_utilisateur = '.$id_utilisateur);
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