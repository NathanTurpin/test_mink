<?php

namespace App\Controller;

use App\Entity\Race;
use App\Repository\RaceRepository;
use App\Repository\TypeRepository;
use App\Service\Animal\AnimalService;
use RaceDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use TypeDTO;

class HomeController extends AbstractController
{
    private AnimalService $animalService;
    private TypeRepository $typeRepository;
    private RaceRepository $raceRepository;

    public function __construct(AnimalService $animalService, TypeRepository $typeRepository, RaceRepository $raceRepository)
    {
        $this->animalService = $animalService;
        $this->typeRepository = $typeRepository;
        $this->raceRepository = $raceRepository;
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $animalDTOs = $this->animalService->getAllAnimals();

        $types = $this->typeRepository->findAll();
        $typeDTOs = array_map(function ($type) {
            return new TypeDTO(
                $type->getId(),
                $type->getName(),
                $type->getSlug(),
            );
        }, $types);

        $races = $this->raceRepository->findAll();
        $racesDTOs = array_map(function ($race) {
            $typeDTO = new TypeDTO(
                $race->getType()->getId(),
                $race->getType()->getName(),
                $race->getType()->getSlug()
            );

            return new RaceDTO(
                $race->getId(),
                $race->getName(),
                $race->getSlug(),
                $typeDTO
            );
        }, $races);

        return $this->render('home/index.html.twig', [
            'animals' => $animalDTOs,
            'types' => $typeDTOs,
            'races' => $racesDTOs
        ]);
    }
}
