<?php
session_start();
require('controller/frontend.php');

try{
    if (isset($_GET['action']))
     {    
    	
        if ($_GET['action'] == 'listMat' )
         	{   
            
                listMat();
             
         	}
          else if ($_GET['action'] == 'accueil' ){
                accueil();
            }

        elseif ($_GET['action'] == 'accueil' )
          {       
             accueil();
             
          }
        elseif ($_GET['action'] == 'uploadDoc' )
          {  
                  $matId = isset($_POST['matId']) ? $_POST['matId'] : '';
                  $myfile = isset($_POST['myfile']) ? $_POST['myfile'] : '';
                  $nomf = isset($_POST['nomf']) ? $_POST['nomf'] : '';

                  // Traiter les données ici
                  uploadDoc($matId, $myfile, $nomf);

                  // Envoyer une réponse au client
                 echo "Les données ont été reçues : matId =". $matId.", myfile =".$myfile;
              //}
          }

        elseif ($_GET['action'] == 'uploadDev' )
          {  
                  $matId = isset($_POST['matId']) ? $_POST['matId'] : '';
                  $myfile = isset($_POST['myfile']) ? $_POST['myfile'] : '';
                  $nomf = isset($_POST['nomf']) ? $_POST['nomf'] : '';
                  //$pid = isset($_POST['pid']) ? $_POST['pid'] : '';

                  // Traiter les données ici
                  uploadDev($matId, $myfile, $nomf);

                  // Envoyer une réponse au client
                 echo "Les données ont été reçues : matId =". $matId.", myfile =".$myfile;
              //}
          }
        elseif ($_GET['action'] == 'menuCM' )
          {       
             menuCM();
             
          }
         elseif ($_GET['action'] == 'tele' )
             {       
               if (isset($_GET['fic']))
                tele($_GET['fic']);
             
            }
        
        elseif ($_GET['action'] == 'listMatP' )
             {       
            if (isset($_GET['id']) && $_GET['id'] > 0 )
             	{
               	listMatP($_GET['id']);
             	}
             else if(isset($_GET['id']) && $_GET['id']==0)
                {
                  listMatP($_SESSION['prof']);
              }
             else
             	{
             	throw new Exception('Erreur : les champs ne sont pas tous remplis !');
             	}
            }
     
          elseif ($_GET['action'] == 'listCourses') 
            {
               /*if (isset($_GET['mid'] )  
                 {*/
                    listCourses($_GET['mid'] );
                /* }
                else 
                {
                    throw new Exception('Erreur !');
                }*/
            }

        
       
          elseif ($_GET['action'] == 'listCoursesP') 
            {
                if (isset($_GET['mid']))  
                 {
                    listCoursesP($_GET['mid']);
                 }
                else 
                {
                    throw new Exception('Erreur !');
                }
            }

      
        elseif ($_GET['action'] == 'listEtud') 
            {
               
                    listEtud();
                
            }      
        elseif ($_GET['action'] == 'authentprof' ) 
             {

                    header("Content-Type: application/json; charset=UTF-8");
                    $obj = json_decode($_POST["x"], false);  
                    class Message
                         {
                             public $_msg;
                             public $_id;
                         }

                   
                    if (isset($obj->pseudo) && isset($obj->pwd)) 
                       {
                        $prof=authentP($obj->pseudo, $obj->pwd);
                        if($prof)
                         {
                            $myObj=new Message;
                            $myObj->_msg = "OK";
                            $myObj->_id = $prof['prid'];
                            $myJSON = json_encode($myObj);
                            echo $myJSON;
                          } 
                        
                        else 
                         {
                            $myObj->_msg = "échec";
                            $myObj->_id = "-1";
                            $myJSON = json_encode($myObj);
                            echo $myJSON;
                          }
                      }
                    else
                    {
                        $myObj->_msg = "échec";
                        $myObj->_id = "-2";
                        $myJSON = json_encode($myObj);
                        echo $myJSON;
                    }               
             }  
           

           elseif ($_GET['action'] == 'authent' ) 
             {
                    
                     header("Content-Type: application/json; charset=UTF-8");
                     $obj = json_decode($_POST["x"], false);       
                     if (isset($obj->pseudo)&& isset($obj->pwd)) 
                     {
                      	// echo $obj->pseudo;
                         $stud=authent($obj->pseudo, $obj->pwd);
                       	class Message
                       	{
                           public $_msg;
                           public $_name;
                           public $_id;
                          // public $_prog;
                        }
                      	$myObj=new Message;
                        if($stud)
                       		{
                            $myObj->_msg = "OK";
                            $myObj->_name = $stud['prenom'];
                            $myObj->_id = $stud['aid'];
                                                

                           // $myObj->_prog =$stud['program'];
                            $myJSON = json_encode($myObj);
                            echo $myJSON;
                             //$GLOBALS['studId']=$myObj_id;
                            }
                        else 
                           {
                              $myObj->_msg = "échec";
                              $myObj->_id = "-1";
                              $myJSON = json_encode($myObj);
                              echo $myJSON;
                            }
                     }
                   else
                    {
                        $myObj->_msg = "échec";
                        $myObj->_id = "-2";
                        $myJSON = json_encode($myObj);
                        echo $myJSON;
                    }               
        	   }
       
           
    }
    else {    
    	accueil();
      }
  
   } 
catch(Exception $e) 
	{ // S'il y a eu une erreur, alors...    
    	echo $e->getMessage();
	}