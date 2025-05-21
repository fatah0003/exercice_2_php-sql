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
}