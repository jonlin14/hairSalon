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
        }
        function testSave()
        {
            $name1 = "Fezzik";
            $test_stylist1 = new Stylist($name1);

            $test_stylist1->save();

            $result = Stylist::getAll();

            $this->assertEquals($test_stylist1, $result[0]);
        }

        function testGetAll()
        {
            $name1 = "Wesley";
            $test_stylist1 = new Stylist($name1);
            $test_stylist1->save();

            $name2 = "Buttercup";
            $test_stylist2 = new Stylist($name2);
            $test_stylist2->save();

            $result = Stylist::getAll();

            $this->assertEquals([$test_stylist1, $test_stylist2], $result);

        }



    }
 ?>
