<?php
	class DiplomeController extends Controller {
	
		// Déclaration du modèle rattaché au controlleur
		var $models = array('Diplome');
		
		// Variables pour les vues
		var $v_JS = array('jquery-1.9.1.min', 'tools', 'diplome');

		function index() {
			// Titre
			$d['v_titreHTML'] = 'Diplômes';
			$d['v_menuActive'] = 'diplomes';

			if(isset($_POST) && count($_POST) != 0) {
				
				$dataDiplome = array('id' => $_POST['idDegree'],
                             'libelle' => $_POST['intitule']);
				
				$this->Diplome->save($dataDiplome);
				
        if(isset($_POST['idDegree']) && !empty($_POST['idDegree']))
          $d['v_success'] = "Le diplôme a bien été mis à jour";
        else
          $d['v_success'] = "Le diplôme a bien été créé";
			}
			
			$d['degrees'] = $this->Diplome->getAll();
      
			$this->set($d);
			$this->render('index');
		}
    
    function update($id) {
      $this->Diplome->id = $id;
      
      $d['v_titreHTML'] = 'Diplômes';
			$d['v_menuActive'] = 'diplomes';
      $d['info_degree'] = $this->Diplome->getDegree($id);

      $this->set($d);
			$this->render('update');
    }
    
    function delete($id) {
      $this->Diplome->del($id);
			redirection("diplome", "index");
    }
	}
?>