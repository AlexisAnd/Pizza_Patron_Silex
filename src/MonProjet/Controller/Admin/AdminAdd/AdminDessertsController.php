<?php

namespace MonProjet\Controller\Admin\AdminAdd;

use Silex\Application;

use MonProjet\Infrastructure\UserSession;

use Symfony\Component\HttpFoundation\Request;

use MonProjet\Model\AdminModel;

class AdminDessertsController
{
    public function adminDessertsPage(application $app)
    {

        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $useradmin = $userSession->isAdmin();
        if ($userconnect == true && $useradmin == true) {

            $username = $userSession->getFirstName();
            $userprivilege = $userSession->getPrivilege();

            return $app['twig']->render
            (
                'admindesserts.html.twig', ['userconnect' => $userconnect, 'useradmin' => $useradmin,
                    'username' => $username, 'userprivilege'=>$userprivilege]
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
        $admindesserts = $adminmodel->addDesserts($name, $saleprice);

        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $username = $userSession->getFirstName();
        $userprivilege = $userSession->getPrivilege();
        $useradmin = $userSession->isAdmin();

        return $app['twig']->render
        (
            'admindesserts.html.twig', ['admindesserts' => $admindesserts, 'userconnect'=>$userconnect,
                'username'=>$username, 'useradmin' => $useradmin, 'userprivilege'=>$userprivilege]
        );
    }
}