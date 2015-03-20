<?php

    class Stylist {
        private $name;


        function __construct($new_name)
        {
            $this->name= $new_name;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->exec("INSERT INTO stylists (name) VALUES ('{$this->getName()}');");
        }

        function getAll()
        {
            $all_stylists_pdo = $GLOBALS['DB']->query("SELECT * FROM hair_salon");
            $all_stylists = array();
            foreach ($all_stylists_pdo as $element)
            {
                $stylist_name = $element['name'];
                $new_stylist = new Stylist('name');
                array_push($all_stylists, $new_stylist);
            }
            return $all_stylists;
        }

        function deleteAll()
        {
            $GLOBALS['DB']->exec('DELETE FROM stylists *');
        }
    }


?>
