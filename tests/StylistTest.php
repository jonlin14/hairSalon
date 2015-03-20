<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";

    $DB = new PDO('pgsql:host=localhost;dbname=hair_salon_test');

    class StylistTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Stylist::deleteAll();
            Client::deleteAll();
        }
        function test_Save()
        {
            $id1 = 1;
            $name1 = "Fezzik";
            $test_stylist1 = new Stylist($name1, $id1);

            $test_stylist1->save();

            $result = Stylist::getAll();

            $this->assertEquals($test_stylist1, $result[0]);
        }

        function test_GetAll()
        {
            $id1 = 2;
            $name1 = "Wesley";
            $test_stylist1 = new Stylist($name1, $id1);
            $test_stylist1->save();

            $name2 = "Buttercup";
            $test_stylist2 = new Stylist($name2, $id1);
            $test_stylist2->save();

            $result = Stylist::getAll();

            $this->assertEquals([$test_stylist1, $test_stylist2], $result);

        }

        function test_DeleteAll()
        {
            $id1 = 3;
            $name1 = "Inigo";
            $test_stylist1 = new Stylist($name1, $id1);
            $test_stylist1->save();

            $name2 = "Montoya";
            $test_stylist2 = new Stylist($name2, $id1);
            $test_stylist2->save();

            Stylist::deleteAll();

            $result = Stylist::getAll();

            $this->assertEquals([], $result);
        }

        function test_GetId()
        {
            $name1 = "Billy";
            $id1 = 1;
            $test_stylist1 = new Stylist($name1, $id1);

            $result = $test_stylist1->getId();

            $this->assertEquals(1, $result);
        }

        function test_SetId()
        {
            $name1 = "Crystal";
            $id1 = 1;
            $test_stylist1 = new Stylist($name1, $id1);

            $test_stylist1->setId(2);
            $result = $test_stylist1->getId();

            $this->assertEquals(2, $result);
        }

        function test_Find()
        {
            $name1 = "Rugen";
            $id1 = 1;
            $test_stylist1 = new Stylist($name1, $id1);
            $test_stylist1->save();

            $name2 = "Andre";
            $id2 = 2;
            $test_stylist2 = new Stylist($name2, $id2);
            $test_stylist2->save();

            $result = Stylist::find($test_stylist2->getId());

            $this->assertEquals($test_stylist2, $result);
        }

        function test_GetClients()
        {
            $name1 = "Robin";
            $id1 = 1;
            $test_stylist = new Stylist($name1, $id1);
            $test_stylist->save();

            $test_stylist_id = $test_stylist->getId();

            $id2 = 2;
            $name2 = "Wright";
            $test_client = new Client($name2, $id2, $test_stylist_id);
            $test_client->save();

            $id3 = 3;
            $name3 = "Cary";
            $test_client2 = new Client($name3, $id3, $test_stylist_id);
            $test_client2->save();

            $result = $test_stylist->getClients();

            $this->assertEquals([$test_client, $test_client2], $result);
        }

        function test_Update()
        {
            $name1 = "Cory";
            $id1 = 1;
            $test_stylist = new Stylist($name1, $id1);
            $test_stylist->save();

            $new_name = "Matthews";

            $test_stylist->update($new_name);

            $this->assertEquals("Matthews", $test_stylist->getName());
        }

        function test_Delete()
        {
            $name1 = "Topanga";
            $id1 = 1;
            $test_stylist = new Stylist($name1, $id1);
            $test_stylist->save();

            $name2 = "Lawrence";
            $id2 = 2;
            $test_stylist2 = new Stylist($name2, $id2);
            $test_stylist2->save();

            $test_stylist2->delete();
            $result = Stylist::getAll();

            $this->assertEquals([$test_stylist], $result);

        }

        function test_DeleteInDatabase()
        {
            $name1 = "Hunter";
            $id1 = 1;
            $test_stylist = new Stylist($name1, $id1);
            $test_stylist->save();

            $name2 = "Minkus";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($name2, $id1, $stylist_id);
            $test_client->save();

            $test_stylist->delete();

            $this->assertEquals([], Client::getAll());
        }

    }
 ?>
