<?php

class Bdd{

    public static function connexion()
    {
        try
        {
            $bdd = new PDO("pgsql:host=localhost;port=5432;dbname=tripcomment", "postgres", "1234");
            // echo "connexion BDD OK";
            return $bdd;
        }
        catch(Exception $e)
        {
            echo $e;
        }
    }

}
// test bdd 
// $bdd = new Bdd;
// $bdd->connexion();

// $bdd = Bdd ::connexion()