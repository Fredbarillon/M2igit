<?php

namespace App\Entity;

class EventClass
{
    public function __construct(
        public int $id,
        public string $title,
        public string $location,
        public string $date,
        public bool $isPublic
    ) {}
}