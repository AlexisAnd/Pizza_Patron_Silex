<?php
/**
 * Created by PhpStorm.
 * User: Alexis
 * Date: 06/06/2017
 * Time: 22:07
 */


namespace MonProjet\Controller\Admin\AdminModify\ModifyPizzas;

use Silex\Application;

use MonProjet\Infrastructure\UserSession;

use Symfony\Component\HttpFoundation\Request;

use MonProjet\Model\AdminModel;

use MonProjet\Model\MenuModel;

class AdminModifyPizzasController
{
    public function adminModifyPizzasPage(application $app, $MealId)
    {
        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $useradmin = $userSession->isAdmin();
        if ($userconnect == true && $useradmin == true) {


            $menumodel = new MenuModel();
            $pizzas = $menumodel->showPizzas($MealId);

            $username = $userSession->getFirstName();
            $userprivilege = $userSession->getPrivilege();

            return $app['twig']->render
            (
                'adminmodifypizzas.html.twig', ['pizzas'=>$pizzas, 'userconnect' => $userconnect, 'useradmin' => $useradmin,
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

    public function adminModifyPizzas(Application $app, request $request)
    {
        $menumodel = new MenuModel();
        $pizzas = $menumodel->getPizzas();

        $name = $request->request->get('Name');
        $description = $request->request->get('Description');
        $saleprice = $request->request->get('SalePrice');
        $salepricesenor = $request->request->get('SalePriceSenor');
        $salepricemega = $request->request->get('SalePriceMega');
        $id = $request->request->get('MealId');

        $adminmodel = new AdminModel;
        $adminmodifypizzas = $adminmodel->modifyPizza($name, $description, $saleprice, $salepricesenor, $salepricemega, $id);

        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $useradmin = $userSession->isAdmin();
        $username = $userSession->getFirstName();
        $userprivilege = $userSession->getPrivilege();

        return $app['twig']->render
        (
            'adminmodify.html.twig', ['adminmodifypizzas'=>$adminmodifypizzas, 'pizzas'=>$pizzas, 'userconnect' => $userconnect, 'useradmin' => $useradmin,
                'username' => $username, 'userprivilege' => $userprivilege]
        );
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function adminModifyPaninisPage(application $app, $PaninisId)
    {
        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $useradmin = $userSession->isAdmin();
        if ($userconnect == true && $useradmin == true) {

            $menumodel = new MenuModel();
            $paninis = $menumodel->showPaninis($PaninisId);

            $username = $userSession->getFirstName();
            $userprivilege = $userSession->getPrivilege();

            return $app['twig']->render
            (
                'modifypaninis.html.twig', ['paninis'=>$paninis, 'userconnect' => $userconnect, 'useradmin' => $useradmin,
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

    public function adminModifyPaninis(Application $app, request $request)
    {
        $menumodel = new MenuModel();
        $paninis = $menumodel->getPaninis();

        $name = $request->request->get('Name');
        $description = $request->request->get('Description');
        $saleprice = $request->request->get('SalePrice');
        $id = $request->request->get('PaninisId');

        $adminmodel = new AdminModel;
        $adminmodifypaninis = $adminmodel->modifyPanini($name, $description, $saleprice, $id);

        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $useradmin = $userSession->isAdmin();
        $username = $userSession->getFirstName();
        $userprivilege = $userSession->getPrivilege();

        return $app['twig']->render
        (
            'adminmodifypaninis.html.twig', ['adminmodifypaninis'=>$adminmodifypaninis, 'paninis'=>$paninis, 'userconnect' => $userconnect, 'useradmin' => $useradmin,
                'username' => $username, 'userprivilege' => $userprivilege]
        );
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function adminModifySidesPage(application $app, $SideId)
    {
        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $useradmin = $userSession->isAdmin();
        if ($userconnect == true && $useradmin == true) {

            $menumodel = new MenuModel();
            $sides = $menumodel->showSides($SideId);

            $username = $userSession->getFirstName();
            $userprivilege = $userSession->getPrivilege();

            return $app['twig']->render
            (
                'modifysides.html.twig', ['sides'=>$sides, 'userconnect' => $userconnect, 'useradmin' => $useradmin,
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

    public function adminModifySides(Application $app, request $request)
    {
        $menumodel = new MenuModel();
        $sides = $menumodel->getSides();

        $name = $request->request->get('Name');
        $saleprice = $request->request->get('SalePrice');
        $id = $request->request->get('SideId');

        $adminmodel = new AdminModel;
        $adminmodifysides = $adminmodel->modifyside($name, $saleprice, $id);

        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $useradmin = $userSession->isAdmin();
        $username = $userSession->getFirstName();
        $userprivilege = $userSession->getPrivilege();

        return $app['twig']->render
        (
            'adminmodifysides.html.twig', ['adminmodifysides'=>$adminmodifysides, 'sides'=>$sides, 'userconnect' => $userconnect, 'useradmin' => $useradmin,
                'username' => $username, 'userprivilege' => $userprivilege]
        );
    }
////////////////////////////////////////////////////////////////////////////////////////////////////

    public function adminModifyDessertsPage(application $app, $DessertId)
    {
        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $useradmin = $userSession->isAdmin();
        if ($userconnect == true && $useradmin == true) {

            $menumodel = new MenuModel();
            $desserts = $menumodel->showDesserts($DessertId);


            $username = $userSession->getFirstName();
            $userprivilege = $userSession->getPrivilege();

            return $app['twig']->render
            (
                'modifydesserts.html.twig', ['desserts'=>$desserts, 'userconnect' => $userconnect, 'useradmin' => $useradmin,
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

    public function adminModifyDesserts(Application $app, request $request)
    {
        $menumodel = new MenuModel();
        $desserts = $menumodel->getDesserts();

        $name = $request->request->get('Name');
        $saleprice = $request->request->get('SalePrice');
        $id = $request->request->get('DessertId');

        $adminmodel = new AdminModel;
        $adminmodifydesserts = $adminmodel->modifyDessert($name, $saleprice, $id);

        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $useradmin = $userSession->isAdmin();
        $username = $userSession->getFirstName();
        $userprivilege = $userSession->getPrivilege();

        return $app['twig']->render
        (
            'adminmodifydesserts.html.twig', ['adminmodifydesserts'=>$adminmodifydesserts, 'desserts'=>$desserts, 'userconnect' => $userconnect, 'useradmin' => $useradmin,
                'username' => $username, 'userprivilege' => $userprivilege]
        );
    }

    /////////////////////////////////////////////////////////////////////////////////////////
    public function adminModifyDrinksPage(application $app, $DrinksId)
    {
        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $useradmin = $userSession->isAdmin();
        if ($userconnect == true && $useradmin == true) {

            $menumodel = new MenuModel();
            $drinks = $menumodel->showDrinks($DrinksId);

            $username = $userSession->getFirstName();
            $userprivilege = $userSession->getPrivilege();

            return $app['twig']->render
            (
                'modifydrinks.html.twig', ['drinks'=>$drinks, 'userconnect' => $userconnect, 'useradmin' => $useradmin,
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

    public function adminModifyDrinks(Application $app, request $request)
    {
        $menumodel = new MenuModel();
        $drinks = $menumodel->getDrinks();

        $name = $request->request->get('Name');
        $saleprice = $request->request->get('SalePrice');
        $id = $request->request->get('DrinksId');

        $adminmodel = new AdminModel;
        $adminmodifydrinks = $adminmodel->modifyDrink($name, $saleprice, $id);

        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $useradmin = $userSession->isAdmin();
        $username = $userSession->getFirstName();
        $userprivilege = $userSession->getPrivilege();

        return $app['twig']->render
        (
            'adminmodifydrinks.html.twig', ['adminmodifydrinks'=>$adminmodifydrinks, 'drinks'=>$drinks, 'userconnect' => $userconnect, 'useradmin' => $useradmin,
                'username' => $username, 'userprivilege' => $userprivilege]
        );
    }
}