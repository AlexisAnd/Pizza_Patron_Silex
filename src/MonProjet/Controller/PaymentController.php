<?php


namespace MonProjet\Controller;

use Silex\Application;

use MonProjet\Infrastructure\UserSession;
use MonProjet\Model\RegisterModel;
use MonProjet\Model\OrderModel;

class PaymentController
{

    public function paymentPage(Application $app)
    {
        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $useradmin = $userSession->isAdmin();
        $username = $userSession->getFirstName();
        $userprivilege = $userSession->getPrivilege();

        $userSession = new UserSession;
        $userid = $userSession->userId();

        $ordermodel = new OrderModel;
        $order = $ordermodel->order($userid);
        $orderline = $ordermodel->getList($order);
        $ordertotal = $ordermodel->getTotal($order);

        $registermodel = new RegisterModel;
        $custinfos = $registermodel->getCustInfos($userid);
        
        return $app['twig']->render
        (
            'payment.html.twig', ['userconnect' => $userconnect, 'useradmin' => $useradmin, 'username' => $username,
                'userprivilege' => $userprivilege, 'orderline' => $orderline, 'ordertotal' => $ordertotal, 'custinfos'=>$custinfos]
        );
       
    }
}