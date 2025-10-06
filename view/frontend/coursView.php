<!DOCTYPE html>
<html>
   <head>
	      <meta charset="utf-8" />	
        <title> AI & Dev Academy    </title>	
        <link rel="stylesheet" type="text/css" href="public/css/cclass.css" media="screen" />
        <script src="public/js/jquery-3.4.1.js" type="text/javascript"></script>  
        <script src="public/js/changetexte.js"></script>
   </head>
<?php 
 $title = 'Liste des cours';
  ?>
<?php ob_start();
  //session_start(); 

?>

<div>
	<input type="hidden" name="MAX_FILE_SIZE" value=10000000/>
	<input type="hidden" id= "matId" name="matId" value="<?php echo $matId; ?>"/>
	<input type="file" id="myfile" name="myfile" value="myfile"/>
	<input type="submit" class="button" value="Charger mon devoir (pdf uniquement!)" onclick="uploadDev()" />
</div>
<p> </p>
 <div class="news">
   <?php 
    define('BASE_URL', '/infobasics/');
    echo'<table class = "matieres">';
     echo '<thead>';
		echo'<tr>';
			//echo'<th>ID</th>';
			echo'<th>Matière</th>';
			echo'<th>Numéro</th>';
			//echo'<th>Syllabus</th>';
			echo'<th>Fichier</th>';
			
		echo'</tr>';
	echo '</thead>';

	echo '<tbody>';	
	
	$rows=count($resultat);
   
   foreach ($resultat as $cours){
     		
		echo'<tr>';
			//echo'<td>'.$cours['cid'].'</td>';
			echo'<td>'.$cours['mid'].'</td>';
			echo'<td>'.$cours['num'].'</td>';
			//echo'<td>'.$cours['type'].'</td>';
			if($cours['type']==3)
				echo'<td>'.'<a href= "public/video/'.$cours['fichier'].'" target="ifram">'.$cours['fichier'].'</a></td>';
			else if($cours['type']==1)
				/*echo'<td>Hello</td>';*/
				echo'<td>'.'<a href= "public/pdf/'.$cours['fichier'].'" target="ifram">'.$cours['fichier'].'</a></td>';
			else if($cours['type']==2)
				echo'<td>'.'<a href= "public/ppt/'.$cours['fichier'].'" target="ifram">'.$cours['fichier'].'</a></td>';
		echo'</tr>';
		
	 }
	
  echo '</tbody>';
  echo'</table>'; ?>
       
 </div>
        
      
 <div id="container">  
 	   
    <iframe id="ifram" name="ifram" width="1000" height="900" frameborder="0" scrolling="no"></iframe>
 </div>  
<?php $content = ob_get_clean(); ?>   

<?php 
  
  require('platformTemplate.php'); ?>