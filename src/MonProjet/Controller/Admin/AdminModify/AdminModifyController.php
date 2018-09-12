<?php
/**
 * Created by PhpStorm.
 * User: Alexis
 * Date: 06/06/2017
 * Time: 22:07
 */


namespace MonProjet\Controller\Admin\AdminModify;

use Silex\Application;

use MonProjet\Infrastructure\UserSession;

use Symfony\Component\HttpFoundation\Request;

use MonProjet\Model\AdminModel;

use MonProjet\Model\MenuModel;

class AdminModifyController
{
    public function adminModifyPage(application $app)
    {
        $menumodel = new MenuModel();
        $pizzas = $menumodel->getPizzas();

        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $useradmin = $userSession->isAdmin();
        if ($userconnect == true && $useradmin == true) {

            $username = $userSession->getFirstName();
            $userprivilege = $userSession->getPrivilege();

            return $app['twig']->render
            (
                'adminmodify.html.twig', ['pizzas'=>$pizzas, 'userconnect' => $userconnect, 'useradmin' => $useradmin,
                    'username' => $username, 'userprivilege' => $userprivilege]
            );
        } else if ($userconnect == true && $useradmin == false) {

            $username = $userSession->getFirstName();

            return $app['twig']->render
            (

                'login.html.twig', ['userconnect' => $userconnect, 'username' => $username, 'useradmin' => $useradmin]
            );
        } else {
            return $app['twig']->render
            (

                'login.html.twig', ['userconnect' => $userconnect]
            );
        }

    }

    public function adminModifyPageP(application $app)
    {
        $menumodel = new MenuModel();
        $paninis = $menumodel->getPaninis();

        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $useradmin = $userSession->isAdmin();
        if ($userconnect == true && $useradmin == true) {

            $username = $userSession->getFirstName();
            $userprivilege = $userSession->getPrivilege();

            return $app['twig']->render
            (
                'adminmodifypaninis.html.twig', ['paninis'=>$paninis, 'userconnect' => $userconnect, 'useradmin' => $useradmin,
                    'username' => $username, 'userprivilege' => $userprivilege]
            );
        } else if ($userconnect == true && $useradmin == false) {

            $username = $userSession->getFirstName();

            return $app['twig']->render
            (

                'login.html.twig', ['userconnect' => $userconnect, 'username' => $username, 'useradmin' => $useradmin]
            );
        } else {
            return $app['twig']->render
            (

                'login.html.twig', ['userconnect' => $userconnect]
            );
        }

    }
    public function adminModifyPageS(application $app)
    {
        $menumodel = new MenuModel();
        $sides = $menumodel->getSides();

        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $useradmin = $userSession->isAdmin();
        if ($userconnect == true && $useradmin == true) {

            $username = $userSession->getFirstName();
            $userprivilege = $userSession->getPrivilege();

            return $app['twig']->render
            (
                'adminmodifysides.html.twig', ['sides' => $sides, 'userconnect' => $userconnect, 'useradmin' => $useradmin,
                    'username' => $username, 'userprivilege' => $userprivilege]
            );
        } else if ($userconnect == true && $useradmin == false) {

            $username = $userSession->getFirstName();

            return $app['twig']->render
            (

                'login.html.twig', ['userconnect' => $userconnect, 'username' => $username, 'useradmin' => $useradmin]
            );
        } else {
            return $app['twig']->render
            (

                'login.html.twig', ['userconnect' => $userconnect]
            );
        }
    }
        public function adminModifyPageDs(application $app)
    {
        $menumodel = new MenuModel();
        $desserts = $menumodel->getDesserts();

        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $useradmin = $userSession->isAdmin();
        if ($userconnect == true && $useradmin == true) {

            $username = $userSession->getFirstName();
            $userprivilege = $userSession->getPrivilege();

            return $app['twig']->render
            (
                'adminmodifydesserts.html.twig', ['desserts'=>$desserts, 'userconnect' => $userconnect, 'useradmin' => $useradmin,
                    'username' => $username, 'userprivilege' => $userprivilege]
            );
        } else if ($userconnect == true && $useradmin == false) {

            $username = $userSession->getFirstName();

            return $app['twig']->render
            (

                'login.html.twig', ['userconnect' => $userconnect, 'username' => $username, 'useradmin' => $useradmin]
            );
        } else {
            return $app['twig']->render
            (

                'login.html.twig', ['userconnect' => $userconnect]
            );
        }

    }
    public function adminModifyPageDk(application $app)
    {
        $menumodel = new MenuModel();
        $drinks = $menumodel->getDrinks();

        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $useradmin = $userSession->isAdmin();
        if ($userconnect == true && $useradmin == true) {

            $username = $userSession->getFirstName();
            $userprivilege = $userSession->getPrivilege();

            return $app['twig']->render
            (
                'adminmodifydrinks.html.twig', ['drinks'=>$drinks, 'userconnect' => $userconnect, 'useradmin' => $useradmin,
                    'username' => $username, 'userprivilege' => $userprivilege]
            );
        } else if ($userconnect == true && $useradmin == false) {

            $username = $userSession->getFirstName();

            return $app['twig']->render
            (

                'login.html.twig', ['userconnect' => $userconnect, 'username' => $username, 'useradmin' => $useradmin]
            );
        } else {
            return $app['twig']->render
            (

                'login.html.twig', ['userconnect' => $userconnect]
            );
        }

    }
}
