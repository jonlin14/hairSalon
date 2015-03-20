<?php
        require_once __DIR__."/../vendor/autoload.php";
        require_once __DIR__."/../src/Stylist.php";
        use Symfony\Component\HttpFoundation\Request;
        Request::enableHttpMethodParameterOverride();

        $app = new Silex\Application();
        $app['debug'] = true;

        $DB = new PDO('pgsql:host=localhost;dbname=hair_salon');

        $app->register(new Silex\Provider\TwigServiceProvider(), array(
            'twig.path'=>__DIR__.'/../views'
        ));

        $app->get("/", function() use($app) {
            return $app['twig']->render('index.html.twig', array( 'stylists' => Stylist::getAll()));
        });

        $app->post("/", function() use ($app) {
            $stylist = new Stylist($_POST['stylist_name']);
            $stylist->save();
            return $app['twig']->render('index.html.twig', array( 'stylists' => Stylist::getAll()));
        });

        $app->post("/delete", function() use($app) {
            Stylist::deleteAll();
            return $app['twig']->render('index.html.twig', array ('stylists' => Stylist::getAll()));
        });

        return $app;


 ?>