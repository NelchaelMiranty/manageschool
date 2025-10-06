<?php

// Chargement des classes
require_once('model/frontend/StudentManager.php');
require_once('model/frontend/MatManager.php');
require_once('model/frontend/ProfManager.php');
require_once('model/frontend/CoursManager.php');
//require_once('model/frontend/DevManager.php');

function accueil()
{
    require('view/frontend/accueil.php');
}

function uploadDoc($mid, $myfile, $nomf)
{
   // require('view/frontend/accueil.php');

     $coursMan = new CoursManager();
     $repertoireDestination = dirname(__FILE__)."/uploads/";
     $nomDestination = $mid."_".$nomf;
    // $nomDestination = $mid."_".$nomf."_".date("YmdHis");
    // $infosfichier = pathinfo($_FILES['myfile']['tmp_name']);
   // $extension_upload = $infosfichier['extension'];
  //  $filenam=  $infosfichier['basename'];
    
    if (is_uploaded_file($_FILES["myfile"]["tmp_name"])) {
         if (rename($_FILES["myfile"]["tmp_name"],
                   $repertoireDestination.$nomDestination)) {
                echo "Le fichier temporaire ".$_FILES["myfile"]["tmp_name"].
                " a été déplacé vers ".$repertoireDestination.$nomDestination;

                $type=$coursMan->ajoutCours($mid, $nomf);
                $rep= dirname(__FILE__)."/../public/".$type."/";
                // Copie du fichier
                if (copy($repertoireDestination.$nomDestination, $rep.$nomf)) {
                        echo "Le fichier a été copié avec succès !";
                } else {
                    echo "La copie du fichier a échoué...";
              }

            } 
         else {
                echo "Le déplacement du fichier temporaire a échoué".
                " vérifiez l'existence du répertoire ".$repertoireDestination;
            }          
        } 
    else {
        echo "Le fichier n'a pas été uploadé (trop gros ?)";
    }

    //listeCoursesP($mid);
   
    $resultat=$coursMan->getCours($mid);
    //header("Refresh:0; url=view/frontend/coursViewP.php");
    require('view/frontend/coursViewP.php');
}
function uploadDev($mid, $myfile, $nomf)
{
   // require('view/frontend/accueil.php');

     //$devMan = new DevManager();
     $repertoireDestination = dirname(__FILE__)."/uploads/devoirs/";
     $nomDestination = $mid."_".$nomf;
       
    if (is_uploaded_file($_FILES["myfile"]["tmp_name"])) {
         if (rename($_FILES["myfile"]["tmp_name"],
                   $repertoireDestination.$nomDestination)) {
                echo "Le fichier temporaire ".$_FILES["myfile"]["tmp_name"].
                " a été déplacé vers ".$repertoireDestination.$nomDestination;
                
               // $devMan->ajoutDev($mid,$nomf);

                $rep= dirname(__FILE__)."/../public/uploads/devoirs/";
               
                // Copie du fichier
                if (copy($repertoireDestination.$nomDestination, $rep.$nomDestination)) {
                        echo "Le fichier a été copié avec succès !";
                } else {
                    echo "La copie du fichier a échoué...";
              }

            } 
         else {
                echo "Le déplacement du fichier temporaire a échoué".
                " vérifiez l'existence du répertoire ".$repertoireDestination;
            }          
        } 
    else {
        echo "Le fichier n'a pas été uploadé (trop gros ?)";
    }

    //listeCoursesP($mid);
    $coursMan= new CoursManager();
   
    $resultat=$coursMan->getCours($mid);
    //header("Refresh:0; url=view/frontend/coursViewP.php");
    require('view/frontend/coursViewP.php');
}

function menuCM()
{
   require('view/frontend/menuCMView.php');
}

function authent($pseudo, $pwd)
{
   $studMan = new StudentManager();	
   $stud = $studMan->authentstud($pseudo, $pwd);
   return $stud;	
}
function authentP($pseudo, $pwd)
{
   $profMan = new ProfManager();	
   $prof = $profMan->authentprof($pseudo,$pwd);
   return $prof;
 }
 function authentCM($pseudo, $pwd)
{
   $profMan = new ProfManager();	
   $cm = $profMan->authentCM($pseudo,$pwd);
   return $cm;
 }
function profil($id)
{
  $studMan = new StudentManager();  
  $stud=$studMan->getStudent($id);
  require('view/frontend/profilView.php');
}
function listMat()
{
    $matMan = new MatManager();	
    $req =$matMan->getMats();
    
    require ('view/frontend/matView.php');
     
}

function listMatP($prid)
{
    $matMan = new MatManager(); 
    $req =$matMan->getMats();
    require ('view/frontend/matViewP.php');
     
}

function listCourses($mid)
{
  $coursMan = new CoursManager();
  $resultat=$coursMan->getCours($mid);
  $matId=$mid;
  

  require('view/frontend/coursView.php');
  
}

function listCoursesP($mid)
{
  $coursMan = new CoursManager();
  $resultat=$coursMan->getCours($mid);
  $matId=$mid;
  
  require('view/frontend/coursViewP.php');
  
}

function listProfs()
{
  $profMan = new ProfManager();
  $req=$profMan->getProfs();
  
  require('view/frontend/profsView.php');
  
}
function gestionAcademique()
{
    require('view/frontend/gestionAcademiqueView.php');
}

function getEnseignantsAPI()
{
    header("Content-Type: application/json; charset=UTF-8");
    $profMan = new ProfManager();
    $req = $profMan->getProfs();
    $enseignants = [];
    
    while ($prof = $req->fetch()) {
        $enseignants[] = [
            'id' => $prof['prid'],
            'nom' => $prof['nom'],
            'prenom' => $prof['prenom'],
            'mention' => 'Informatique', // Default value, you can modify based on your database
            'diplome' => 'Master', // Default value
            'etablissement' => 'AI&DEV Academy', // Default value
            'cv' => null
        ];
    }
    
    echo json_encode($enseignants);
}

function getEtudiantsAPI()
{
    header("Content-Type: application/json; charset=UTF-8");
    $studMan = new StudentManager();
    $req = $studMan->getStudents();
    $etudiants = [];
    
    while ($stud = $req->fetch()) {
        $etudiants[] = [
            'id' => $stud['aid'],
            'nom' => $stud['nom'],
            'prenom' => $stud['prenom'],
            'niveau' => 'L3', // Default value, you can modify based on your database
            'mention' => 'Informatique', // Default value
            'matricule' => 'ETU' . str_pad($stud['aid'], 3, '0', STR_PAD_LEFT)
        ];
    }
    
    echo json_encode($etudiants);
}