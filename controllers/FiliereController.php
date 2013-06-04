<?php
	class FiliereController extends Controller {
	
		// Déclaration du modèle rattaché au controlleur
		var $models = array('UtilisateurRole', 'Filiere', 'Niveau', 'Specialite');

		function index() {
			// Titre
			$d['v_titreHTML'] = 'Filières';
			$d['v_menuActive'] = 'filieres';
			$d['v_needRights'] = 4;

			if($_SESSION['v_droits'] >= $d['v_needRights']) {
				if($_POST['filiere_form_add']) {
					$dataFiliere = array(	"id_specialite" => $_POST['specialite'],
											"id_niveau" => $_POST['niveau'],
											"apprentissage" => $_POST['apprentissage'] );
					
					$this->Filiere->save($dataFiliere);
					
					$d['v_success'] = 'La filière a bien été créée !';	
				}
				
				// Liste des filières, niveaux et spécialités
				$d['arrayFilieres'] = $this->Filiere->find();
				$d['arrayNiveaux'] = $this->Niveau->find();
				$d['arraySpecialites'] = $this->Specialite->find();
				
				// Dans la liste des filières, on ajoute le nom de la spécialité, du niveau et de l'apprentissage
				for($i=0; $i<count($d['arrayFilieres']); $i++) {
					$d['arrayFilieres'][$i]['specialite'] = $this->Specialite->find(array('conditions' => 'id = '.$d['arrayFilieres'][$i]['id_specialite']));
					$d['arrayFilieres'][$i]['specialite'] = $d['arrayFilieres'][$i]['specialite'][0]['libelle'];
					$d['arrayFilieres'][$i]['niveau'] = $this->Niveau->find(array('conditions' => 'id = '.$d['arrayFilieres'][$i]['id_niveau']));
					$d['arrayFilieres'][$i]['niveau'] = $d['arrayFilieres'][$i]['niveau'][0]['libelle'];
					if($d['arrayFilieres'][$i]['apprentissage'] == 0) {$d['arrayFilieres'][$i]['apprentissage_lib'] = 'Non';}
					else {$d['arrayFilieres'][$i]['apprentissage_lib'] = 'Oui';}
					$d['arrayFilieres'][$i]['responsable'] = $this->UtilisateurRole->getFiliereResponsable($d['arrayFilieres'][$i]['id']);
					$d['arrayFilieres'][$i]['secretaire'] = $this->UtilisateurRole->getFiliereSecretaire($d['arrayFilieres'][$i]['id']);
				}
				
				$this->set($d);
				$this->render('index');
			} else {
				// Rediriger l'utilisateur sur une page d'erreur
				redirection("notfound", "droits");
			}
		}
		
		function view($id) {
			$d['v_needRights'] = 4;

			if($_SESSION['v_droits'] >= $d['v_needRights']) {	
				// Titre
				$d['v_titreHTML'] = 'Visualiser une filière';
				$d['v_menuActive'] = 'filieres';

				// La filière, les niveaux et les spécialités
				$d['filiere'] = $this->Filiere->find(array( 'conditions' => 'id = ' .$id ));
				$d['filiere'] = $d['filiere'][0];
				
				$d['niveau'] = $this->Niveau->find(array( 'conditions' => 'id = ' .$d['filiere']['id_niveau'] ));
				$d['niveau'] = $d['niveau'][0]['libelle'];	
				
				$d['specialite'] = $this->Specialite->find(array( 'conditions' => 'id = ' .$d['filiere']['id_specialite'] ));
				$d['specialite'] = $d['specialite'][0]['libelle'];
				
				$d['apprentissage'] = $d['filiere']['apprentissage'];
				$d['apprentissage'] = ($d['apprentissage'] == 0) ? 'non' : 'oui';
				
				$d['arrayEnseignements'] = $this->Filiere->getEnseignements($id);
				
				$d['arrayResponsable'] = $this->UtilisateurRole->getFiliereResponsable($id);
				$d['arraySecretaire'] = $this->UtilisateurRole->getFiliereSecretaire($id);
					
				$this->set($d);
				$this->render('view');
			} else {
				// Rediriger l'utilisateur sur une page d'erreur
				redirection("notfound", "droits");
			}
		}
	}
?>