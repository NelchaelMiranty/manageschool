<?php
class MatManager
{
    public function getMats()
    {
        $db = $this->dbConnect();
        $req = $db->query("SELECT * FROM matiere");

        return $req;
    }

    private function dbConnect()
    {
       // $db = new PDO('mysql:host=localhost;dbname=labirint_cclass;charset=utf8', 'labirint_cclass', 'lishundAsup1966');
        $db = new PDO('mysql:host=localhost;dbname=aidev;charset=utf8', 'root', '');
        return $db;
    }

   
}