<?php
require_once('../../model/frontend/MatManager.php');
 $matMan = new MatManager(); 
 $resultat =$matMan->getMats(); ?>
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
        <th>ID</th>
        <th>Intitulé</th>
        <th>Prof</th>
        <th>Crédits</th>
        <th>V.H.</th>
        <th>Semestre</th>
        <th>Syllabus</th>
      </tr>
    </thead>
        
  <tbody> 
    <?php  
    while ($mats = $resultat->fetch())
     {
      $mid = $mats['mid'];
      $nom = $mats['nom'];
      $prof =$mats['prof'];
      $cred = $mats['cred'];
      $vh = $mats['vh'];
      $sem = $mats['sem'];
    
  
      echo'<tr>';
        echo'<td>'.$mid.'</td>';
        echo'<td>'.'<a href= "public/pdf/SYL/'.$mid.'.pdf" target="ifram">'.$nom.'</a></td>';
        echo'<td>'.$nom.'</td>';
        echo'<td>'.$prof.'</td>';
        echo'<td>'.$cred.'</td>';
        echo'<td>'.$vh.'</td>';
        echo'<td>'.$sem.'</td>';
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