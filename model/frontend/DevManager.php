<?php
class DevManager
{
    public function getDevs($pid, $mid)
    {
        $db = $this->dbConnect();
       $sql = "SELECT did, mid, pid, fichier FROM devoirs where mid= :m  and pid= :p  ";
       $stmt = $db->prepare($sql);
       $stmt->bindParam(':m',$mid, PDO::PARAM_INT);
       $stmt->bindParam(':p',$pid, PDO::PARAM_INT);
       $stmt->execute();
       //$resultat= $stmt->get_result();
       $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
       return $resultat;
       
    }
public function ajoutDev($mid,  $nomf){

       // $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $db = $this->dbConnect();
       
        $sql = "INSERT INTO devoirs (mid, fichier) VALUES(:m,:f)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':m',$mid, PDO::PARAM_INT);
       // $stmt->bindParam(':p',$pid, PDO::PARAM_INT);
        $stmt->bindParam(':f',$nomf, PDO::PARAM_STR);
        $stmt->execute();
        

     }
    private function dbConnect()
    {
       // $db = new PDO('mysql:host=localhost;dbname=labirint_cclass;charset=utf8', 'labirint_cclass', 'lishundAsup1966');
        $db = new PDO('mysql:host=localhost;dbname=labirint_onimaster;charset=utf8', 'root', '');
        return $db;
    }

   
}