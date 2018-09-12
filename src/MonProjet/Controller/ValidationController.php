<?php

namespace MonProjet\Controller;

use Silex\Application;
use MonProjet\Infrastructure\UserSession;
use MonProjet\Model\OrderModel;

class ValidationController
{

    function validationPage(application $app)
    {

        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();

        $useradmin = $userSession->isAdmin();
        $username = $userSession->getFirstName();
        $userprivilege = $userSession->getPrivilege();

        $userSession = new UserSession;
        $userid = $userSession->userId();
        $useraddress = $userSession->userAddress();
        $usercity = $userSession->userCity();
        $userpostalcode = $userSession->userPostalCode();
        $userphone = $userSession->userPhone();

        $ordermodel = new OrderModel;
        $order = $ordermodel->order($userid);
        $total = $ordermodel->getTotal($order);
        $ordermodel->completeOrder($total, $useraddress, $usercity, $userpostalcode, $userphone, $order);
        
        var_dump($useraddress);
        var_dump($usercity);
        var_dump($userpostalcode);
        var_dump($userphone);

        return $app['twig']->render
        (
            'validation.html.twig', ['userconnect' => $userconnect, 'useradmin' => $useradmin, 'username' => $username,
                'userprivilege' => $userprivilege]
        );
    }
}