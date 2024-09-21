<?php
//acces au controller parent pour l heritage
namespace App\Controllers;
use CodeIgniter\Controller;

//=========================================================================================
//définition d'une classe Controleur (meme nom que votre fichier Controleur.php) 
//héritée de Controller et permettant d'utiliser les raccoucis et fonctions de CodeIgniter
//  Attention vos Fichiers et Classes Controleur et Modele doit commencer par une Majuscule 
//  et suivre par des minuscules
//=========================================================================================

class Controleur extends BaseController {

//=====================================================================
//Fonction index correspondant au Controleur frontal (ou index.php) en MVC libre
//=====================================================================
public function index(){
	if (isset($_POST['etape']) && isset($_POST['kilometres']) && isset($_POST['nuitees']) && isset($_POST['repas']) && isset($_POST['date']) && isset($_POST['libelle']) && isset($_POST['montant'])) {$this->renseignement();}
    else if (isset($_GET['action']) && $_GET['action']=='RenseignerFicheFrais') {$this->renseignerFiche();}
    else if (isset($_GET['action']) && $_GET['action']=='ConsulterFichesFrais') {$this->consulterFiche();}
    else if (isset($_POST['login'])) { $this->motdp();}
    else if (isset($_GET['action'])&& isset($_GET['action'])=='Index') { $this->accueil();}
    else $this->accueil();
}
	
	public function motdp() {
	$Modele = new \App\Models\Modele();
	
	$login = $_POST['login'];
	$motdp = $_POST['mdp'];
	
	$donnees = $Modele->getindex($login, $motdp);
	
	if (isset($donnees[0]->login)) {
		$id = $donnees[0]->id;
		$mois = date("F");
		$donnee2=$Modele->gettestfiche($id, $mois);
		if (!isset($donnee2[0]->mois)) {
			$Modele->creationfichefrais($id,$mois,date('Y-m-d'));
			$Modele->creationfrais($id,$mois,'KM', 0 );
			$Modele->creationfrais($id,$mois,'NUI', 0 );
			$Modele->creationfrais($id,$mois,'REP', 0 );
			$Modele->creationfrais($id,$mois,'ETP', 0 );
			//$fraisCreer = $Modele->verificationFrais($id, $mois);
            //$horsFraisCreer = $Modele->verificationHorsFrais($id, $mois);
			//if ($fraisCreer && $horsFraisCreer) {
			//	echo "Les modèles de frais et hors frais ont été créés avec succès.";
			//} else {

			//	echo "Erreur lors de la création des modèles.";

		}
	$data['login']=$donnees[0]->login;
	echo view('accueil', $data);
	}
	else {
	echo view('connexion');
	}
	}
	
	public function accueil() {
		echo view('connexion'); //probleme
	}
	
	public function consulterFiche() {
	$Modele = new \App\Models\Modele();
	
	// Vérifiez si l'utilisateur est connecté en consultant la session
    if (!session()->get('is_logged_in')) {
        // Si l'utilisateur n'est pas connecté, redirigez vers la page de connexion
	}
		// Si connecté, continuez à afficher la page
		$data = []; // Vos données à passer à la vue
		echo view('consulterFiche');
	}













	//$mois_selectionne = $_POST['mois_selectionne'];
	
	
	//$donnees = $Modele->getmois($mois_selectionne);
	
	//if (isset($donnees[0]->mois_selectionne)) {
	//$data['mois_selectionne']=$donnees[0]->mois_selectionne;
	//echo view('consulter', $data);
	//}
	//else {
	//echo view('erreur');
	//}
	//}
	
	public function renseigner() {
	$Modele = new \App\Models\Modele();
		
		$etape = $_POST['etape'];
		$kilometres = $_POST['kilometres'];
		$nuitees = $_POST['nuitees'];
		$repas = $_POST['repas'];
		
		$donnees = $Modele->creationfrais($etape, $kilometres, $nuitees, $repas);
		
	if (isset($donnees[0]->login)) {
			$data['login']=$donnees[0]->login;
				$etape = $donnees[0]->etape;
				$nuitees = $donnees[0]->nuitees;
				$repas = $donnees[0]->repas;
				$donnee2=$Modele->creationfrais($etape, $kilometres, $nuitees, $repas);
			echo view('renseigner', $data);
			}
	else {
		echo view('erreur');
	}
}
	
	
	
	public function renseigerhorsforfait() {
			$Modele = new \App\Models\Modele();
		
			$libelle = $_POST['libelle'];
			$date = $_POST['date'];
			$montant = $_POST['montant'];
		
			
			$donnees = $Modele->creationfichehorsfrais($libelle, $date, $montant);
			
			if (isset($donnees[0]->id)) {
			$data['id']=$donnees[0]->id;
				$libelle = $donnees[0]->libelle;
				$date = $donnees[0]->date;
				$montant = $donnees[0]->montant;
				$donnee2=$Modele->creationfichehorsfrais($libelle, $date, $montant);
			echo view('renseigner', $data);
			}
			else {
			echo view('erreur');
			}
			}
		

		




// Affiche une erreur
public function erreur($msgErreur) {
  echo view('vueErreur.php', $data);
}

}



?>