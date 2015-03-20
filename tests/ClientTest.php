<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Client.php";

    $DB = new PDO('pgsql:host=localhost;dbname=hair_salon_test')

    class ClientTest extends PHPUnit_Framework_TestCase
    {
        function testSave()
        {
            $id1 = 1;
            $name1 = 'Harry';
            $test_client1 = new Client($name1, $id1);

            $test_client1->save();
            $result = Client::getAll();

            $this->assertEquals($test_client1, $result);

        }
    }

 ?>
