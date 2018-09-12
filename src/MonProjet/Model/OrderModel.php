<?php

namespace MonProjet\Model;

use MonProjet\Infrastructure\Database;


class OrderModel
{

    function order($userid)
    {

        $db = new Database;

        $sql = 'SELECT OrderId FROM `order` WHERE UserId=? AND completeTimeStamp IS NULL';

        $result = $db->queryOne($sql, [$userid]);

        if ($result == false) {

        $sql = 'INSERT INTO `order`(UserId, CreationTimeStamp) VALUES(?,NOW())';

        $order = $db->executeSql($sql, [$userid]);

    }
    else{

        $order = $result['OrderId'];

        }
        return $order;
    }

    function getOrderList($order, $name, $meal, $paninis, $sides, $desserts, $drinks, $quantity, $price, $userid)
    {

        $db = new database;

        $sql = 'SELECT Quantity FROM `orderline` WHERE OrderId=? AND SalePrice=? AND MealId=? OR PaninisId=? OR SideId=? OR DessertId=? OR DrinksId=?';

        $result = $db->queryOne($sql, [$order, $price, $meal, $paninis, $sides, $desserts, $drinks]);

        if ($result == false) {

            $sql = 'INSERT INTO `orderline`(OrderId, Name, MealId, PaninisId, SideId, DessertId, DrinksId, Quantity, SalePrice, UserId) VALUES (?,?,?,?,?,?,?,?,?,?)';

            $result = $db->query($sql, [$order, $name, $meal, $paninis, $sides, $desserts, $drinks, $quantity, $price, $userid]);
        }
        else {
            $sql = 'UPDATE orderline SET Quantity=? WHERE OrderId=? AND SalePrice=? AND MealId=? OR PaninisId=? OR SideId=? OR DessertId=? OR DrinksId=?';

            $result = $db->executeSql($sql, [$quantity + $result['Quantity'], $order, $price, $meal, $paninis, $sides, $desserts, $drinks]);

        }

        return $result;
    }

    function getList($order)
    {
        $db = new database;

        $sql = 'SELECT * FROM `orderline` WHERE OrderId=?';

        $basket = $db->query($sql, [$order]);

        return $basket;
    }

    function getTotal($order)
    {

        $db = new database;

        $sql = 'SELECT SUM(SalePrice*Quantity) as Total FROM orderline WHERE OrderId=? GROUP BY OrderId';

        $total = $db->queryOne($sql, [$order]);

        return $total;
    }

    function eraseItem($id)
    {
        $db = new Database;

        $sql = 'SELECT Quantity FROM `orderline` WHERE OrderLineId=?';

        $result = $db->queryOne($sql, [$id]);

        if ($result['Quantity'] == 1) {

        $sql = 'DELETE FROM `orderline` WHERE OrderLineId=?';

        $result = $db->executeSql($sql, [$id]);
        }
        else
        {
            $sql = 'UPDATE orderline SET Quantity=? WHERE OrderLineId=?';

        $result = $db->executeSql($sql, [$result['Quantity'] - 1 , $id]);
        }

        return $result;
    }

    function ordersList($userid) {

        $db = new database;

        $sql = 'SELECT * FROM `order` WHERE `order`.UserId=? AND CompleteTimeStamp is not Null';

        $result = $db->query($sql, [$userid]);

        return $result;
    }
    function ordersListOne($OrderId) {

        $db = new database;

        $sql = 'SELECT * FROM `order` WHERE OrderId=?';

        $result = $db->queryOne($sql, [$OrderId]);

        return $result;
    }
    function orderDetails($OrderId) {

        $db = new database;

        $sql = 'SELECT * FROM `orderline` WHERE OrderId=?';

        $result = $db->query($sql, [$OrderId]);

        return $result;
    }
    function completeOrder($total, $useraddress, $usercity, $userpostalcode, $userphone, $order)
    {
        $db = new Database;

        $sql = 'UPDATE `order` SET TotalAmount=?, Address=?, City=?, Postal_Code=?, Phone=?, CompleteTimeStamp=NOW() WHERE Order.OrderId=?';
        $complete = $db->executeSql($sql, [$total['Total'], $useraddress, $usercity, $userpostalcode, $userphone, $order]);

        return $complete;


    }
}

