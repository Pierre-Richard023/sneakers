<?php

namespace App\Controller\Admin;

use App\Entity\Models;
use App\Form\ModelsType;
use App\Repository\ModelsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('admin/models')]
#[IsGranted('ROLE_ADMIN')]
class AdminModelsController extends AbstractController
{

    public function __construct(private SluggerInterface $slugger){}

    #[Route('/', name: 'admin.models.index', methods: ['GET'])]
    public function index(ModelsRepository $modelsRepository): Response
    {
        return $this->render('admin/models/index.html.twig', [
            'models' => $modelsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin.models.new', methods: ['GET', 'POST'])]
    public function new(Request $request, ModelsRepository $modelsRepository): Response
    {
        $model = new Models();
        $form = $this->createForm(ModelsType::class, $model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $name=$model->getName();
            $model->setSlug($this->slugger->slug($name));
            $modelsRepository->save($model, true);

            return $this->redirectToRoute('admin.models.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/models/new.html.twig', [
            'model' => $model,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin.models.show', methods: ['GET'])]
    public function show(Models $model): Response
    {
        return $this->render('admin/models/show.html.twig', [
            'model' => $model,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin.models.edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Models $model, ModelsRepository $modelsRepository): Response
    {
        $form = $this->createForm(ModelsType::class, $model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $modelsRepository->save($model, true);

            return $this->redirectToRoute('admin.models.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/models/edit.html.twig', [
            'model' => $model,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin.models.delete', methods: ['POST'])]
    public function delete(Request $request, Models $model, ModelsRepository $modelsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$model->getId(), $request->request->get('_token'))) {
            $modelsRepository->remove($model, true);
        }

        return $this->redirectToRoute('admin.models.index', [], Response::HTTP_SEE_OTHER);
    }
}
