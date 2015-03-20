<?php
        require_once __DIR__."/../vendor/autoload.php";
        require_once __DIR__."/../src/Stylist.php";
        require_once __DIR__."/../src/Client.php";
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

        $app->get("/stylists/{id}", function($id) use ($app) {
            $stylist = Stylist::find($id);
            return $app['twig']->render('stylists.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
        });

        $app->patch("/stylists/{id}", function($id) use ($app) {
                $new_name = $_POST['new_name'];
                $stylist = Stylist::find($id);
                $stylist->update($new_name);
                return $app['twig']->render('stylists.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
        });

        $app->delete("/stylists/{id}", function($id) use ($app) {
                $stylist = Stylist::find($id);
                $stylist->delete();
                return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
        });

        $app->get("/stylists/{id}/edit", function($id) use ($app){
            $stylist = Stylist::find($id);
            return $app['twig']->render('stylist_edit.html.twig', array('stylist' => $stylist));
        });

        $app->post("/clients", function() use ($app){
                $name = $_POST['client_name'];
                $stylist_id = $_POST['style_id'];
                $new_client = new Client($name, $id = null, $stylist_id);
                $new_client->save();
                $stylist = Stylist::find($stylist_id);
                return $app['twig']->render('stylists.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
        });

        $app->get("/client/{id}/edit", function($id) use ($app) {
            $client = Client::find($id);
            return $app['twig']->render('client_edit.html.twig', array('client' => $client));
        });

        $app->patch("/client/{id}", function($id) use ($app) {
            $new_name = $_POST['new_name_client'];
            $client = Client::find($id);
            $client->update($new_name);
            return $app['twig']->render('client_edit.html.twig', array('client' => $client));
        });

        $app->delete("/client/{id}", function($id) use ($app) {
            $client = Client::find($id);
            $client->delete();
            return $app['twig']->render('client_edit.html.twig', array('client' => $client));
        });

        return $app;


 ?>
