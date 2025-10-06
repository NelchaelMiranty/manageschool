<?php
require_once('../../model/frontend/StudentManager.php');
 $studMan = new StudentManager(); 
 $resultat =$studMan->getStudents();

 ?>

<html>
   <head>
  <meta charset="utf-8" />  
        <title> ONIMASTER     </title> 
        <link rel="stylesheet" type="text/css" href="css/labirint2.css" media="screen" />
        
   </head>
<body>

     <table class = "matieres">
      <thead>
        <tr>
          <th>Matr-ID</th>
          <th>Nom</th>
          <th>Prénom</th>
          
      </tr>
    </thead>
    <tbody> 
   <?php  
    //$etus = $resultat->fetchAll(PDO::FETCH_ASSOC);
    //foreach ($etus as $etu)
    while ($etu = $resultat->fetch())
     {
      $pid = $etu['pid'];
      $nom = $etu['nom'];
      $pren = $etu['prenom'];
     
  
      echo'<tr>';
        echo'<td>'.$pid.'</td>';
        echo'<td>'.'<a href= "public/pdf/CVE/'.$pid.'.pdf" target="ifram">'.$nom.'</a></td>';
        //echo'<td>'.$nom.'</td>';
        echo'<td>'.$pren.'</td>';
        //echo'<td>'.'<a href="public/pdf/CVP/'.$prid.'.pdf" target="ifram" >CV </a></td>';
                   
        //echo'<td>'.'<a href="public/pdf/DIPL/'.$prid.'.pdf" target="ifram" >Dipl </a></td>';
      echo'</tr>';
    }
?>


  </tbody>
 </table>
<div id="container">  
     
    <iframe id="ifram" name="ifram" width="1000" height="900" frameborder="0" scrolling="no"></iframe>
 </div>   
</body>
</html> 