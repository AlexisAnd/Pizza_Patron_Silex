<?php

namespace MonProjet\Controller;

use Silex\Application;

use MonProjet\Infrastructure\UserSession;


use MonProjet\Model\MenuModel;

use MonProjet\Model\OrderModel;

class MenuController
{
    
 public function showMenuDetails(Application $app) {

     $menumodel = new MenuModel();
     $pizzas = $menumodel -> getPizzas();
     $sides = $menumodel -> getSides();
     $paninis = $menumodel -> getPaninis();
     $desserts = $menumodel -> getDesserts();
     $drinks = $menumodel -> getDrinks();


     $userSession = new UserSession;

     $userconnect = $userSession->isConnected();
     if($userconnect == true) {
         $userid = $userSession->UserId();
         $useradmin = $userSession->isAdmin();
         $username = $userSession->getFirstName();
         $userprivilege = $userSession->getPrivilege();
         $ordermodel = new OrderModel;
         $order = $ordermodel->order($userid);
         $ordertotal = $ordermodel->getTotal($order);


         return $app['twig']->render
         (
             'menu.html.twig', ['userconnect' => $userconnect, 'useradmin' => $useradmin, 'username' => $username,
                 'userprivilege'=>$userprivilege, 'pizzas' => $pizzas, 'sides' => $sides, 'paninis' => $paninis, 'desserts' => $desserts,
                 'drinks' => $drinks, 'ordertotal'=>$ordertotal]
         );
     }
     else {

         return $app['twig']->render
         (
             'menu.html.twig', ['userconnect' => $userconnect, 'pizzas' => $pizzas, 'sides' => $sides, 'paninis' => $paninis, 'desserts' => $desserts,
                 'drinks' => $drinks]
         );
     }
 }

}