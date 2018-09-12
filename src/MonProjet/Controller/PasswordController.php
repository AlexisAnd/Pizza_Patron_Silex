<?php

namespace MonProjet\Controller;

use Silex\Application;

use MonProjet\Infrastructure\UserSession;
use MonProjet\Infrastructure\Loginform;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use MonProjet\Model\RegisterModel;

class PasswordController
{
    public function passwordPage(Application $app) {
        
         $userSession = new UserSession;
        $userconnect = $userSession->isConnected();

        if ($userconnect == false) {

            exit();
        } else {
             $form = new Loginform();
            $useradmin = $userSession->isAdmin();
            $username = $userSession->getFirstName();
            $userprivilege = $userSession->getPrivilege();

            $userSession = new UserSession;
            $userid = $userSession->userId();
        
        return $app['twig']->render
        (
            'password.html.twig', ['userconnect' => $userconnect, 'useradmin' => $useradmin, 'username' => $username,
                    'userprivilege'=>$userprivilege, 'loginform'=>$form]
        );
        
        
    }
    }
    
       public function passwordUpdate(Application $app, request $request) {
        
       try { $userSession = new UserSession;
        $userid = $userSession->userId();

        $password = $request->request->get('Password');
        $newpassword = $request->request->get('newPassword');
        
        $salt='$2y$11$'.substr(bin2hex(openssl_random_pseudo_bytes(32)),0,22);
        $passcrypt= crypt($newpassword, $salt);
      
        $registermodel = new RegisterModel();
        $updatepassword = $registermodel->updatePassword($password, $passcrypt, $userid);

        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $useradmin = $userSession->isAdmin();
        $username = $userSession->getFirstName();
        $userprivilege = $userSession->getPrivilege();

        return $app['twig']->render
        (
            'password.html.twig', ['updatepassword' => $updatepassword, 'userconnect'=>$userconnect,
                'useradmin' => $useradmin, 'username' => $username, 'userprivilege'=>$userprivilege]
        );
        }
           
        catch(NotFoundHttpException $e) {
        
        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
            $useradmin = $userSession->isAdmin();
        $username = $userSession->getFirstName();
        $userprivilege = $userSession->getPrivilege();
        $form = new Loginform();
        $form->setErrorMessage($e->getMessage());
            
            
        return $app['twig']->render
            (
                'password.html.twig', ['userconnect'=>$userconnect, 'useradmin' => $useradmin, 'username' => $username,
                    'userprivilege'=>$userprivilege, 'loginform'=>$form]
            );
        }
    }
}