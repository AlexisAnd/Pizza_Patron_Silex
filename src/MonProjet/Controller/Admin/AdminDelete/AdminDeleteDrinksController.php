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

class AdminDeleteDrinksController
{
    public function adminDeleteDrinksPage(application $app)
    {

        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $useradmin = $userSession->isAdmin();
        if ($userconnect == true && $useradmin == true) {

            $menumodel = new MenuModel();
            $drinks = $menumodel -> getDrinks();

            $username = $userSession->getFirstName();
            $userprivilege = $userSession->getPrivilege();

            return $app['twig']->render
            (
                'admindeletedrinks.html.twig', ['drinks'=>$drinks, 'userconnect' => $userconnect, 'useradmin' => $useradmin, 'username' => $username, 'userprivilege'=>$userprivilege]
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

        $id = $request->request->get('DrinksId');

        $adminmodel= new AdminModel;
        $admindelete = $adminmodel->deleteDrink($id);

        $menumodel = new MenuModel();
        $drinks = $menumodel -> getDrinks();

        return $app['twig']->render
        (
            'admindeletedrinks.html.twig', ['userconnect'=>$userconnect,'userprivilege'=>$userprivilege,
                'username'=>$username, 'useradmin' => $useradmin, 'admindelete'=>$admindelete, 'drinks'=>$drinks]
        );
    }
}