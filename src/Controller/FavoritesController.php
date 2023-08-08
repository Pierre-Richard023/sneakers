<?php

namespace App\Controller;

use App\Entity\Favorites;
use App\Form\FavoritesType;
use App\Repository\FavoritesRepository;
use App\Repository\SneakerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/favorites')]
#[IsGranted('ROLE_USER')]
class FavoritesController extends AbstractController
{

    public function __construct(private FavoritesRepository $favoritesRepository, private SneakerRepository $sneakerRepository)
    {
    }


    #[Route('/liste-de-souhaits', name: 'favorites', methods: ['GET'])]
    public function index(): Response
    {

        $favorites = $this->favoritesRepository->getPersonalFavorites($this->getUser());

        return $this->render('favorites/index.html.twig', [
            'sneakers' => $favorites->getSneakers(),
        ]);
    }

    #[Route('/liste-de-souhaits/add', name: 'favorites.add')]
    public function add(Request $request): JsonResponse
    {


        if ($request->getContent()) {

            $data = json_decode($request->getContent(), true);

            $sneaker = $this->sneakerRepository->find($data['id']);

            if ($sneaker) {

                $favorites = $this->favoritesRepository->getPersonalFavorites($this->getUser());
                $favorites->addSneaker($sneaker);

                $this->favoritesRepository->save($favorites, true);

                return new JsonResponse([
                    'success' => true,
                    'message' => "Bravo ! L'article a été ajouté à votre liste de favoris."
                ]);

            }
        }


        return new JsonResponse([
            'success' => false,
            'message' => "Malheureusement, l'article n'a pas pu être ajouté à vos favoris. Si le problème persiste, veuillez nous contacter pour obtenir de l'aide."
        ]);

    }


    #[Route('/liste-de-souhaits/remove', name: 'favorites.remove')]
    public function remove(Request $request): JsonResponse
    {

        if ($request->getContent()) {

            $data = json_decode($request->getContent(), true);

            $sneaker = $this->sneakerRepository->find($data['id']);

            if ($sneaker) {

                $favorites = $this->favoritesRepository->getPersonalFavorites($this->getUser());
                $favorites->removeSneaker($sneaker);

                $this->favoritesRepository->save($favorites, true);

                return new JsonResponse([
                    'success' => true,
                    'message' => "Article retiré ! Vous avez supprimé l'article de votre liste de favoris."
                ]);

            }
        }


        return new JsonResponse([
            'success' => false,
            'message' => "Oops ! Nous n'avons pas pu supprimer l'article pour le moment. Veuillez réessayer plus tard."
        ]);
    }


    #[Route('/liste-de-souhaits/clear', name: 'favorites.clear')]
    public function clear(Request $request): JsonResponse
    {

        if ($request->getContent()) {

            $data = json_decode($request->getContent(), true);

            if ($this->isCsrfTokenValid('clear', $data['token'])) {

                $favorites = $this->favoritesRepository->getPersonalFavorites($this->getUser());
                $favorites->clearSneaker();
                $this->favoritesRepository->save($favorites, true);

                return new JsonResponse([
                    'success' => true,
                    'message' => "C'est fait ! Tous les articles ont été retirés de votre liste de favoris."
                ]);
            }

        }
        return new JsonResponse([
            'success' => false,
            'message' => "Erreur de vidage : nous rencontrons un problème technique. Veuillez réessayer ultérieurement."
        ]);
    }

}
