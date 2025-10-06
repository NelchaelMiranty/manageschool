<?php
class CoursManager
{
    public function getCours($mid)
    {
       $db = $this->dbConnect();
       $sql = "SELECT cid, mid, num, type, fichier FROM cours where mid= :m  ORDER BY num ASC ";
       $stmt = $db->prepare($sql);
       $stmt->bindParam(':m',$mid, PDO::PARAM_INT);
       $stmt->execute();
       //$resultat= $stmt->get_result();
       $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
       return $resultat;
     }

    
     public function ajoutCours($mid, $nomf){

       // $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $db = $this->dbConnect();
        $req = $db->query("SELECT max(cid) FROM cours");
        $result = $req->fetch();
        $maxcid = $result[0] + 1;
        

        $sql = "SELECT count(*) as c FROM cours where mid= :m";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':m',$mid, PDO::PARAM_INT);
        $stmt->execute();

        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $maxn= $resultat['c']+1;

       
        $infoFichier = pathinfo($nomf);
        $extension = $infoFichier['extension'];

        if($extension!='pdf')
          if($extension=='mp4'){
            $type='video';
          }
          else{
            $type='uploads';
          }

        else
          $type='pdf';

        $sql = "INSERT INTO cours (cid, mid, num, type, fichier) VALUES(:c,:m, :n, :t, :f)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':c',$maxcid, PDO::PARAM_INT);
        $stmt->bindParam(':m',$mid, PDO::PARAM_INT);
        $stmt->bindParam(':n',$maxn, PDO::PARAM_INT);
        $stmt->bindParam(':t',$type, PDO::PARAM_STR);
        $stmt->bindParam(':f',$nomf, PDO::PARAM_STR);
        $stmt->execute();
        return $type;

     }

    private function dbConnect()
    {
      
      $db = new PDO('mysql:host=localhost;dbname=aidev;charset=utf8', 'root', '');
      return $db;
    }

    
}