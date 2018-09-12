<?php

namespace MonProjet\Controller;

use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use MonProjet\Model\OrderModel;

use MonProjet\Infrastructure\UserSession;

class DeleteController
{

    public function deleteLine(Application $app, request $request)
    {
        $id = $request->request->get('id');
        $quantity = $request->request->get('quantity');
        $userSession = new UserSession;
        $userid = $userSession->userId();

        $ordermodel = new OrderModel;
        $orderdelete = $ordermodel->eraseItem($id, $quantity);
        $order = $ordermodel->order($userid);
        $orderline = $ordermodel->getList($order);
        $ordertotal = $ordermodel->getTotal($order);

        return $app['twig']->render(

            'basket.html.twig', ['orderdelete'=>$orderdelete, 'orderline'=>$orderline, 'ordertotal'=>$ordertotal]
        );

    }


}