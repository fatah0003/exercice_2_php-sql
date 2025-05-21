<?php

class Commandes{
    public function __construct(
        public ?int $id,
        public int $client_id,
        public string $date,
        public float $total
    ){}
}