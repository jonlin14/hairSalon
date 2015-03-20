<?php

    class Stylist {
        private $name;
        private $id;


        function __construct($new_name, $id = null)
        {
            $this->name= $new_name;
            $this->id = $new_id;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function setId($new_id)
        {
            $this->id = $new_id;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO stylist (name) VALUES ('{$this->getName()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
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
            $GLOBALS['DB']->exec("DELETE FROM stylist *");
        }
    }


?>
