<?php

    class Stylist {
        private $name;
        private $id;


        function __construct($new_name, $id = null)
        {
            $this->name= $new_name;
            $this->id = $id;
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
                $id = $element['id'];
                $new_stylist = new Stylist($stylist_name, $id);
                array_push($all_stylists, $new_stylist);
            }
            return $all_stylists;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylist *");
        }

        static function find($find_id)
        {
            $all_stylists = Stylist::getAll();
            $found_stylist = null;

            foreach ($all_stylists as $element)
            {

                if ($element->getId() == $find_id)
                {
                    $found_stylist = $element;
                }
            }
            return $found_stylist;

        }

        function getClients()
        {
            $clients = array();
            $all_clients_pdo = $GLOBALS['DB']->query("SELECT * FROM clients WHERE stylist_id = {$this->getId()};");
            foreach($all_clients_pdo as $element)
            {
                $client_name = $element['name'];
                $id = $element['id'];
                $category_id = $element['stylist_id'];
                $new_Client = new Client($client_name, $id, $category_id);
                array_push($clients, $new_Client);
            }
            return $clients;
        }
    }


?>
