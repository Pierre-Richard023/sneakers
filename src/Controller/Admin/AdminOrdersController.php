<?php

namespace App\Controller\Admin;

use App\Entity\Orders;
use App\Form\OrdersType;
use App\Repository\OrdersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/orders')]
class AdminOrdersController extends AbstractController
{
    #[Route('/', name: 'admin.orders.index', methods: ['GET'])]
    public function index(OrdersRepository $ordersRepository): Response
    {
        return $this->render('admin/orders/index.html.twig', [
            'orders' => $ordersRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin.orders.new', methods: ['GET', 'POST'])]
    public function new(Request $request, OrdersRepository $ordersRepository): Response
    {
        $order = new Orders();
        $form = $this->createForm(OrdersType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ordersRepository->save($order, true);

            return $this->redirectToRoute('admin.orders.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/orders/new.html.twig', [
            'order' => $order,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin.orders.show', methods: ['GET'])]
    public function show(Orders $order): Response
    {
        return $this->render('admin/orders/show.html.twig', [
            'order' => $order,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin.orders.edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Orders $order, OrdersRepository $ordersRepository): Response
    {
        $form = $this->createForm(OrdersType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ordersRepository->save($order, true);

            return $this->redirectToRoute('admin.orders.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/orders/edit.html.twig', [
            'order' => $order,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin.orders.delete', methods: ['POST'])]
    public function delete(Request $request, Orders $order, OrdersRepository $ordersRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$order->getId(), $request->request->get('_token'))) {
            $ordersRepository->remove($order, true);
        }

        return $this->redirectToRoute('admin.orders.index', [], Response::HTTP_SEE_OTHER);
    }
}
