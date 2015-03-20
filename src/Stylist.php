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

        
    }


?>
