<?php

namespace MonProjet\Model;

use MonProjet\Infrastructure\Database;

class MenuModel
{
     public function getPizzas() {

        $db = new Database();

        $sql= 'SELECT * FROM meals';

        return $db->query($sql);

    }

    public function showPizzas($MealId) {

        $db = new Database();

        $sql= 'SELECT * FROM meals WHERE MealId=?';

        return $db->queryOne($sql,[$MealId]);



    }
    public function getSides() {

        $db = new Database();

        $sql= 'SELECT * FROM sides';

        return $db->query($sql);

    }

    public function showSides($id) {

        $db = new Database();

        $sql= 'SELECT * FROM sides WHERE SideId=?';

        return $db->queryOne($sql,[$id]);

    }
    public function getPaninis() {

        $db = new Database();

        $sql= 'SELECT * FROM paninis';

        return $db->query($sql);

    }

    public function showPaninis($id) {

        $db = new Database();

        $sql= 'SELECT * FROM paninis WHERE PaninisId=?';

        return $db->queryOne($sql,[$id]);

    }
    public function getDesserts() {

        $db = new Database();

        $sql= 'SELECT * FROM desserts';

        return $db->query($sql);

    }
    public function showDesserts($id) {

        $db = new Database();

        $sql= 'SELECT * FROM desserts WHERE DessertId=?';

        return $db->queryOne($sql,[$id]);

    }

    public function getDrinks() {

        $db = new Database();

        $sql= 'SELECT * FROM drinks';

        return $db->query($sql);

    }
    public function showDrinks($id) {

        $db = new Database();

        $sql= 'SELECT * FROM drinks WHERE DrinksId=?';

        return $db->queryOne($sql,[$id]);

    }

}