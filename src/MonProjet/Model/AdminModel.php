<?php

namespace MonProjet\Model;

use MonProjet\Infrastructure\Database;


class AdminModel
{
    function addPizzas($name, $description, $saleprice, $salepricesenor, $salepricemega)
    {

        $db = new Database();

        $sql = 'INSERT INTO meals (`Name`, `Description`, `SalePrice`, `SalePriceSenor`, `SalePriceMega`) VALUES (?, ?, ?, ?, ?)';
        $db->query($sql, [$name, $description, $saleprice, $salepricesenor, $salepricemega]);
    }

    function addPaninis($name, $description, $saleprice)
    {

        $db = new Database();

        $sql = 'INSERT INTO paninis (`Name`, `Description`, `SalePrice`) VALUES (?, ?, ?)';
        $db->query($sql, [$name, $description, $saleprice]);
    }

    function addSides($name, $saleprice)
    {

        $db = new Database();

        $sql = 'INSERT INTO sides (`Name`, `SalePrice`) VALUES (?, ?)';
        $db->query($sql, [$name, $saleprice]);
    }

    function addDesserts($name, $saleprice)
    {

        $db = new Database();

        $sql = 'INSERT INTO desserts (`Name`, `SalePrice`) VALUES (?, ?)';
        $db->query($sql, [$name, $saleprice]);
    }

    function addDrinks($name, $saleprice)
    {

        $db = new Database();

        $sql = 'INSERT INTO drinks (`Name`, `SalePrice`) VALUES (?, ?)';
        $db->query($sql, [$name, $saleprice]);
    }

    function deletePizza($id) {
        $db = new Database;

        $sql = 'DELETE FROM meals WHERE MealId=?';

        $db->executeSql($sql, [$id]);

    }

    function deletePanini($id) {
        $db = new Database;

        $sql = 'DELETE FROM paninis WHERE PaninisId=?';

        $db->executeSql($sql, [$id]);

    }
    function deleteSide($id) {
        $db = new Database;

        $sql = 'DELETE FROM sides WHERE SideId=?';

        $db->executeSql($sql, [$id]);

    }

    function deleteDessert($id) {
        $db = new Database;

        $sql = 'DELETE FROM desserts WHERE DessertId=?';

        $db->executeSql($sql, [$id]);
    }

    function deleteDrink($id) {
        $db = new Database;

        $sql = 'DELETE FROM drinks WHERE DrinksId=?';

        $db->executeSql($sql, [$id]);
    }

    function modifyPizza($name, $description, $saleprice, $salepricesenor, $salepricemega, $id) {
        $db = new Database;

        $sql = 'UPDATE meals SET Name=?, Description=?, SalePrice=?,SalePriceSenor=?,SalePriceMega=? WHERE MealId=?';

        $result = $db->executeSql($sql, [$name, $description, $saleprice, $salepricesenor, $salepricemega, $id]);

        return $result;
    }

    function modifyPanini($name, $description, $saleprice, $id) {
        $db = new Database;

        $sql = 'UPDATE paninis SET Name=?, Description=?, SalePrice=? WHERE PaninisId=?';

        $result = $db->executeSql($sql, [$name, $description, $saleprice, $id]);

        return $result;
    }
    function modifySide($name, $saleprice, $id) {
        $db = new Database;

        $sql = 'UPDATE sides SET Name=?, SalePrice=? WHERE SideId=?';

        $result = $db->executeSql($sql, [$name, $saleprice, $id]);


        return $result;
    }
    function modifyDessert($name, $saleprice, $id) {
        $db = new Database;

        $sql = 'UPDATE desserts SET Name=?, SalePrice=? WHERE DessertId=?';

        $result = $db->executeSql($sql, [$name, $saleprice, $id]);


        return $result;
    }

    function modifyDrink($name, $saleprice, $id) {
        $db = new Database;

        $sql = 'UPDATE drinks SET Name=?, SalePrice=? WHERE DrinksId=?';

        $result = $db->executeSql($sql, [$name, $saleprice, $id]);


        return $result;
    }
}


