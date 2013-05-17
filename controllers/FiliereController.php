<?php
	class FiliereController extends Controller {
	
		// Déclaration du modèle rattaché au controlleur
		var $models = array('Filiere', 'Niveau', 'Specialite');

		function index() {
			// Titre
			$d['v_titreHTML'] = 'Filières';
			$d['v_menuActive'] = 'filieres';
			$this->v_JS = array('jquery-1.9.1.min', 'tools');
			
			if($_POST['filiere_form_add']) {
				$dataFiliere = array(	"id_specialite" => $_POST['specialite'],
										"id_niveau" => $_POST['niveau'],
										"apprentissage" => $_POST['apprentissage'] );
				
				$this->Filiere->save($dataFiliere);
				
				$d['v_success'] = 'La filière a bien été créée !';	
			}
			
			// Liste des enseignements
			$d['arrayFilieres'] = $this->Filiere->find();
			$d['arrayNiveaux'] = $this->Niveau->find();
			$d['arraySpecialites'] = $this->Specialite->find();
			
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
	}
?>