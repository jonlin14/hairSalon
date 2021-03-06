<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Client.php";
    require_once "src/Stylist.php";

    $DB = new PDO('pgsql:host=localhost;dbname=hair_salon_test');

    class ClientTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Client::deleteAll();
            Stylist::deleteAll();
        }

        function testSave()
        {
            $stylist1 = "Sirius";
            $id1 = 2;
            $test_stylist = new Stylist($stylist1, $id1);

            $id1 = 1;
            $name1 = 'Harry';
            $stylist_id = $test_stylist->getId();
            $test_client1 = new Client($name1, $id1, $stylist_id);

            $test_client1->save();
            $result = Client::getAll();

            $this->assertEquals($test_client1, $result[0]);

        }

        function testGetAll()
        {
            $id1 = 2;
            $stylist1 = "Snape";
            $test_stylist = new Stylist($stylist1, $id1);

            $id1 = 1;
            $name1 = 'Ron';
            $stylist_id = $test_stylist->getId();
            $test_client1 = new Client($name1, $id1, $stylist_id);
            $test_client1->save();

            $name2 = 'Hermoine';
            $test_client2 = new Client($name2, $id1, $stylist_id);
            $test_client2->save();

            $result = Client::getAll();

            $this->assertEquals([$test_client1, $test_client2], $result);

        }

        function testDeleteAll()
        {
            $id1 = 2;
            $stylist1 = "McGonagall";
            $test_stylist = new Stylist($stylist1, $id1);

            $id1 = 1;
            $stylist_id = $test_stylist->getId();
            $name1 = "Hagrid";
            $test_client1 = new Client($name1, $id1, $stylist_id);
            $test_client1->save();

            $name2 = "Fawkes";
            $test_client2 = new Client($name2, $id1, $stylist_id);
            $test_client2->save();

            $result = Client::deleteAll();

            $this->assertEquals([], Client::getAll());
        }

        function testSetId()
        {
            $id1 = 2;
            $stylist1 = "James";
            $test_stylist = new Stylist($stylist1, $id1);

            $id1 = 1;
            $stylist_id = $test_stylist->getId();
            $name1 = "Potter";
            $test_client1 = new Client($name1, $id1, $stylist_id);
            $test_client1->save();

            $test_client1->setClientId(2);
            $result = $test_client1->getClientId();

            $this->assertEquals(2, $result);
        }

        function testGetId()
        {
            $stylist = "Granger";
            $id1 = 1;
            $test_stylist = new Stylist($stylist, $id1);
            $test_stylist->save();

            $id1 = 3;
            $stylist_id = $test_stylist->getId();
            $name1 = "Weasley";
            $test_client1 = new Client($name1, $id1, $stylist_id);



            $result = $test_client1->getClientId();

            $this->assertEquals(true, $result);
        }

        function test_GetStylistId()
        {
            $stylist = "Dobby";
            $id1 = 1;
            $test_stylist = new Stylist($stylist, $id1);

            $id1 = 3;
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($stylist, $id1, $stylist_id);

            $result = $test_client->getStylistId();

            $this->assertEquals(true, $result);
        }

        function test_Delete()
        {
            $name1 = "Fred";
            $id1 = 1;
            $test_stylist = new Stylist($name1, $id1);
            $test_stylist->save();

            $name2 = "George";
            $id2 = 2;
            $stylist_id = $test_stylist->getId();
            $test_client = new Stylist($name2, $id2, $stylist_id);
            $test_client->save();

            $test_client->delete();
            $result = Client::getAll();

            $this->assertEquals([], $result);

        }


    }

 ?>
