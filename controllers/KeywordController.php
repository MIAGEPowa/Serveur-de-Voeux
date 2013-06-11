<?php
	class KeywordController extends Controller {
	
		// Déclaration du modèle rattaché au controlleur
		var $models = array('Enseignement', 'Keyword', 'Utilisateur');

		function index() {
			// Titre
			$d['v_titreHTML'] = 'Recherche';
			$d['v_menuActive'] = 'keywords';
			
			if($_POST['keyword_form_search']) {
				// Liste des Keywords qui correspondent à la recherche
				$arrayKeywords = $this->Keyword->find(array('conditions' => 'keyword like "%'.$_POST['intitule'].'%"'));
				
				$d['arrayEnseignements'] = array();
				$d['arrayUtilisateurs'] = array();
				
				if(count($arrayKeywords) != 0) {
					$i = 0;			
					foreach($arrayKeywords as $keyword) {
						if($keyword['id_utilisateur'] != 0) {
							$utilisateur = $this->Utilisateur->find(array('conditions' => 'id = '.$keyword['id_utilisateur']));
							$d['arrayUtilisateurs'][$i] = $utilisateur[0];
							$d['arrayUtilisateurs'][$i]['keyword'] = $keyword['keyword'];
						}
						if($keyword['id_enseignement'] != 0) {
							$enseignement = $this->Enseignement->find(array('conditions' => 'id = '.$keyword['id_enseignement']));
							$d['arrayEnseignements'][$i] = $enseignement[0];
							$d['arrayEnseignements'][$i] = $enseignement[0];
							$d['arrayEnseignements'][$i]['keyword'] = $keyword['keyword'];
						}
						$i++;
					}
				}
			}
			
			$allKeywords = $this->Keyword->find();
			$d['arrayLibKeywords'] = array();
			foreach($allKeywords as $keyword) {
				$d['arrayLibKeywords'][] = $keyword['keyword'];
			}
			
			$this->set($d);
			$this->render('index');
		}
	}
?>