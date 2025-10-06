<?php 
 $title = 'Liste des matières';
  ?>
<?php ob_start();
	//session_start(); 
	$_SESSION['prof']= $prid;
	?>


 <div class="news">
   <?php 

    echo'<table class = "matieres">';
     echo '<thead>';
		echo'<tr>';
			echo'<th>ID</th>';
			echo'<th>Intitulé</th>';
			echo'<th>Prof</th>';
			echo'<th>Crédits</th>';
			echo'<th>V.H.</th>';
			echo'<th>Semestre</th>';
			echo'<th>Délai</th>';
		echo'</tr>';
	echo '</thead>';
	echo '<tbody>';	
    while ($mats = $req->fetch())
     {
     	$mid = $mats['mid'];
        $nom = $mats['nom'];
        $cred = $mats['cred'];
        $prof =$mats['prof'];
		$vh = $mats['vh'];
		$sem = $mats['sem'];
		$del = $mats['delai'];
		$pri = $mats['prid'];
	
		echo'<tr>';
			echo'<td>'.$mid.'</td>';
			if ($prid==$pri)
				echo'<td>'.'<a href= "index.php?action=listCoursesP&mid='.$mid.'">'.$nom.'</a></td>';
			else
				echo'<td>'.$nom.'</td>';
			echo'<td>'.$prof.'</td>';
			echo'<td>'.$cred.'</td>';
			echo'<td>'.$vh.'</td>';
			echo'<td>'.$sem.'</td>';
			echo'<td>'.$del.'</td>';
		echo'</tr>';
	 }
  echo '</tbody>';
  echo'</table>';
  $req->closeCursor(); ?>
       
       
 </div>
        
      
 <div id="container">  
    <iframe id="ifram" name="ifram" width="1000" height="900" frameborder="0" scrolling="no"></iframe>
 </div>  
<?php $content = ob_get_clean(); ?>   

<?php require('platformPTemplate.php'); ?>