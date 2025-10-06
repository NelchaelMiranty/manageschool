<?php
class ProfManager
{
    public function getProfs()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT prid, nom, prenom FROM profs');

        return $req;
    }

    public function getProf($profId)
    {
       $db = $this->dbConnect();
       $req = $db->prepare('SELECT * FROM profs WHERE prid = ?');
       $req->execute(array($profId));
       $prof = $req->fetch();
       return $prof;
    }
  public function getMatP($profId)
    {
       $db = $this->dbConnect();
       $reqp = $db->prepare('SELECT * FROM matieres WHERE prid = ?');
       $reqp->execute(array($profId));
      // $tprog = $req->fetch();
       return $reqp;
    }
 public function authentprof($pseudo,$pwd)
    {
       $db = $this->dbConnect();
       $req = $db->prepare('SELECT * FROM profs WHERE login=? and mdp=?');
       $req->execute(array($pseudo,$pwd));
       $prof = $req->fetch();
       return $prof;
    }

public function authentCM($pseudo,$pwd)
    {
       $db = $this->dbConnect();
       $req = $db->prepare('SELECT * FROM profs WHERE login=? and mdp=? and stat=1');
       $req->execute(array($pseudo,$pwd));
       $cm = $req->fetch();
       return $cm;
    }

  private function dbConnect()
    {
        //$db = new PDO('mysql:host=localhost;dbname=labirint_cclass;charset=utf8', 'labirint_cclass', 'lishundAsup1966');
        $db = new PDO('mysql:host=localhost;dbname=labirint_onimaster;charset=utf8', 'root', '');
        return $db;
    }


}