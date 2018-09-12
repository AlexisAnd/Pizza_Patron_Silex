<?php

namespace MonProjet\Infrastructure;


class UserSession
{

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {

            session_start();
        }

        if (!array_key_exists('User', $_SESSION)) {

            $_SESSION['User'] = array();
        }
    }




    function Create($firstname, $lastname, $address, $city, $postalcode, $phone, $id, $email, $privilege)
    {
        $_SESSION['User']['FirstName'] = $firstname;
        $_SESSION['User']['LastName'] = $lastname;
        $_SESSION['User']['Address'] = $address;
        $_SESSION['User']['City'] = $city;
        $_SESSION['User']['Postal_Code'] = $postalcode;
        $_SESSION['User']['Phone'] = $phone;
        $_SESSION['User']['UserId'] = $id;
        $_SESSION['User']['Email'] = $email;
        $_SESSION['User']['Privilege'] = $privilege;
    }

    function delete()
    {

        $_SESSION['User'] = array();
        session_destroy();
    }

    function getEmail()
    {

        if (array_key_exists('User', $_SESSION)) {

            return $_SESSION['User']['Email'];

        }
    }

    function getFirstName()
    {

        if (array_key_exists('User', $_SESSION)) {

            return $_SESSION['User']['FirstName'];

        }
    }
    function getPrivilege()
    {
        if (array_key_exists('User', $_SESSION)) {

            return $_SESSION['User']['Privilege'];
        }
    }

    function getName()
    {

        if (array_key_exists('User', $_SESSION)) {

            return $_SESSION['User']['LastName'];

        }
    }

    function fullName()
    {

        if (array_key_exists('User', $_SESSION)) {

            return $_SESSION['User']['FirstName'] . "" . $_SESSION['User']['LastName'] . ".";
        }
    }

    function userId()
    {
        if (array_key_exists('User', $_SESSION)) {

            return $_SESSION['User']['UserId'];

        }
    }
    function userAddress()
    {
        if (array_key_exists('User', $_SESSION)) {

            return $_SESSION['User']['Address'];

        }
    }
    function userCity()
    {
        if (array_key_exists('User', $_SESSION)) {

            return $_SESSION['User']['City'];

        }
    }
    function userPostalCode()
    {
        if (array_key_exists('User', $_SESSION)) {

            return $_SESSION['User']['Postal_Code'];

        }
    }
    function userPhone()
    {
        if (array_key_exists('User', $_SESSION)) {

            return $_SESSION['User']['Phone'];

        }
    }
    function isConnected()
    {

        if (array_key_exists('UserId', $_SESSION['User'])) {

            return true;
        } else {

            return false;
        }
    }

    function isAdmin()

    {
        if ($this->isConnected()) {

            if ($_SESSION['User']['Privilege'] == 'user') {

                return false;
            } else {

                return true;

            }
        }
        else{
            return false;

        }
    }

}