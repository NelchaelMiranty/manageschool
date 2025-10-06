<?php 
 $title = 'Liste des enseignants';
  ?>
<?php ob_start(); ?>


 <div class="news">
   <?php 

    echo'<table class = "profs">';
     echo '<thead>';
		echo'<tr>';
			echo'<th>PrID</th>';
			echo'<th>Nom</th>';
			echo'<th>Prénom</th>';
			
		echo'</tr>';
	echo '</thead>';
	echo '<tbody>';	
    $profs = $req->fetchAll(PDO::FETCH_ASSOC);
    foreach ($profs as $prof)
     {
     	$prid = $prof['prid'];
        $nom =  $prof['nom'];
        $pren = $prof['prenom'];
       	
		echo'<tr>';
			echo'<td>'.$prid.'</td>';
			echo'<td>'.$nom.'</td>';
			echo'<td>'.$pren.'</td>';
			
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

