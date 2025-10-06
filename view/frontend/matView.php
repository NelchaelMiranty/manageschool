<?php 
 $title = 'Liste des matières';
  ?>
<?php ob_start(); ?>


 <div class="news">
   <?php 

    echo'<table class = "matieres">';
     echo '<thead>';
		echo'<tr>';
			echo'<th>ID</th>';
			echo'<th>Intitulé</th>';
			echo'<th>Catégorie</th>';
		echo'</tr>';
	echo '</thead>';
	echo '<tbody>';	
	
    while ($mats = $req->fetch())
     {
     	$mid = $mats['mid'];
        $nom = $mats['intitule'];
        $cat = $mats['categorie'];
       
	
		echo'<tr>';
			echo'<td>'.$mid.'</td>';
			echo'<td>'.'<a href= "index.php?action=listCourses&mid='.$mid.'">'.$nom.'</a></td>';
			echo'<td>'.$cat.'</td>';
			
		echo'</tr>';
	 }
  echo '</tbody>';
  echo'</table>';
  $req->closeCursor(); ?>
       
       
 </div>
        
      
 <div id="container">  
    <iframe id="ifram" name="ifram" width="750" height="654" frameborder="0" scrolling="no"></iframe>
 </div>  
<?php $content = ob_get_clean(); ?>   

<?php require('platformTemplate.php'); ?>