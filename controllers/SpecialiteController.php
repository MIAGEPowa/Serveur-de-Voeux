<?php
	class SpecialiteController extends Controller {
	
		// Déclaration du modèle rattaché au controlleur
		var $models = array('Specialite');
		
		// Variables pour les vues
		var $v_JS = array('jquery-1.9.1.min', 'tools', 'specialite');

		function index() {
			// Titre
			$d['v_titreHTML'] = 'Spécialités';
			$d['v_menuActive'] = 'specialites';

			if(isset($_POST) && count($_POST) != 0) {
				
				$dataSpecialite = array('id' => $_POST['idSpeciality'],
                                'libelle' => $_POST['intitule']);
				
				$this->Specialite->save($dataSpecialite);
				
        if(isset($_POST['idSpeciality']) && !empty($_POST['idSpeciality']))
          $d['v_success'] = "La spécialité a bien été mise à jour";
        else
          $d['v_success'] = "La spécialité a bien été créée";
			}
			
			$d['specialities'] = $this->Specialite->getAll();
      
			$this->set($d);
			$this->render('index');
		}
    
    function update($id) {
      $this->Specialite->id = $id;
      
      $d['v_titreHTML'] = 'Spécialités';
			$d['v_menuActive'] = 'specialites';
      $d['info_speciality'] = $this->Specialite->getSpeciality($id);

      $this->set($d);
			$this->render('update');
    }
    
    function delete($id) {
      $this->Specialite->del($id);
			redirection("specialite", "index");
    }
	}
?>