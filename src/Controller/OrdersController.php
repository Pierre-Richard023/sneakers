<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\Orders;
use App\Form\AddressType;
use App\Form\OrdersType;
use App\Repository\AddressRepository;
use App\Repository\ShippingRepository;
use App\Repository\UserRepository;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class OrdersController extends AbstractController
{

    public function __construct(private AddressRepository $addressRepository)
    {
        Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);
    }

    #[Route('/commandes', name: 'order')]
    public function index(Request $request): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(OrdersType::class, null,[
            'user' => $user,
        ]);
        $form->handleRequest($request);


        return $this->render('orders/index.html.twig', [
            'controller_name' => 'OrdersController',
        ]);
    }

    #[Route('/commandes/paymentKey', name: 'order.paymentKey')]
    public function getKeyPaymentIntent(Request $request): JsonResponse
    {


        if ($request->getContent()) {
            $data = json_decode($request->getContent(), true);
            $price = $data['price'];


            $paymentIntent = PaymentIntent::create([
                'amount' => $price * 100,
                'currency' => 'EUR',
                'payment_method_types' => ['card']
            ]);

            return new JsonResponse([
                'success' => true,
                'clientSecret' => $paymentIntent->client_secret
            ]);
        }


        return new JsonResponse([
            'success' => false,
            'clientSecret' => 'ERROR'
        ]);

    }


    #[Route('/commandes/valider', name: 'order.valid')]
    public function validOrder (Request $request)
    {

        dd($request);
    }
}
