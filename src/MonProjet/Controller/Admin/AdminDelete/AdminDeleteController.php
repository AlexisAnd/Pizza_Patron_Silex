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

class AdminDeleteController
{
    public function adminDeletePage(application $app)
    {

        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $useradmin = $userSession->isAdmin();
        if ($userconnect == true && $useradmin == true) {

            $menumodel = new MenuModel();
            $pizzas = $menumodel -> getPizzas();

            $username = $userSession->getFirstName();
            $userprivilege = $userSession->getPrivilege();

            return $app['twig']->render
            (
                'admindelete.html.twig', ['pizzas'=>$pizzas, 'userconnect' => $userconnect, 'useradmin' => $useradmin, 'username' => $username, 'userprivilege'=>$userprivilege]
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

        $menumodel = new MenuModel();
        $pizzas = $menumodel -> getPizzas();

        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
            $useradmin = $userSession->isAdmin();
            $username = $userSession->getFirstName();
        $userprivilege = $userSession->getPrivilege();

        $id = $request->request->get('MealId');

        $adminmodel= new AdminModel;
        $admindelete = $adminmodel->deletePizza($id);

        $menumodel = new MenuModel();
        $pizzas = $menumodel -> getPizzas();

        return $app['twig']->render
        (
            'admindelete.html.twig', ['userconnect'=>$userconnect,
                'username'=>$username, 'useradmin' => $useradmin, 'userprivilege'=>$userprivilege, 'admindelete'=>$admindelete, 'pizzas'=>$pizzas]
        );
    }
}