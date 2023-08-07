<?php

namespace App\Controller;

use App\Entity\Favorites;
use App\Form\FavoritesType;
use App\Repository\FavoritesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/favorites')]
#[IsGranted('ROLE_USER')]
class FavoritesController extends AbstractController
{
    #[Route('/liste-de-souhaits', name: 'favorites', methods: ['GET'])]
    public function index(FavoritesRepository $favoritesRepository): Response
    {
        return $this->render('favorites/index.html.twig', [
            'favorites' => $favoritesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_favorites_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FavoritesRepository $favoritesRepository): Response
    {
        $favorite = new Favorites();
        $form = $this->createForm(FavoritesType::class, $favorite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $favoritesRepository->save($favorite, true);

            return $this->redirectToRoute('app_favorites_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('favorites/new.html.twig', [
            'favorite' => $favorite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_favorites_show', methods: ['GET'])]
    public function show(Favorites $favorite): Response
    {
        return $this->render('favorites/show.html.twig', [
            'favorite' => $favorite,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_favorites_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Favorites $favorite, FavoritesRepository $favoritesRepository): Response
    {
        $form = $this->createForm(FavoritesType::class, $favorite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $favoritesRepository->save($favorite, true);

            return $this->redirectToRoute('app_favorites_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('favorites/edit.html.twig', [
            'favorite' => $favorite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_favorites_delete', methods: ['POST'])]
    public function delete(Request $request, Favorites $favorite, FavoritesRepository $favoritesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$favorite->getId(), $request->request->get('_token'))) {
            $favoritesRepository->remove($favorite, true);
        }

        return $this->redirectToRoute('app_favorites_index', [], Response::HTTP_SEE_OTHER);
    }
}
