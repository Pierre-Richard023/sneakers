<?php

namespace App\Controller;

use App\Entity\Brands;
use App\Entity\Models;
use App\Repository\BrandsRepository;
use App\Repository\SneakerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('collections',name:'collections.')]
class CollectionsController extends AbstractController
{

    public function __construct(private SneakerRepository $sneakerRepository,private BrandsRepository $brandsRepository)
    {}

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        $sneakers=$this->sneakerRepository->getSneakers();
        $brands= $this->brandsRepository->findAll();

        return $this->render('collections/index.html.twig', [
            'controller_name' => 'CollectionsController',
            'sneakers'=>$sneakers,
            'brands'=>$brands
        ]);
    }

    #[Route('/{slug}', name: 'brands')]
    public function brands(Brands $brands): Response
    {
        $sneakers=[];
        return $this->render('collections/index.html.twig', [
            'controller_name' => 'CollectionsController',
            'sneakers'=>$sneakers,
        ]);
    }

    #[Route('/{slug}', name: 'models')]
    public function models(Models $models): Response
    {
        $sneakers=[];
        return $this->render('collections/index.html.twig', [
            'controller_name' => 'CollectionsController',
            'sneakers'=>$sneakers,
        ]);
    }

}
