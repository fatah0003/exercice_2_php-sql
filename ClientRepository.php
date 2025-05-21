<?php


class Clientrepository {
    public function __construct(private PDO $db){}

    public function add(Client $client){
        $request = "INSERT INTO client (nom, prenom, adresse, cp, ville, phone) 
                    VALUES (:nom, :prenom, :adresse, :cp, :ville, :phone);";

        $statement = $this->db->prepare($request);
        
        return $statement->execute([
            "nom" => $client->nom, 
            "prenom" => $client->prenom, 
            "adresse" => $client->adresse, 
            "cp" => $client->cp,
            "ville" => $client->ville,
            "phone" => $client->phone]); 
    }

    public function findAll(): array{
        $request = "SELECT * FROM client;"; 
        $stmt = $this->db->prepare($request); 
        $stmt->execute(); 

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        return $results; 
    }

    public function update(Client $client){
        $request = "UPDATE client 
        SET nom = :nom, prenom = :prenom, adresse = :adresse, cp = :cp, ville = :ville, phone = :phone 
        WHERE id=:id";

        $statement = $this->db->prepare($request); 
        $statement->bindParam(":id", $client->id);
        $statement->bindParam(":nom", $client->nom);
        $statement->bindParam(":prenom", $client->prenom);
        $statement->bindParam(":adresse", $client->adresse);
        $statement->bindParam(":cp", $client->cp);
        $statement->bindParam(":ville", $client->ville);
        $statement->bindParam(":phone", $client->phone);
        return $statement->execute(); 
    }

    public function deleteClientxithCommande(int $idClient){
        try{
            $this->db->beginTransaction();                   
            $request = "DELETE FROM commandes WHERE client_id = $idClient";
            $stmt = $this->db->prepare($request);
            $stmt->execute();

            $request = "DELETE FROM client WHERE id=:id";
            $stmt = $this->db->prepare($request);
            $stmt->execute(["id" => $idClient]);
            
            $this->db->commit();
        }catch(PDOException $e){
            echo "Erreur, nous mettons fin à la transation : ", $e->getMessage(); 
            $this->db->rollBack();
        }
        
    }
}