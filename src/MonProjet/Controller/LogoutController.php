<?php

namespace MonProjet\Controller;

use Silex\Application;

use MonProjet\Infrastructure\UserSession;

use MonProjet\Model\MenuModel;


class LogoutController
{
    public function logOut(application $app) {

        $userSession = new UserSession;
        $userout = $userSession->delete();

        $menumodel = new MenuModel();
        $pizzas = $menumodel -> getPizzas();
        $sides = $menumodel -> getSides();
        $paninis = $menumodel -> getPaninis();
        $desserts = $menumodel -> getDesserts();
        $drinks = $menumodel -> getDrinks();

        return $app['twig']->render
        (
            'menu.html.twig',['userconnect'=>$userout, 'pizzas' => $pizzas, 'sides' => $sides, 'paninis' => $paninis, 'desserts' => $desserts,
                'drinks' => $drinks]
        );
    }
}