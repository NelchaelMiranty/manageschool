<?php
require_once('../../model/frontend/MatManager.php');
 $matMan = new matManager(); 
 $resultat =$matMan->getMats();?>

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
        <th><a href=# > TD </a></th>
        <th>Intitulé</th>
        <th>Crédits</th>
        <th>Sem.</th>
        
      </tr>
    </thead>

  <tbody> 
    <?php  
    while ($mats = $resultat->fetch())
     {
      $mid = $mats['mid'];
      $nom = $mats['nom'];
      $cred = $mats['cred'];
      $sem = $mats['sem'];

       echo'<tr>';
        echo'<td>'.$mid.'</td>';
        echo'<td>'.'<a href= "public/pdf/SYL/'.$mid.'.pdf" target="ifram">'.$nom.'</a></td>';
        //echo'<td>'.$nom.'</td>';
        echo'<td>'.$cred.'</td>';
        echo'<td>'.$sem.'</td>';
      echo'</tr>';

  }?>

</tbody>
 
</table>
<div id="container" class ="positioned">  
     
    <iframe id="ifram" name="ifram" width="1000" height="900" frameborder="0" scrolling="no"></iframe>
 </div>   

</body>

</html>