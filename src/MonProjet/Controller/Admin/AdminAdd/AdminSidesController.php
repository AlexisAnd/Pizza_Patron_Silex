<?php

namespace MonProjet\Controller\Admin\AdminAdd;

use Silex\Application;

use MonProjet\Infrastructure\UserSession;

use Symfony\Component\HttpFoundation\Request;

use MonProjet\Model\AdminModel;

class AdminSidesController
{
    public function adminSidesPage(Application $app, request $request)
    {
        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $useradmin = $userSession->isAdmin();
        if ($userconnect == true && $useradmin == true) {

            $username = $userSession->getFirstName();
            $userprivilege = $userSession->getPrivilege();

            return $app['twig']->render
            (
                'adminsides.html.twig', ['userconnect' => $userconnect, 'useradmin' => $useradmin, 'username' => $username, 'userprivilege'=>$userprivilege]
            );
        }
        else if ($userconnect == true && $useradmin == false) {

            $username = $userSession->getFirstName();

            return $app['twig']->render
            (

                'login.html.twig', ['userconnect' => $userconnect, 'username' => $username, 'useradmin'=>$useradmin]
            );
        }
        else {
            return $app['twig']->render
            (

                'login.html.twig',  ['userconnect' => $userconnect]
            );
        }

    }

    public function addProduct(Application $app, request $request) {

        $name = $request->request->get('Name');
        $saleprice = $request->request->get('SalePrice');

        $adminmodel = new AdminModel;
        $adminsides = $adminmodel->addSides($name, $saleprice);

        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $username = $userSession->getFirstName();
        $useradmin = $userSession->isAdmin();
        $userprivilege = $userSession->getPrivilege();

        return $app['twig']->render
        (
            'adminsides.html.twig', ['adminsides' => $adminsides, 'userconnect'=>$userconnect,
                'username'=>$username, 'useradmin' => $useradmin, 'userprivilege'=>$userprivilege]
        );
    }
}