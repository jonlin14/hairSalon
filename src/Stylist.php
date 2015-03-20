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
            $GLOBALS['DB']->exec("INSERT INTO stylist (name) VALUES ('{$this->getName()}');");
        }

        static function getAll()
        {
            $all_stylists_pdo = $GLOBALS['DB']->query("SELECT * FROM stylist;");
            $all_stylists = array();
            foreach ($all_stylists_pdo as $element)
            {
                $stylist_name = $element['name'];
                $new_stylist = new Stylist($stylist_name);
                array_push($all_stylists, $new_stylist);
            }
            return $all_stylists;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists *");
        }
    }


?>
