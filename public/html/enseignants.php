<?php
require_once('../../model/frontend/ProfManager.php');
 $profMan = new ProfManager(); 
 $resultat =$profMan->getProfs();?>
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
          <th>Prof-ID</th>
          <th>Nom</th>
          <th>Prénom</th>
          
      </tr>
    </thead>
    <tbody> 
    <?php  
    while ($prof = $resultat->fetch())
     {
      $prid = $prof['prid'];
      $nom = $prof['nom'];
      $pren =$prof['prenom'];
      

       echo'<tr>';
        echo'<td>'.$prid.'</td>';
        echo'<td>'.'<a href= "public/pdf/CVP/'.$prid.'.pdf" target="ifram">'.$nom.'</a></td>';
        echo'<td>'.$pren.'</td>';
       
      echo'</tr>';

  }?>

</tbody>

 </table>
<div id="container">  
     
    <iframe id="ifram" name="ifram" width="1000" height="900" frameborder="0" scrolling="no"></iframe>
 </div>   


</body>
</html> 