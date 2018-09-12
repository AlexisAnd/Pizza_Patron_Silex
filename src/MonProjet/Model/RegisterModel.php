<?php

namespace MonProjet\Model;

use MonProjet\Infrastructure\Database;
use MonProjet\Infrastructure\UserSession;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RegisterModel
{

    function register($firstname, $lastname, $address, $city, $postal, $phone, $email, $passCrypt)
    {
        $db = new Database();

        $sql = 'SELECT Email FROM users  WHERE users.Email=?';
        $result = $db->queryOne($sql, [$email]);

        if ($email == $result['Email']) {
            
            throw new NotFoundHttpException ("Cette adresse email est déjà utilisée sur notre site");
            }
        else {

            $sql = 'INSERT INTO users(FirstName, LastName, Address, City, Postal_Code, Phone, Email, Password, CreationTimeStamp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())';

            return $db->query($sql, [$firstname, $lastname, $address, $city, $postal, $phone, $email, $passCrypt]);
        }
    }

        function login($email, $password)
        {

            $db = new Database();

            $sql = 'SELECT FirstName, LastName, Address, City, Postal_Code, Phone, UserId, Email, Password, Privilege FROM users WHERE Email=?';
            $result = $db->queryOne($sql, [$email]);

            if ($result['Password'] == crypt($password, $result['Password'])) {
                
                $usersession = new UserSession;
                $usersession->Create($result['FirstName'], $result['LastName'], $result['Address'], $result['City'], $result['Postal_Code'], $result['Phone'], $result['UserId'], $result['Email'], $result['Privilege']);

            } 
            else {
            
            throw new NotFoundHttpException ("L'adresse et le mot de passe sont incorrects");
            }
            }
    
    function getCustInfos($userid)
    {

        $db = new Database;

        $sql = 'SELECT * FROM users  WHERE UserId=?';

        $customersinfos = $db->queryOne($sql, [$userid]);

        return $customersinfos;
    }

    function updateAddress($firstname, $lastname, $address, $city, $postal, $phone, $email, $userid)
    {
        $db = new Database();

            $sql = 'UPDATE `users` SET `FirstName`=?,`LastName`=?,
                    `Address`=?,`City`=?,`Postal_Code`=?,`Phone`=?, Email=? WHERE UserId=?';

            return $db->queryOne($sql, [$firstname, $lastname, $address, $city, $postal, $phone, $email, $userid]);
    }

 function updatePassword($password, $passcrypt, $userid)
    {
        $db = new Database();

        $sql = 'SELECT * FROM `users`  WHERE `UserId`=?';
        $result = $db->queryOne($sql, [$userid]);

     
     if ($result['Password'] == crypt($password, $result['Password'])) {

                $sql = 'Update `users` SET `Password`=? WHERE `UserId`=?';
         
                $result = $db->queryOne($sql, [$passcrypt, $userid]);

            return $result;
     }
     else {
            
            throw new NotFoundHttpException ("L'ancien mot de passe est incorrect");
            }
 
    }
}
