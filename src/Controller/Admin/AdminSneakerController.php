<?php

namespace App\Controller\Admin;

use App\Entity\Sneaker;
use App\Entity\SneakersImages;
use App\Form\SneakerType;
use App\Repository\SneakerRepository;
use App\Repository\SneakersImagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin//sneaker')]
class AdminSneakerController extends AbstractController
{
    #[Route('/', name: 'admin.sneaker.index', methods: ['GET'])]
    public function index(SneakerRepository $sneakerRepository): Response
    {
        return $this->render('admin/sneaker/index.html.twig', [
            'sneakers' => $sneakerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin.sneaker.new', methods: ['GET', 'POST'])]
    public function new(Request $request, SneakerRepository $sneakerRepository): Response
    {
        $sneaker = new Sneaker();
        $form = $this->createForm(SneakerType::class, $sneaker);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $files = $form->get('images')->getData();

            foreach ($files as $file) {
                $sneakerImage = new SneakersImages();
                $sneakerImage->setImageFile($file);
                $sneaker->addImage($sneakerImage);
            }


            $sneaker->setArticleNumber("ddddbhkkj");
            $sneakerRepository->save($sneaker, true);
            return $this->redirectToRoute('admin.sneaker.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/sneaker/new.html.twig', [
            'sneaker' => $sneaker,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin.sneaker.show', methods: ['GET'])]
    public function show(Sneaker $sneaker): Response
    {
        return $this->render('admin/sneaker/show.html.twig', [
            'sneaker' => $sneaker,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin.sneaker.edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Sneaker $sneaker, SneakerRepository $sneakerRepository): Response
    {
        $form = $this->createForm(SneakerType::class, $sneaker);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sneakerRepository->save($sneaker, true);

            return $this->redirectToRoute('admin.sneaker.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/sneaker/edit.html.twig', [
            'sneaker' => $sneaker,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin.sneaker.delete', methods: ['POST'])]
    public function delete(Request $request, Sneaker $sneaker, SneakerRepository $sneakerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sneaker->getId(), $request->request->get('_token'))) {
            $sneakerRepository->remove($sneaker, true);
        }

        return $this->redirectToRoute('admin.sneaker.index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}', name: 'admin.sneaker.deleteImage', methods: ['DELETE'])]
    public function deleteImage(Request $request,SneakersImages $sneakersImages, SneakersImagesRepository $sneakersImagesRepository):JsonResponse
    {

        $data= json_decode($request->getContent(),true);

        if($this->isCsrfTokenValid('delete'.$sneakersImages->getId(), $data['_token'])){
            $sneakersImagesRepository->remove($sneakersImages,true);

            return new JsonResponse(['success'=>true],200);
        }

        return new JsonResponse(['error'=>'Token invalide'],400);
    }
}
