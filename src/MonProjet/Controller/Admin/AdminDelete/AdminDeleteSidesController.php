<?php
/**
 * Created by PhpStorm.
 * User: Alexis
 * Date: 06/06/2017
 * Time: 22:07
 */


namespace MonProjet\Controller\Admin\AdminDelete;

use Silex\Application;

use MonProjet\Infrastructure\UserSession;

use Symfony\Component\HttpFoundation\Request;

use MonProjet\Model\AdminModel;

use MonProjet\Model\MenuModel;

class AdminDeleteSidesController
{
    public function adminDeleteSidesPage(application $app)
    {

        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $useradmin = $userSession->isAdmin();
        if ($userconnect == true && $useradmin == true) {

            $menumodel = new MenuModel();
            $sides = $menumodel -> getSides();

            $username = $userSession->getFirstName();
            $userprivilege = $userSession->getPrivilege();

            return $app['twig']->render
            (
                'admindeletesides.html.twig', ['sides'=>$sides, 'userconnect' => $userconnect, 'useradmin' => $useradmin, 'username' => $username, 'userprivilege'=>$userprivilege]
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

    public function deleteProduct(Application $app, request $request) {


        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $useradmin = $userSession->isAdmin();
        $username = $userSession->getFirstName();
        $userprivilege = $userSession->getPrivilege();

        $id = $request->request->get('SideId');

        $adminmodel= new AdminModel;
        $admindelete = $adminmodel->deleteSide($id);

        $menumodel = new MenuModel();
        $sides = $menumodel -> getSides();

        return $app['twig']->render
        (
            'admindeletesides.html.twig', ['userconnect'=>$userconnect, 'userprivilege'=>$userprivilege,
                'username'=>$username, 'useradmin' => $useradmin, 'admindelete'=>$admindelete, 'sides'=>$sides]
        );
    }
}