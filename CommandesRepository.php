<?php

class CommandesRepository{
    public function __construct(private PDO $db){}

    public function add(Commandes $commandes){
        $request = "INSERT INTO commandes (client_id, date, total) 
                    VALUES (:client_id, :date, :total);";

        $statement = $this->db->prepare($request);
        
        return $statement->execute([
            "client_id" => $commandes->client_id, 
            "date" => $commandes->date, 
            "total" => $commandes->total]); 
    }

    public function updateCommande(Commandes $commande){
    $request = "UPDATE commandes 
                SET client_id = :client_id, date = :date, total = :total 
                WHERE id = :id";

    $statement = $this->db->prepare($request); 
    $statement->bindParam(":id", $commande->id);
    $statement->bindParam(":client_id", $commande->client_id);
    $statement->bindParam(":date", $commande->date);
    $statement->bindParam(":total", $commande->total);
    
    return $statement->execute(); 
}

public function deleteCommande(int $id) {
    $request = "DELETE FROM commandes WHERE id = :id";
    $statement = $this->db->prepare($request);

    return $statement->execute([':id' => $id]);
}


}