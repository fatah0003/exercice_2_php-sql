<?php

require_once "Client.php";
require_once "Commandes.php";
require_once "ClientRepository.php";
require_once "CommandesRepository.php";

 $db = null; 
    try {
        $db = new PDO("mysql:host=localhost;dbname=php", "root", ""); 
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "La connexion est établie avec notre BDD!", PHP_EOL; 
    } catch (PDOException $e){
        echo "Erreur de connexion : " . $e->getMessage(), PHP_EOL; 
        return; 
    }

    $request = "CREATE TABLE IF NOT EXISTS client (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    adresse VARCHAR(255) NOT NULL,
    cp VARCHAR(10) NOT NULL,
    ville VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL
);";

$db->exec($request);
echo "Table client créée avec succès !", PHP_EOL;

$request = "CREATE TABLE IF NOT EXISTS commandes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    date DATE NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (client_id) REFERENCES client(id) ON DELETE CASCADE
);";

$db->exec($request);
echo "Table commandes créée avec succès !", PHP_EOL;


$clientrepo = new ClientRepository($db);

$client = new Client(null, "Ophelie", "elephant", "Rue de la rose", "42325", "Roanne", "0605820894");
$clientrepo->add($client);




