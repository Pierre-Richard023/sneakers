<?php

namespace App\Controller;

use App\Entity\Sneaker;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SneakersController extends AbstractController
{
    #[Route('/collection', name: 'sneaker.collection')]
    public function index(): Response
    {
        return $this->render('sneakers/index.html.twig', [
            'controller_name' => 'SneakersController',
        ]);
    }

    #[Route('collections/sneakers/{slug}', name: 'sneaker.show', methods: ['GET'])]
    public function show(Sneaker $sneaker): Response
    {
        return $this->render('sneakers/show.html.twig', [
            'sneaker' => $sneaker,
        ]);
    }
}
