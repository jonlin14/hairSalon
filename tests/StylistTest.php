<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";

    $DB = new PDO('pgsql:host=localhost;dbname=hair_salon');

    class StylistTest extends PHPUnit_Framework_TestCase
    {
        
    }
 ?>
