<?php
	class AnnuaireController extends Controller {
	
		// Déclaration du modèle rattaché au controlleur
		var $models = array('UtilisateurRole', 'Role', 'Utilisateur', 'Keyword', 'Enseignement', 'FiliereEnseignementEnseignant');
		
		// Variables pour les vues
		var $v_JS = array();

		function index() {
			// Titre
			$d['v_titreHTML'] = 'Annuaire';
			$d['v_menuActive'] = 'annuaire';
			$d['v_needRightsExporter'] = 4;
			
			// On récupère tous les utilisateurs
			$d['utilisateurs'] = $this->Utilisateur->getUtilisateursAvecRoles(1);
			
			$this->set($d);
			$this->render('index');
		}
		
		function exporter() {
			$d['v_needRights'] = 4;

			if($_SESSION['v_droits'] >= $d['v_needRights']) {
			
				$filename = ROOT.'files/annuaire/annuaire.csv';
				$array4CSV = array();
				$delimiter = ';';
				
				// Réécrire le fichier annuaire.csv avant l'export
				$d['utilisateurs'] = $this->Utilisateur->getUtilisateurs();
				foreach($d['utilisateurs'] as $u) {
					$arrayUtulisateur = array();
					array_push($arrayUtulisateur, $u['id'], $u['nom'], $u['prenom'], $u['email']);
					array_push($array4CSV, $arrayUtulisateur);
				}
				
				$fp = fopen($filename, 'w');
				foreach($array4CSV as $fields) {
					fputcsv($fp, $fields, $delimiter);
				}
				fclose($fp);
				
				// Forcer le téléchargement du fichier annuaire.csv
				$size = filesize($filename);
				header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
				header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
				header("Cache-Control: no-store, no-cache, must-revalidate");
				header("Cache-Control: post-check=0, pre-check=0", false);
				header("Pragma: no-cache");
				header("Content-Type: application/force-download");
				header('Content-Disposition: attachment; filename="annuaire.csv"');
				header("Content-Length: ".$size);
				 
				// Envoi le contenu du fichier
				readfile($filename);
			
			} else {
				// Rediriger l'utilisateur sur une page d'erreur
				redirection("notfound", "droits");
			}
		}
    
		function visualiser($id) {
			// Titre
			$d['v_titreHTML'] = 'Annuaire';
			$d['v_menuActive'] = 'annuaire';

			$d['utilisateur'] = $this->Utilisateur->getUtilisateur($id);
      
			$d['roles_utilisateur'] = $this->UtilisateurRole->getRoleUtilisateur($id);

			for($i=0; $i<count($d['roles_utilisateur']); $i++) {
				$role = $this->Role->find(array('conditions' => 'id = '.$d['roles_utilisateur'][$i]['id_role'], 'order' => 'id'));
				$d['roles_utilisateur'][$i]['libelle'] = $role[0]['libelle'];
				if($role[0]['droits'] == 2) {
					$d['coeff_cours'] = $role[0]['coeff_cours'];
					$d['coeff_tp'] = $role[0]['coeff_tp'];
					$d['quota_h'] = $role[0]['quota_h'];
				}				
			}
      
			$d['arrayKeywords'] = $this->Keyword->find(array('conditions' => 'id_utilisateur = '.$id));
			$d['arrayDegrees'] = $this->Enseignement->find(array('conditions' => 'auteur = '.$id));
      
			$d['arrayVoeux'] = $this->FiliereEnseignementEnseignant->getAllByUserEtatPrevi($id);
			$d['arrayVoeuxHistorique'] = $this->FiliereEnseignementEnseignant->getAllByUser($id);
      
			$this->set($d);
			$this->render('visualiser');
		}

	}
?>