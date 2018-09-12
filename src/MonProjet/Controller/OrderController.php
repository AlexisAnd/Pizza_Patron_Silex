<?php


namespace MonProjet\Controller;

use Silex\Application;

use Symfony\Component\HttpFoundation\Request;
use MonProjet\Infrastructure\UserSession;
use MonProjet\Model\OrderModel;

class OrderController
{

    public function orderGet(Application $app)
    {

        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        if ($userconnect == true) {
            $userid = $userSession->userId();
            $ordermodel = new OrderModel;
            $order = $ordermodel->order($userid);
            $orderline = $ordermodel->getList($order);
            $ordertotal = $ordermodel->getTotal($order);

            return $app['twig']->render
            (
                'basket.html.twig', ['userconnect' => $userconnect, 'orderline' => $orderline, 'ordertotal' => $ordertotal]
            );
        }

    }


    public function order(Application $app, request $request)
    {

        $userSession = new UserSession;

        $userconnect = $userSession->isConnected();
        if ($userconnect == true) {
            $userid = $userSession->userId();

            $name = $request->request->get('name');
            $meal = $request->request->get('id');
            $quantity = $request->request->get('quantity');
            $price = $request->request->get('price');
            $paninis = $request->request->get('paninis');
            $sides = $request->request->get('side');
            $desserts = $request->request->get('dessert');
            $drinks = $request->request->get('drink');

            $ordermodel = new OrderModel;
            $order = $ordermodel->order($userid);
            $ordermodel->getOrderList($order, $name, $meal, $paninis, $sides, $desserts, $drinks, $quantity, $price, $userid);
            $orderline = $ordermodel->getList($order);
            $ordertotal = $ordermodel->getTotal($order);


            return $app['twig']->render
            (
                'basket.html.twig', ['orderline' => $orderline, 'ordertotal' => $ordertotal]
            );

            }
    }
    public function cartTotal(Application $app)
    {
        $userSession = new UserSession;
        $userid = $userSession->userId();

        $ordermodel = new OrderModel;
        $order = $ordermodel->order($userid);
        $ordertotal = $ordermodel->getTotal($order);

        return $app['twig']->render
        (
            'cart.html.twig', ['ordertotal' => $ordertotal]
        );


    }
}
