<?php

namespace App\Controller\Admin;

use App\Entity\Brands;
use App\Form\BrandsType;
use App\Repository\BrandsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/brands')]
class AdminBrandsController extends AbstractController
{
    #[Route('/', name: 'admin.brands.index', methods: ['GET'])]
    public function index(BrandsRepository $brandsRepository): Response
    {
        return $this->render('admin/brands/index.html.twig', [
            'brands' => $brandsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin.brands.new', methods: ['GET', 'POST'])]
    public function new(Request $request, BrandsRepository $brandsRepository): Response
    {
        $brand = new Brands();
        $form = $this->createForm(BrandsType::class, $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $brandsRepository->save($brand, true);

            return $this->redirectToRoute('admin.brands.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/brands/new.html.twig', [
            'brand' => $brand,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin.brands.show', methods: ['GET'])]
    public function show(Brands $brand): Response
    {
        return $this->render('admin/brands/show.html.twig', [
            'brand' => $brand,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin.brands.edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Brands $brand, BrandsRepository $brandsRepository): Response
    {
        $form = $this->createForm(BrandsType::class, $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $brandsRepository->save($brand, true);

            return $this->redirectToRoute('admin.brands.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/brands/edit.html.twig', [
            'brand' => $brand,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin.brands.delete', methods: ['POST'])]
    public function delete(Request $request, Brands $brand, BrandsRepository $brandsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$brand->getId(), $request->request->get('_token'))) {
            $brandsRepository->remove($brand, true);
        }

        return $this->redirectToRoute('admin.brands.index', [], Response::HTTP_SEE_OTHER);
    }
}
