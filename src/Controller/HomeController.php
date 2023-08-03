<?php

namespace App\Controller;

use App\Repository\BrandsRepository;
use App\Repository\SneakerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    public function __construct(private SneakerRepository $sneakerRepository,private BrandsRepository $brandsRepository){

    }

    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $brands= $this->brandsRepository->findAll();
        $sneakers=$this->sneakerRepository->getSneakers();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'sneakers'=>$sneakers,
            'brands'=>$brands
        ]);
    }
}
