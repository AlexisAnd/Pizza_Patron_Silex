<?php
/**
 * Created by PhpStorm.
 * User: Alexis
 * Date: 06/06/2017
 * Time: 22:07
 */


namespace MonProjet\Controller\Admin\AdminAdd;

use Silex\Application;

use MonProjet\Infrastructure\UserSession;

use Symfony\Component\HttpFoundation\Request;

use MonProjet\Model\AdminModel;


class AdminController
{
    public function adminPage(application $app)
    {

        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $useradmin = $userSession->isAdmin();
        if ($userconnect == true && $useradmin == true) {

                $username = $userSession->getFirstName();
                $userprivilege = $userSession->getPrivilege();

                return $app['twig']->render
                (
                    'admin.html.twig', ['userconnect' => $userconnect, 'useradmin' => $useradmin, 'username' => $username, 'userprivilege'=>$userprivilege]
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
        $description = $request->request->get('Description');
        $saleprice = $request->request->get('SalePrice');
        $salepricesenor = $request->request->get('SalePriceSenor');
        $salepricemega = $request->request->get('SalePriceMega');

        $adminmodel = new AdminModel;
        $adminpizza = $adminmodel->addPizzas($name, $description, $saleprice, $salepricesenor, $salepricemega);

        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $username = $userSession->getFirstName();
        $useradmin = $userSession->isAdmin();
        $userprivilege = $userSession->getPrivilege();

        return $app['twig']->render
        (
            'admin.html.twig', ['adminpizza' => $adminpizza, 'userconnect'=>$userconnect,
                'username'=>$username, 'useradmin' => $useradmin, 'userprivilege'=>$userprivilege]
        );
    }
}