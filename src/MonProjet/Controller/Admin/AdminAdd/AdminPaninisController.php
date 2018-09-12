<?php

namespace MonProjet\Controller\Admin\AdminAdd;

use Silex\Application;

use MonProjet\Infrastructure\UserSession;

use Symfony\Component\HttpFoundation\Request;

use MonProjet\Model\AdminModel;

class AdminPaninisController
{
    public function adminPaninisPage(application $app)
    {

        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $useradmin = $userSession->isAdmin();
        if ($userconnect == true && $useradmin == true) {

            $username = $userSession->getFirstName();
            $userprivilege = $userSession->getPrivilege();

            return $app['twig']->render
            (
                'adminpaninis.html.twig', ['userconnect' => $userconnect, 'useradmin' => $useradmin, 'username' => $username, 'userprivilege'=>$userprivilege]
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

    $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $username = $userSession->getFirstName();
        $userprivilege = $userSession->getPrivilege();
        $useradmin = $userSession->isAdmin();
        if ($useradmin == false) {

            return $app['twig']->render
            (
                'login.html.twig', ['userconnect' => $userconnect]
            );
        } else {
            return $app['twig']->render
            (
                'adminpaninis.html.twig', ['userconnect' => $userconnect, 'useradmin' => $useradmin, 'username' => $username, 'userprivilege'=>$userprivilege]
            );
        }
    }
    public function addProduct(Application $app, request $request) {

        $name = $request->request->get('Name');
        $description = $request->request->get('Description');
        $saleprice = $request->request->get('SalePrice');

        $adminmodel = new AdminModel;
        $adminpaninis = $adminmodel->addPaninis($name, $description, $saleprice);

        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $username = $userSession->getFirstName();
        $userprivilege = $userSession->getPrivilege();
        $useradmin = $userSession->isAdmin();

        return $app['twig']->render
        (
            'adminpaninis.html.twig', ['adminpaninis' => $adminpaninis, 'userconnect'=>$userconnect,
                'username'=>$username, 'useradmin' => $useradmin, 'userprivilege'=>$userprivilege]
        );
    }
}