<?php

namespace App\Controller;

use App\Repository\SneakerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    public function __construct(private SneakerRepository $sneakerRepository){

    }

    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $sneakers=$this->sneakerRepository->getSneakers();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'sneakers'=>$sneakers
        ]);
    }
}
