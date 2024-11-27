<?php

namespace App\DTO;

use RaceDTO;
use TypeDTO;

class AnimalDTO
{


  public function __construct(
    public int $id,
    public string $name,
    public int $age,
    public string $description,
    public float $price,
    public float $tva,
    public string $images,
    public string $slug,
    public ?TypeDTO $type,
    public ?RaceDTO $race
  ) {}
}
