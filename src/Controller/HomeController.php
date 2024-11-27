<?php

namespace App\Controller;

use App\Service\Animal\AnimalService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    private AnimalService $animalService;

    public function __construct(AnimalService $animalService)
    {
        $this->animalService = $animalService;
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $animalDTOs = $this->animalService->getAllAnimals();


        return $this->render('home/index.html.twig', [
            'animals' => $animalDTOs,
        ]);
    }
}
