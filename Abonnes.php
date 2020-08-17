<?php
class Abonnes{
    // Connexion
    private $connexion;
    private $table = "abonnes";
    

    // object properties
    public $num_abon;
    public $serial_num;
    public $forage;
    public $village;
    public $latitude;
    public $longitude;
    public $prenom;
    public $nom;
    public $nci;
    public $tel;
    public $volume;
    public $date_heure;
    public $dry;
    public $reverse;
    public $leak;

   

    /**
     * Constructeur avec $db pour la connexion à la base de données
     *
     * @param $db
     */
    public function __construct($db){
        $this->connexion = $db;
    }

    /**
     * Lecture des forage
     *
     * @return void
     */
    public function lire(){
 
$sql = "SELECT*FROM `abonnes`
       LEFT JOIN `last_data`
       ON abonnes.serial_num = last_data.serial_number ORDER BY last_data.dry";

        // On prépare la requête
        $query = $this->connexion->prepare($sql);

        // On exécute la requête
        $query->execute();

        // On retourne le résultat
        return $query;
    }

}