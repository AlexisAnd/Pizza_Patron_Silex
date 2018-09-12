<?php

namespace MonProjet\Controller;

use Silex\Application;

use MonProjet\Infrastructure\UserSession;

use Symfony\Component\HttpFoundation\Request;

use MonProjet\Model\RegisterModel;

class SettingsController
{
    public function settingsPage(application $app)
    {

        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();

        if ($userconnect == false) {

            exit();
        } else {
            $useradmin = $userSession->isAdmin();
            $username = $userSession->getFirstName();
            $userprivilege = $userSession->getPrivilege();

            $userSession = new UserSession;
            $userid = $userSession->userId();
            $registermodel = new RegisterModel;
            $custinfos = $registermodel->getCustInfos($userid);

            return $app['twig']->render
            (
                'settings.html.twig', ['userconnect' => $userconnect, 'useradmin' => $useradmin, 'username' => $username,
                    'userprivilege'=>$userprivilege, 'custinfos'=>$custinfos]
            );
        }
    }
    public function userUpdate(Application $app, request $request)
    {
        $userSession = new UserSession;
        $userid = $userSession->userId();

        $firstname = $request->request->get('FirstName');
        $lastname = $request->request->get('LastName');
        $address = $request->request->get('Address');
        $city = $request->request->get('City');
        $postal = $request->request->get('Postal_Code');
        $phone = $request->request->get('Phone');
        $email = $request->request->get('Email');
        

        $registermodel = new RegisterModel();
        $update = $registermodel->updateAddress($firstname, $lastname, $address, $city, $postal, $phone, $email, $userid);

        $userSession = new UserSession;
        $userconnect = $userSession->isConnected();
        $useradmin = $userSession->isAdmin();
        $username = $userSession->getFirstName();
        $userprivilege = $userSession->getPrivilege();

        $custinfos = $registermodel->getCustInfos($userid);

        return $app['twig']->render
        (
            'settings.html.twig', ['update' => $update, 'userconnect'=>$userconnect,
                'useradmin' => $useradmin, 'username' => $username, 'userprivilege'=>$userprivilege, 'custinfos'=>$custinfos]
        );

    }
    
}