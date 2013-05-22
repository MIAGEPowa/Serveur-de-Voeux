<?php
	class SpecialiteController extends Controller {
	
		// Déclaration du modèle rattaché au controlleur
		var $models = array('Specialite');
		
		// Variables pour les vues
		var $v_JS = array('specialite');

		function index() {
			// Titre
			$d['v_titreHTML'] = 'Spécialités';
			$d['v_menuActive'] = 'specialites';

			if(isset($_POST) && count($_POST) != 0) {
				
				$dataSpecialite = array('id' => $_POST['idSpecialite'],
                                'libelle' => $_POST['intitule']);
				
        $checkSpecialite = $this->Specialite->checkSpecialiteLibelle($_POST['intitule']);
        
				if ((!$checkSpecialite) || (!empty($_POST['idSpecialite']))) {
          $this->Specialite->save($dataSpecialite);
          
          if(isset($_POST['idSpecialite']) && !empty($_POST['idSpecialite']))
            $d['v_success'] = "La spécialité a bien été mise à jour";
          else
            $d['v_success'] = "La spécialité a bien été créée";
        } else {
          $d['v_errors'] = 'Oops ! Cette spécialité a déjà été créée.';
        }
			}
			
			$d['specialities'] = $this->Specialite->getAll();
      
			$this->set($d);
			$this->render('index');
		}
    
		function update($id) {
		  $this->Specialite->id = $id;
		  
		  $d['v_titreHTML'] = 'Spécialités';
				$d['v_menuActive'] = 'specialites';
		  $d['specialite'] = $this->Specialite->getSpecialite($id);

		  $this->set($d);
				$this->render('update');
		}
		
		function delete($id) {
		  $this->Specialite->del($id);
				redirection("specialite", "index");
		}
	}
?>