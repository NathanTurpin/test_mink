<?php

namespace App\Service\Animal;

use App\DTO\AnimalDTO;
use App\Repository\AnimalRepository;
use RaceDTO;
use TypeDTO;

class AnimalService
{
  private AnimalRepository $animalRepository;

  public function __construct(AnimalRepository $animalRepository)
  {
    $this->animalRepository = $animalRepository;
  }

  /**
   * Convertit une collection d'animaux en une collection de DTOs.
   *
   * @return AnimalDTO[]
   */
  public function getAllAnimals(): array
  {
    $animals = $this->animalRepository->findAll();
    return array_map(function ($animal) {

      $typeDTO = $animal->getType() ? new TypeDTO(
        $animal->getType()->getId(),
        $animal->getType()->getName(),
        $animal->getType()->getSlug()
      ) : null;


      $raceDTO = $animal->getRace() ? new RaceDTO(
        $animal->getRace()->getId(),
        $animal->getRace()->getName(),
        $animal->getType()->getSlug(),
        $typeDTO
      ) : null;


      return new AnimalDTO(
        $animal->getId(),
        $animal->getName(),
        $animal->getAge(),
        $animal->getDescription(),
        $animal->getPrice(),
        $animal->getTva(),
        $animal->getImages(),
        $animal->getSlug(),
        $typeDTO,
        $raceDTO
      );
    }, $animals);
  }
}
