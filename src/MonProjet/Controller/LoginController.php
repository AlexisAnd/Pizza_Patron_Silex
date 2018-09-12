<?php

namespace MonProjet\Controller;

use Silex\Application;

use MonProjet\Infrastructure\UserSession;
use MonProjet\Infrastructure\Loginform;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use MonProjet\Model\RegisterModel;
use MonProjet\Model\MenuModel;

class LoginController
{
    public function loginPage(application $app) {

        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $form = new Loginform();

        if($userconnect == true) {

            exit();
        }
        else {
            return $app['twig']->render
            (
                'login.html.twig', ['userconnect'=>$userconnect, 'loginform'=>$form]
            );
        }
    }

    public function loginUser(application $app, request $request) {
        
      try {
            $menumodel = new MenuModel();
            $pizzas = $menumodel -> getPizzas();
            $sides = $menumodel -> getSides();
            $paninis = $menumodel -> getPaninis();
            $desserts = $menumodel -> getDesserts();
            $drinks = $menumodel -> getDrinks();

            $email = $request->request->get('Email');
            $password = $request->request->get('Password');

            $registermodel = new RegisterModel;
            $user = $registermodel->login($email, $password);

            $userSession = new UserSession;
            $userconnect = $userSession->isConnected();
            $useradmin = $userSession->isAdmin();
            $username = $userSession->getFirstName();
            $userprivilege = $userSession->getPrivilege();

          return $app['twig']->render
            (
                'menu.html.twig',['user'=>$user, 'userconnect'=>$userconnect, 'useradmin'=>$useradmin,
                    'username'=>$username, 'userprivilege'=>$userprivilege, 'pizzas' => $pizzas, 'sides' => $sides, 'paninis' => $paninis, 'desserts' => $desserts,
                    'drinks' => $drinks]
            );
    }
        
        catch(NotFoundHttpException $e) {
        
        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $form = new Loginform();
        $form->setErrorMessage($e->getMessage());
            
        var_dump($form);    
        return $app['twig']->render
            (
                'login.html.twig', ['userconnect'=>$userconnect, 'loginform'=>$form]
            );
        }
        }
}
