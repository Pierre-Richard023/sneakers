<?php

namespace App\Controller;

use App\Entity\Sneaker;
use App\Repository\SneakerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{

    public function __construct(private SneakerRepository $sneakerRepository)
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
    public function add(SessionInterface $session, Request $request)
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
            'message' => "Oh non ! Une erreur s'est produite lors de l'ajout de l'article. Veuillez nous contacter si le problème persiste."
        ]);

    }

    #[Route('/panier/delete', name: 'cart.delete')]
    public function delete(SessionInterface $session , Request $request)
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

                $session->set('cart', $cart);

                return new JsonResponse([
                    'success' => true,
                    'message' => 'Votre article a été supprimer avec succès de votre panier.'
                ]);
            }
        }


        return new JsonResponse([
            'success' => false,
            'message' => "Oh non ! Une erreur s'est produite lors de la suppression de l'article. Veuillez nous contacter si le problème persiste."
        ]);
    }

    #[Route('/panier/clear', name: 'cart.clear')]
    public function clear(SessionInterface $session)
    {
        $session->remove('cart');

        return $this->redirectToRoute('cart');
    }

}
