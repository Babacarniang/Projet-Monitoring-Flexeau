<?php
class Database{
    // Connexion à la base de donnée

private $host = "localhost";
private $db_name = "table_abonnées_flexeau";
private $username = "root";
private $password = "";
public  $connexion;

// Getter pour la connexion
public function getConnection(){
    $this->connexion = null;

    try{
        $this->connexion = new PDO("mysql:host=" .$this->host .";dbname=" .$this->db_name,
        $this->username, $this->password);
        $this->connexion->exec("set name utf8");
    }catch(PDOException $exception){
        echo "Erreur de connexion : " . $exception->getMessage();
    } 
    return $this->connexion; 
    }
   
}

