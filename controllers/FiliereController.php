<?php
	class FiliereController extends Controller {
	
		// Déclaration du modèle rattaché au controlleur
		var $models = array('Filiere', 'Niveau', 'Specialite');

		function index() {
			// Titre
			$d['v_titreHTML'] = 'Filières';
			$d['v_menuActive'] = 'filieres';
			
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
			}
			
			$this->set($d);
			$this->render('index');
		}
		
		function update($id) {
			// Titre
			$d['v_titreHTML'] = 'Modifier une filière';
			$d['v_menuActive'] = 'filieres';
			
			// La filière, les niveaux et les spécialités
			$d['filiere'] = $this->Filiere->find(array(
									'conditions' => 'id = ' . $id
								));
			$d['filiere'] = $d['filiere'][0];
			$d['arrayNiveaux'] = $this->Niveau->find();
			$d['arraySpecialites'] = $this->Specialite->find();
			
			$this->set($d);
			$this->render('update');
		}
	}
?>