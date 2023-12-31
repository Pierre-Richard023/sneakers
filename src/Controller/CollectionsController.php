<?php

namespace App\Controller;

use App\Entity\Brands;
use App\Entity\Models;
use App\Entity\SneakerFilter;
use App\Form\SneakerFilterType;
use App\Repository\BrandsRepository;
use App\Repository\SneakerRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('collections',name:'collections.')]
class CollectionsController extends AbstractController
{

    public function __construct(private SneakerRepository $sneakerRepository,private BrandsRepository $brandsRepository)
    {}

    #[Route('/', name: 'index')]
    public function index(Request $request,PaginatorInterface $paginator ): Response
    {

        $filter=new SneakerFilter();
        $form=$this->createForm(SneakerFilterType::class,$filter);
        $form->handleRequest($request);


        $sneakers=$paginator->paginate(
            $this->sneakerRepository->getSneakersByFilterAndPages($filter),
            $request->query->getInt('page',1),
            12
        );
        $brands= $this->brandsRepository->findAll();


        if ($form->isSubmitted() && $form->isValid()) {
            return $this->render('collections/index.html.twig', [
                'controller_name' => 'CollectionsController',
                'sneakers'=>$sneakers,
                'brands'=>$brands,
                'filter'=>$form
            ]);
        }


        return $this->render('collections/index.html.twig', [
            'controller_name' => 'CollectionsController',
            'sneakers'=>$sneakers,
            'brands'=>$brands,
            'filter'=>$form
        ]);
    }


}
