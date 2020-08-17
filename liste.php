<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// On vérifie que la méthode utilisée est correcte
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    // On inclut les fichiers de configuration et d'accès aux données
    include_once 'Database.php';
    include_once 'Abonnes.php';

    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnection();

    // On instancie les abonnes
    $abonne = new Abonnes($db);

    // On récupère les données
    $stmt = $abonne->lire();

    // On vérifie si on a au moins 1 abonne
    if($stmt->rowCount() > 0){
        // On initialise un tableau associatif
        $tableauAbonnes = [];
        $tableauAbonnes['abonnes'] = [];

        // On parcourt les abonnes
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $abon = [
                "num_abon" => $num_abon,
                "serial_num" => $serial_num,
                "forage" => $forage,
                "village" => $village,
                "latitude" => $latitude,
                "longitude" => $longitude,
                "prenom" => $prenom,
                "nom" => $nom,
                "nci" => $nci,
                "tel" => $tel,
                "volume" => $volume,
                "date_heure" => $date_heure,
                "dry" => $dry,
                "reverse" => $reverse,
                "leak" => $leak,

            ];

            $tableauAbonnes['abonnes'][] = $abon;
        }

        // On envoie le code réponse 200 OK
        http_response_code(200);

        // On encode en json et on envoie
        echo json_encode($tableauAbonnes);
    }

}else{
    // On gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}
