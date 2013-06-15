<?php
	class RoleController extends Controller {
	
		// Déclaration du modèle rattaché au controlleur
		var $models = array('Role', 'Diplome', 'Niveau', 'Filiere', 'Specialite', 'UtilisateurRole');
		
		// Variables pour les vues
		var $v_JS = array('role');
		
		function index($id_role = 0) {
			// Titre
			$d['v_titreHTML'] = 'Rôles';
			$d['v_menuActive'] = 'roles';	
			$d['v_needRights'] = 4;
			
			if($_SESSION['v_droits'] >= $d['v_needRights']) {
				
				if ($id_role != 0) {
					if (!$this->UtilisateurRole->existRole($id_role)) {
						$this->Role->del($id_role);
						$d['v_success'] = 'Rôle supprimé avec succès';
					} else {
						$d['v_errors'] = 'Oops ! Le rôle ne peut pas être supprimé car il est déjà associé à un utilisateur.';
					}
				}
      
				// Traitement du formulaire
				if($_POST['role_submit_add']) {
					if(isset($_POST['droits']) && !empty($_POST['droits'])) {
					
						// Traitement du role secrétaire
						if($_POST['droits'] == 1) {
						
							if(isset($_POST['s_filiere']) && !empty($_POST['s_filiere'])) {
								
								$l = "Secrétaire";
								$filiere_libelle = $this->Filiere->getFiliereName($_POST['s_filiere']);
								$l .= " ".$filiere_libelle;
								
								$checkRole = $this->Role->checkRoleSecretaire($_POST['s_filiere']);
								if(!$checkRole) {
									$this->Role->addRole($l, 0, 0, 0, 1, $_POST['s_filiere'], 0, 0, 0);
									$d['v_success'] = 'Rôle ajouté avec succès';
								} else {
									$d['v_errors'] = 'Oops ! Ce rôle a déjà été crée.';
								}

							} else {
								$d['v_errors'] = 'Oops ! Il manque le libellé du rôle que vous souhaitez ajouter.';
							}					
						
						// Traitement du role enseignant
						} else if($_POST['droits'] == 2) {
							
							if(isset($_POST['e_libelle']) && !empty($_POST['e_libelle']) && isset($_POST['e_quota_heures']) && !empty($_POST['e_quota_heures']) && is_numeric($_POST['e_quota_heures']) && is_numeric($_POST['e_coeff_cours']) && is_numeric($_POST['e_coeff_tp'])) {
								
								$checkRole = $this->Role->checkRoleLibelle($_POST['e_libelle']);
								if(!$checkRole) {
									$this->Role->addRole($_POST['e_libelle'], 0, 1, (int)($_POST['e_quota_heures']), 2, 0, 0, $_POST['e_coeff_cours'], $_POST['e_coeff_tp']);
									$d['v_success'] = 'Rôle ajouté avec succès';
								} else {
									$d['v_errors'] = 'Oops ! Ce rôle a déjà été créé.';
								}

							} else {
								$d['v_errors'] = 'Oops ! Tous les champs sont obligatoires et le quota d\'heures doit être un entier.';
							}
						
						// Traitement du role responsable
						} else if($_POST['droits'] == 3) {
							
							if(isset($_POST['r_adjoint']) && !empty($_POST['r_adjoint']) && isset($_POST['r_droits']) && !empty($_POST['r_droits']) && isset($_POST['r_filiere']) && !empty($_POST['r_filiere']) || isset($_POST['r_diplome']) && !empty($_POST['r_diplome'])) {
							
								// Filière
								if($_POST['r_droits'] == 1) {
								
									$checkRole = $this->Role->checkRoleResponsable($_POST['r_filiere'], 0, $_POST['r_adjoint']);
									if(!$checkRole) {
									
										$filiere_libelle = $this->Filiere->getFiliereName($_POST['r_filiere']);
										$l = "Responsable";
										if($_POST['r_adjoint'])
											$l .= " adjoint";
										$l .= " ".$filiere_libelle;									
										$this->Role->addRole($l, $_POST['r_adjoint'], 0, 0, 3, $_POST['r_filiere'], 0, 0, 0);
										
										$d['v_success'] = 'Rôle ajouté avec succès';
									} else {
										$d['v_errors'] = 'Oops ! Ce rôle a déjà été crée.';
									}
								
								// Diplôme
								} else {
									
									$checkRole = $this->Role->checkRoleResponsable(0, $_POST['r_diplome'], $_POST['r_adjoint']);
									if(!$checkRole) {
										
										$tmp = $this->Diplome->find(array('conditions' => 'id = '.$_POST['r_diplome']));
										$l = "Responsable";
										if($_POST['r_adjoint'])
											$l .= " adjoint";
										$l .= " ".$tmp[0]['libelle'];
										
										$this->Role->addRole($l, $_POST['r_adjoint'], 0, 0, 3, 0, $_POST['r_diplome'], 0, 0);
										
										$d['v_success'] = 'Rôle ajouté avec succès';
									} else {
										$d['v_errors'] = 'Oops ! Ce rôle a déjà été crée.';
									}
									
								}
							
							} else {
								$d['v_errors'] = 'Oops ! Tous les champs sont obligatoires.';
							}
						
						// Traitement du role administrateur
						} else if($_POST['droits'] == 4) {
							
							if(isset($_POST['a_libelle']) && !empty($_POST['a_libelle'])) {
								
								$checkRole = $this->Role->checkRoleLibelle($_POST['a_libelle']);
								if(!$checkRole) {
									$this->Role->addRole($_POST['a_libelle'], 0, 0, 0, 4, 0, 0, 0, 0);
									$d['v_success'] = 'Rôle ajouté avec succès';
								} else {
									$d['v_errors'] = 'Oops ! Ce rôle a déjà été crée.';
								}

							} else {
								$d['v_errors'] = 'Oops ! Il manque le libellé du rôle que vous souhaitez ajouter.';
							}	
							
						}
						
					} else {
						$d['v_errors'] = 'Oops ! Il manque l\'id du droit du rôle que vous souhaitez ajouter.';
					}
				}
				
				
				// On récupère tous les rôles, niveaux et filières
				$d['roles'] = $this->Role->getRoles();
				foreach($d['roles'] as $r_key => $r) {
					$d['roles'][$r_key]['utilisateurs'] = count($this->UtilisateurRole->getNumberUtilisateurRole($r['id']));
				}
				$d['diplomes'] = $this->Diplome->getAll();
				$d['arrayFilieres'] = $this->Filiere->find();
				for($i=0; $i<count($d['arrayFilieres']); $i++) {
					$d['arrayFilieres'][$i]['name'] = $this->Filiere->getFiliereName($d['arrayFilieres'][$i]['id']);
				}
				
				$this->set($d);
				$this->render('index');
				
			} else {
				// Rediriger l'utilisateur sur une page d'erreur
				redirection("notfound", "droits");
			}
		}
		
		function update($id) {
			// Titre
			$d['v_titreHTML'] = 'Rôles';
			$d['v_menuActive'] = 'roles';
			$d['v_needRights'] = 4;

			if($_SESSION['v_droits'] >= $d['v_needRights']) {
				
				if($_POST['role_submit_update']) {

					$role = $this->Role->find(array('conditions' => 'id = '.$id));
					$adjoint = (isset($_POST['role_adjoint'])) ? $_POST['role_adjoint'] : $role[0]['adjoint'];
					$quota_h = (isset($_POST['role_quota_h'])) ? $_POST['role_quota_h'] : $role[0]['quota_h'];
					$id_filiere = ((isset($_POST['role_filiere'])) && ($_POST['role_filiere'] != 0)) ? $_POST['role_filiere'] : 0;
					$id_diplome = ((isset($_POST['role_diplome'])) && ($_POST['role_diplome'] != 0)) ? $_POST['role_diplome'] : 0;
					$coeff_cours = (isset($_POST['role_coeff_cours'])) ? $_POST['role_coeff_cours'] : $role[0]['coeff_cours'];
					$coeff_tp = (isset($_POST['role_coeff_tp'])) ? $_POST['role_coeff_tp'] : $role[0]['coeff_tp'];
					
					if (($role[0]['droits'] == 2) || ($role[0]['droits'] == 4))
						$libelle = (isset($_POST['role_libelle'])) ? $_POST['role_libelle'] : $role[0]['libelle'];
					else if ($role[0]['droits'] == 1) {
						$filiere_libelle = $this->Filiere->getFiliereName($id_filiere);
						$libelle = 'Secrétaire '.$filiere_libelle;
					} else if ($role[0]['droits'] == 3) {
						$a = (isset($_POST['role_adjoint'])) ? $_POST['role_adjoint'] : $role[0]['adjoint'];
						$l = ($id_filiere != 0) ? $this->Filiere->getFiliereName($id_filiere) : $this->Diplome->getDiplomeName($id_diplome);
						$libelle = "Responsable";
						if($adjoint)
							$libelle .= " adjoint";
						$libelle .= " ".$l;
					}
					
					if (!$this->Role->checkRoleLibelleId($libelle, $id)) {
						$dataRole = array(	'id' => $id,
											'libelle' => $libelle,
											'adjoint' => $adjoint,
											'quota_h' => $quota_h,
											'id_filiere' => $id_filiere,
											'id_diplome' => $id_diplome,
											'coeff_cours' => $coeff_cours,
											'coeff_tp' => $coeff_tp);
											
						$this->Role->save($dataRole);	
						
						$d['v_success'] = 'Rôle mis à jour avec succès.';
					} else {
						$d['v_errors'] = 'Oops ! Ce rôle a déjà été crée.';
					}
				}
				
				$d['role'] = $this->Role->find(array('conditions' => 'id = '.$id));
				$d['diplomes'] = $this->Diplome->getAll();
				$d['arrayFilieres'] = $this->Filiere->find();
				for($i=0; $i<count($d['arrayFilieres']); $i++) {
					$d['arrayFilieres'][$i]['name'] = $this->Filiere->getFiliereName($d['arrayFilieres'][$i]['id']);
				}
				
				$this->set($d);
				$this->render('update');
			} else {
				// Rediriger l'utilisateur sur une page d'erreur
				redirection("notfound", "droits");
			}
		}

	}
?>