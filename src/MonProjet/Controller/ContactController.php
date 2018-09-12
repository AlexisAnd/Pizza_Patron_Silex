<?php


namespace MonProjet\Controller;

use Silex\Application;

use MonProjet\Infrastructure\UserSession;

class ContactController
{

    public function contactPage(Application $app) {

        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        if($userconnect == true) {
            $useradmin = $userSession->isAdmin();
            $username = $userSession->getFirstName();
            $userprivilege = $userSession->getPrivilege();

            return $app['twig']->render
            (
                'contact.html.twig',['userconnect'=>$userconnect, 'useradmin'=>$useradmin,
                    'username'=>$username, 'userprivilege'=>$userprivilege]
            );
        }
        else {
            return $app['twig']->render
            (
                'contact.html.twig',['userconnect'=>$userconnect]
            );
        }
    }
}
