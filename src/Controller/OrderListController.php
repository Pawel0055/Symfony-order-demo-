<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Order;
use App\Repository\OrderRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class OrderListController extends AbstractController
{
    /**
     * @Route("/", name="order_list")
     */
    public function index(OrderRepository $orderRepository): Response
    {
        $order = $orderRepository->findAll();
        var_dump($order);
        $entityManager = $this->getDoctrine()->getManager();

        $temp = $this->getDoctrine()
            ->getRepository(Order::class)
            ->orderIngredientsList();
            var_dump($temp);
        $product = $entityManager->getRepository(Order::class)->findAll();
        //var_dump($product);
        return $this->render('order_list/index.html.twig', [
            'order_list' => $order,
            'ingredients_list' => $temp,
        ]);
    }

    /**
    * @Route("/ajax", name="ajax")
    */
    public function example(Request $request, OrderRepository $orderRepository)
    {
        $id = $_POST['id'];
        $categorias = $orderRepository->IngredientsList($id);
        return new Response(json_encode($categorias), 200);
     }
}
