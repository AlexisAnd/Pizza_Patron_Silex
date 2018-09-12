<?php

namespace MonProjet\Controller;

use Silex\Application;

use MonProjet\Infrastructure\UserSession;

use Symfony\Component\HttpFoundation\Request;

use MonProjet\Model\OrderModel;

class OrdersListController
{

    public function orderListPage(Application $app)
    {
        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $userid = $userSession->userId();

        if ($userconnect == true) {
            $useradmin = $userSession->isAdmin();
            $username = $userSession->getFirstName();
            $userprivilege = $userSession->getPrivilege();

            $ordermodel = new OrderModel;
            $order = $ordermodel->order($userid);
            $orderslist = $ordermodel->ordersList($userid);


            return $app['twig']->render
            (
                'orderslist.html.twig', ['userconnect' => $userconnect, 'useradmin' => $useradmin,
                    'username' => $username, 'userprivilege' => $userprivilege, 'orderslist'=>$orderslist]
            );
        } 
        else {
            exit();
        }
    }

    public function showOrderDetails(Application $app, $OrderId)
    {

        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $userid = $userSession->userId();

        if ($userconnect == true) {
            $useradmin = $userSession->isAdmin();
            $username = $userSession->getFirstName();
            $userprivilege = $userSession->getPrivilege();

        $ordermodel = new OrderModel;
        $orderslistone = $ordermodel->ordersListOne($OrderId);
        $orderdetails = $ordermodel->orderDetails($OrderId);

        return $app['twig']->render
        ( 'orderdetails.html.twig', ['userconnect' => $userconnect, 'useradmin' => $useradmin,'username' => $username, 'userprivilege' => $userprivilege,'orderslistone'=>$orderslistone, 'orderdetails'=>$orderdetails]
        );
    }
        else {
            exit();
        }
}
}