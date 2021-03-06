<?php
    class Client {
        private $clientName;
        private $clientId;
        private $stylist_id;

        function __construct($name, $id = null, $stylist_id)
        {
            $this->clientName = $name;
            $this->clientId = $id;
            $this->stylist_id = $stylist_id;
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

        function getStylistId()
        {
            return $this->stylist_id;
        }

        function setStylistId($new_stylist_id)
        {
            $this->stylist_id = $new_stylist_id;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO clients (name, stylist_id) VALUES ('{$this->getClientName()}', {$this->getStylistId()}) RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setClientId($result['id']);
        }

        function update($new_name)
            {
                $GLOBALS['DB']->exec("UPDATE clients SET name = '{$new_name}' WHERE id = {$this->getClientId()};");
                $this->setClientName($new_name);
            }

        function delete()
            {
                $GLOBALS['DB']->exec("DELETE FROM clients WHERE id = {$this->getClientId()};");
            }

        static function getAll()
            {
                $all_clients_pdo = $GLOBALS['DB']->query("SELECT * FROM clients");
                $all_clients = array();

                foreach ($all_clients_pdo as $element)
                {
                    $name = $element['name'];
                    $id = $element['id'];
                    $stylist_id = $element['stylist_id'];
                    $new_client = new Client($name, $id, $stylist_id);
                    array_push($all_clients, $new_client);
                }
                return $all_clients;
            }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients *;");
        }

        static function find($find_id)
            {
                $foundClient = null;
                $all_Clients = Client::getAll();
                foreach ($all_Clients as $element)
                {
                    if ($element->getClientId() == $find_id)
                    {
                        $foundClient = $element;
                    }
                }
                return $foundClient;
            }
        }
?>
