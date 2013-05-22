<?php
	class NiveauController extends Controller {
	
		// Déclaration du modèle rattaché au controlleur
		var $models = array('Niveau', 'Diplome');
		
		// Variables pour les vues
		var $v_JS = array('niveau');

		function index() {
			// Titre
			$d['v_titreHTML'] = 'Niveaux';
			$d['v_menuActive'] = 'niveaux';

			if(isset($_POST) && count($_POST) != 0) {
				
				$dataNiveau = array('id' => $_POST['idLevel'],
                            'libelle' => $_POST['intitule'],
                            'id_diplome' => $_POST['diplome']);
				
				$this->Niveau->save($dataNiveau);
				
				if(isset($_POST['idLevel']) && !empty($_POST['idLevel']))
				  $d['v_success'] = "Le niveau a bien été mis à jour";
				else
				  $d['v_success'] = "Le niveau a bien été créé";
			}
			
			$d['levels'] = $this->Niveau->getAll();
			$d['degrees'] = $this->Diplome->getAll();
      
			$this->set($d);
			$this->render('index');
		}
    
		function update($id) {
		  $this->Niveau->id = $id;
		  
		  $d['v_titreHTML'] = 'Niveaux';
				$d['v_menuActive'] = 'niveaux';
		  $d['info_level'] = $this->Niveau->getLevel($id);
		  $d['degrees'] = $this->Diplome->getAll();

		  $this->set($d);
				$this->render('update');
		}
		
		function delete($id) {
		  $this->Niveau->del($id);
				redirection("niveau", "index");
		}
	}
?>