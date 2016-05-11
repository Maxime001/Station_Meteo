<?php

class Bdd{
    protected $bdd="";

    /**
     * Connection a la base de donnée
     */
    public function __construct(){
        try{ $this->bdd = new PDO('mysql:host=localhost;dbname=meteo;charset=utf8', 'root', 'P3gaze1992');}
        catch(Exception $e){die('Erreur : '.$e->getMessage());}
    }
}

