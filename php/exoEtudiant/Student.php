<?php
class Etudiant {
    public function __construct(
        public ?int $id, 
        public string $name, 
        public string $first_name,
        public DateTime $date_of_birth,
        public string $email,
    ){}
    
}