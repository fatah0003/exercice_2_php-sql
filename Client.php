<?php

class Client{
    public function __construct(
        public ?int $id,
        public string $nom, 
        public string $prenom, 
        public string $adresse, 
        public string $cp,
        public string $ville,
        public string $phone
    ){}
}