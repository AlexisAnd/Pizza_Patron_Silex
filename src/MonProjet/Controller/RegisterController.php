<?php

namespace MonProjet\Controller;

use Silex\Application;

use MonProjet\Infrastructure\UserSession;
use MonProjet\Infrastructure\Loginform;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use MonProjet\Model\RegisterModel;


class RegisterController
{

    public function registerUser(Application $app)
    {
        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $form = new Loginform();

        if($userconnect == true) {

            exit();
        }
        else {
            return $app['twig']->render
            (
                'register.html.twig', ['userconnect'=>$userconnect, 'loginform'=>$form]
            );
        }
    }
        public function userRegistered(Application $app, request $request)
    {
        
       try {
        $firstname = $request->request->get('FirstName');
        $lastname = $request->request->get('LastName');
        $address = $request->request->get('Address');
        $city = $request->request->get('City');
        $postal = $request->request->get('Postal_Code');
        $phone = $request->request->get('Phone');
        $email = $request->request->get('Email');
        $password = $request->request->get('Password');
        
        $salt='$2y$11$'.substr(bin2hex(openssl_random_pseudo_bytes(32)),0,22);
        $passCrypt= crypt($password, $salt);

        $registermodel = new RegisterModel();
        $register = $registermodel->register($firstname, $lastname, $address, $city, $postal, $phone, $email, $passCrypt);

        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();

        $form = new Loginform();

        $message = 'Felicitations! Votre compte est maintenant crée. Vous pouvez maintenant vous connecter à votre compte en cliquant sur le lien ci dessus.';

        $app['session']->getFlashBag()->add('notice', $message);

        return $app['twig']->render('register.html.twig',[ 'register' => $register, 'userconnect'=>$userconnect, 'loginform'=>$form]);
       }

       catch(NotFoundHttpException $e) {
        
        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $form = new Loginform();
        $form->setErrorMessage($e->getMessage());
            
            
        return $app['twig']->render
            (
                'register.html.twig', ['userconnect'=>$userconnect, 'loginform'=>$form]
            );
        }
    }

}