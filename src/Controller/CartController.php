<?php

namespace App\Controller;

use App\Entity\Sneaker;
use App\Repository\SneakerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

class CartController extends AbstractController
{

    public function __construct(private readonly SneakerRepository $sneakerRepository)
    {
    }

    #[Route('/panier', name: 'cart')]
    public function index(SessionInterface $session): Response
    {
        $cart = $session->get('cart', []);
        $sneakers = [];
        $total = 0;

        foreach ($cart as $key => $qty) {

            $sneaker = $this->sneakerRepository->find($key);

            $sneakers[] = [
                'sneaker' => $sneaker,
                'quantity' => $qty
            ];

            $total += $sneaker->getPrice() * $qty;
        }


        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
            'sneakers' => $sneakers,
            'total' => $total
        ]);
    }


    #[Route('/panier/add', name: 'cart.add')]
    public function add(SessionInterface $session, Request $request): JsonResponse
    {

        if ($request->getContent()) {

            $data = json_decode($request->getContent(), true);

            $sneaker = $this->sneakerRepository->find($data['id']);

            if ($sneaker) {
                $id = $sneaker->getId();
                $cart = $session->get('cart', []);

                if (empty($cart[$id]))
                    $cart[$id] = 1;
                else
                    $cart[$id]++;

                $session->set('cart', $cart);

                return new JsonResponse([
                    'success' => true,
                    'message' => 'Votre article a été ajouté avec succès à votre panier.'
                ]);

            }
        }


        return new JsonResponse([
            'success' => false,
            'message' => "Désolé, nous n'avons pas pu ajouter l'article à vos favoris pour le moment. Veuillez réessayer plus tard."
        ]);

    }

    #[Route('/panier/delete', name: 'cart.delete')]
    public function delete(SessionInterface $session, Request $request): JsonResponse
    {

        if ($request->getContent()) {

            $data = json_decode($request->getContent(), true);

            $sneaker = $this->sneakerRepository->find($data['id']);

            if ($sneaker) {


                $id = $sneaker->getId();
                $cart = $session->get('cart', []);

                if (!empty($cart[$id])) {
                    unset($cart[$id]);
                }

                $total = 0;

                foreach ($cart as $key => $qty) {
                    $sneaker = $this->sneakerRepository->find($key);
                    $total += $sneaker->getPrice() * $qty;
                }

                $session->set('cart', $cart);

                return new JsonResponse([
                    'success' => true,
                    'total' => $total,
                    'message' => "C'est fait ! L'article a été supprimé avec succès de votre panier."
                ]);
            }
        }


        return new JsonResponse([
            'success' => false,
            'message' => "Oops ! Nous n'avons pas pu supprimer l'article pour le moment. Veuillez réessayer plus tard."
        ]);
    }

    #[Route('/panier/clear', name: 'cart.clear')]
    public function clear(SessionInterface $session, Request $request): JsonResponse
    {
        if ($request->getContent()) {

            $data = json_decode($request->getContent(), true);

            if ($this->isCsrfTokenValid('clear', $data['token'])) {

                $session->remove('cart');

                return new JsonResponse([
                    'success' => true,
                    'total' => 0,
                    'message' => "Vide réussi ! Votre panier a été vidé avec succès."
                ]);

            }


        }
        return new JsonResponse([
            'success' => false,
            'message' => "Oops ! Nous n'avons pas pu vider votre panier pour le moment. Veuillez réessayer plus tard."
        ]);
    }

    #[Route('/panier/details', name: 'cart.get')]
    public function getSession(SessionInterface $session): JsonResponse
    {
        $cart = $session->get('cart', []);
        $total = 0;

        foreach ($cart as $key => $qty) {
            $sneaker = $this->sneakerRepository->find($key);
            $total += $sneaker->getPrice() * $qty;
        }

        return new JsonResponse([
            'total' => $total,
            'cart' => $cart
        ]);
    }
}
