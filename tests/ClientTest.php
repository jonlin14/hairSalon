<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Client.php";

    $DB = new PDO('pgsql:host=localhost;dbname=hair_salon_test');

    class ClientTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Client::deleteAll();
        }

        function testSave()
        {
            $id1 = 1;
            $name1 = 'Harry';
            $test_client1 = new Client($name1, $id1);

            $test_client1->save();
            $result = Client::getAll();

            $this->assertEquals($test_client1, $result[0]);

        }

        function testGetAll()
        {
            $id = 1;
            $name1 = 'Ron';
            $test_client1 = new Client($name1, $id);
            $test_client1->save();

            $name2 = 'Hermoine';
            $test_client2 = new Client($name2, $id);
            $test_client2->save();

            $result = Client::getAll();

            $this->assertEquals([$test_client1, $test_client2], $result);

        }
    }

 ?>
