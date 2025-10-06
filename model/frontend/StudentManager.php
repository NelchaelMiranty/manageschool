<?php
class StudentManager
{
    public function getStudents()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT aid, nom, prenom FROM apprenant ORDER BY aid');

        return $req;
    }

    public function getStudent($studId)
    {
       $db = $this->dbConnect();
       $req = $db->prepare('SELECT * FROM apprenant WHERE aid = ?');
       $req->execute(array($studId));
       $stud = $req->fetch();
       return $stud;
    }

     public function authentstud($pseudo,$pwd)
    {
       $db = $this->dbConnect();
       $req = $db->prepare('SELECT * FROM apprenant WHERE pseudo=? and  mdp=?');
       $req->execute(array($pseudo,$pwd));
       $stud = $req->fetch();
       return $stud;
    }

    private function dbConnect()
    {
       // $db = new PDO('mysql:host=localhost;dbname=labirint_cclass;charset=utf8', 'labirint_cclass', 'lishundAsup1966');
      $db = new PDO('mysql:host=localhost;dbname=aidev;charset=utf8', 'root', '');
        return $db;
    }

     public function updateStudent($id, $lastname, $firstname)
  {
     $db= $this->dbConnect();
     $req= $db->prepare('UPDATE apprenant SET nom=?, prenom=?, WHERE aid= ?');
     $req->execute(array($lastname, $firstname, $id));
  } 
}