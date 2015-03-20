<?php
    class Client {
        private $clientName;
        private $clientId;

        function __construct($name, $id = null)
        {
            $this->clientName = $name;
            $this->clientId = $id;
        }

        function getClientName()
        {
            return $this->clientName;
        }

        function setClientName($new_name)
        {
            $this->clientName = $new_name;
        }

        function getClientId()
        {
            return $this->clientId;
        }

        function setClientId($new_id)
        {
            $this->clientId = $new_id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO clients VALUES ('{this->getClientName}');");
        }

        static function getAll()
        {
            $all_clients_pdo = $GLOBALS['DB']->query("SELECT * FROM clients");
            $all_clients = array();
            foreach ($all_clients_pdo as $element)
            {
                $name = $element['name'];
                $new_client = new Client($name);
                array_push($all_clients, $new_client);
            }
            return $all_clients;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients *;");
        }


    }
 ?>
