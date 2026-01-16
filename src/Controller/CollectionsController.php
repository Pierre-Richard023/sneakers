<?php

namespace App\Controller;

use App\Repository\BrandsRepository;
use App\Repository\SneakerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/collections', name: 'collections.')]
class CollectionsController extends AbstractController
{

    public function __construct(private  readonly SneakerRepository $sneakerRepository, private readonly BrandsRepository $brandsRepository,private readonly EntityManagerInterface $entityManager)
    {
    }

    #[Route('/', name: 'index')]
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        return $this->render('collections/index.html.twig', [
            'controller_name' => 'CollectionsController',
        ]);
    }

    #[Route('/add-favorites', name: 'add', methods: ['POST'] )]
    public function addFavorites(Request $request): JsonResponse
    {
        $user = $this->getUser();
        if (!$user)
            return new JsonResponse(
                [
                    'status' => 'error',
                    'message' => 'Aucun utilisateur connecté.'
                ],
                401
            );


        $data = json_decode($request->getContent(), true);
        $sneakerId = $data['sneakerId'] ?? null;

        if (!$sneakerId)
            return new JsonResponse(
                [
                    'status' => 'error',
                    'message' => 'Aucun ID de sneaker n\'a été fourni.'
                ],
                400
            );


        $sneaker = $this->sneakerRepository->find($sneakerId);
        if (!$sneaker)
            return new JsonResponse(
                [
                    'status' => 'error',
                    'message' => 'Sneaker n\'a pas été trouvé.'
                ],
                404
            );


        if ($user->getFavorites()->contains($sneaker))
            return new JsonResponse(
                [
                    'status' => 'error',
                    'message' => 'Les Sneakers sont déjà dans vos favoris.'
                ],
                400
            );


        $user->getFavorites()->addSneaker($sneaker);


        try {
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            return new JsonResponse(
                [
                    'status' => 'success',
                    'message' => 'Les Sneakers ont été ajouté aux favoris avec succès.'
                ],
                200
            );
        } catch (\Exception $e) {
            return new JsonResponse(
                [
                    'status' => 'error',
                    'message' => 'Une erreur est survenue lors de l\'ajout aux favoris.'
                ],
                500
            );
        }
    }

}
