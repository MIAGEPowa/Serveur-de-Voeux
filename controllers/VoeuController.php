<?php
	class VoeuController extends Controller {
	
		// Déclaration du modèle rattaché au controlleur
		var $models = array('FiliereEnseignementEnseignant', 'FiliereEnseignement', 'Filiere', 'Niveau', 'Specialite', 'Enseignement');

		function index() {
			// Titre
			$d['v_titreHTML'] = 'Voeux';
			$d['v_menuActive'] = 'voeux';
      
      $d['filiereEnseignement'] = $this->FiliereEnseignement->getAllFiliereEnseignement();
      
      for($i=0; $i < count($d['filiereEnseignement']); $i++) {
        if ($d['filiereEnseignement'][$i]['id_filiere_enseignement'] != '') {
       
          $voeu = $this->FiliereEnseignementEnseignant->getFiliereEnseignementEnseignant($d['filiereEnseignement'][$i]['id_filiere_enseignement'], $_SESSION['v_id_utilisateur']);
          
          if (!$voeu) {
            $d['filiereEnseignement'][$i]['nbr_h_cours'] = 0;
            $d['filiereEnseignement'][$i]['nbr_h_td'] = 0;
          } else {
            $d['filiereEnseignement'][$i]['nbr_h_cours'] = $voeu[0]['nbr_h_cours'];
            $d['filiereEnseignement'][$i]['nbr_h_td'] = $voeu[0]['nbr_h_td'];
          } 
        }
      }
      
			$this->set($d);
			$this->render('index');
		}	
	
    function update($id) {
    
      $d['v_titreHTML'] = 'Voeux';
			$d['v_menuActive'] = 'voeux';
      
      $this->v_JS = array('voeu');
      
      if($_POST['voeu_form_update']) {
				if (isset($_POST['heuresCours']) && !empty($_POST['heuresCours'])
				&& isset($_POST['heuresTD']) && !empty($_POST['heuresTD'])) {
        
          $checkVoeu = $this->FiliereEnseignementEnseignant->getFiliereEnseignementEnseignant($id, $_SESSION['v_id_utilisateur']);
          
          $dataVoeu = array('id_filiere_enseignement' => $id,
                            'id_utilisateur' => $_SESSION['v_id_utilisateur'],
                            'nbr_h_cours' => $_POST['heuresCours'],
                            'nbr_h_td' => $_POST['heuresTD']);
                              
          if (!$checkVoeu) { // Le voeu n'existe pas encore dans la DB
            // on enregistre le voeu
            if (($_POST['heuresCours'] != 0) && ($_POST['heuresTD'] != 0))
              $this->FiliereEnseignementEnseignant->save($dataVoeu);
          } else {
            $this->FiliereEnseignementEnseignant->update($dataVoeu, 'id_filiere_enseignement', 'id_utilisateur');
          }
          
          $d['v_success'] = 'Le voeu a bien été modifié !';
				}
			}
      
      $d['filiereEnseignement'] = $this->FiliereEnseignement->find(array('conditions' => 'id = '.$id));
			$d['filiereEnseignement'] = $d['filiereEnseignement'][0];
			
			$filiere = $this->Filiere->find(array('conditions' => 'id = '.$d['filiereEnseignement']['id_filiere']));
			// Niveau
			$niveau = $this->Niveau->find(array('conditions' => 'id = '.$filiere[0]['id_niveau']));
			$niveau = $niveau[0]['libelle'];
			// Spécialité
			$specialite = $this->Specialite->find(array('conditions' => 'id = '.$filiere[0]['id_specialite']));
			$specialite = $specialite[0]['libelle'];
			// Apprentissage
			if($d['filiereEnseignement']['apprentissage'] == 0) {$apprentissage = 'Initial';}
			else {$apprentissage = 'Apprentissage';}
			// Filière
			$d['filiereEnseignement']['filiere'] = $niveau.' '.$specialite.' '.$apprentissage;
			
			// Enseignement
			$enseignement = $this->Enseignement->find(array('conditions' => 'id = '.$d['filiereEnseignement']['id_enseignement']));
			$d['filiereEnseignement']['enseignement'] = $enseignement[0]['libelle'];
      
      $d['filiereEnseignement']['date_debut_enseignement'] = dateBDDToNormal($d['filiereEnseignement']['date_debut_enseignement']);
      
      $d['filiereEnseignement']['voeu'] = $this->FiliereEnseignementEnseignant->getFiliereEnseignementEnseignant($id, $_SESSION['v_id_utilisateur']);
       
      if (!$d['filiereEnseignement']['voeu']) {
        $d['filiereEnseignement']['nb_heures_cours'] = 0;
        $d['filiereEnseignement']['nb_heures_td'] = 0;
      } else {
        $d['filiereEnseignement']['nb_heures_cours'] = $d['filiereEnseignement']['voeu'][0]['nbr_h_cours'];
        $d['filiereEnseignement']['nb_heures_td'] = $d['filiereEnseignement']['voeu'][0]['nbr_h_td'];
      }
                 	                                                                          
      $this->set($d);
			$this->render('update');
    }
    
    function delete($id) {
      $this->FiliereEnseignementEnseignant->delete($id, $_SESSION['v_id_utilisateur']);
      redirection("voeu", "index");
    }
	}
?>