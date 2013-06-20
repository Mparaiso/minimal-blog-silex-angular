<?php

use Command\GenerateDatabaseCommand;
use Mparaiso\Provider\ConsoleServiceProvider;
use Mparaiso\SimpleRest\Controller\Controller;
use Mparaiso\SimpleRest\Provider\DBALProvider;
use Mparaiso\SimpleRest\Service\Service;
use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\SerializerServiceProvider;
use Silex\Provider\TwigServiceProvider;

/**
 * EN : App Configuration
 * FR : Configuration de l'application
 */
class Config implements \Silex\ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Application $app)
    {

        $app["apiv"] = "1"; // api version
        $app->register(new TwigServiceProvider, array(
            "twig.path"    => __DIR__ . "/Resources/views",
            "twig.options" => array(
                "cache" => __DIR__ . "/../temp/"
            )
        ));

        $app->register(new SerializerServiceProvider);

        $app->register(new MonologServiceProvider, array(
                "monolog.logfile" => __DIR__ . "/../temp/" . date("Y-m-d") . ".txt")
        );

        $app->register(new DoctrineServiceProvider, array(
            "db.options" => array(
                "dbname"   => getenv('NETTUTS_LARAVEL_BACKBONE_DBNAME'),
                "user"     => getenv('NETTUTS_LARAVEL_BACKBONE_USER'),
                "password" => getenv('NETTUTS_LARAVEL_BACKBONE_PASSWORD'),
                "driver"   => getenv('NETTUTS_LARAVEL_BACKBONE_DRIVER'),
                "port"     => getenv('NETTUTS_LARAVEL_BACKBONE_PORT')
            )
        ));
        $app->register(new ConsoleServiceProvider);
        $app["console"] = $app->share(
            $app->extend("console", function ($console, $app) {
                $console->add(new GenerateDatabaseCommand());
                return $console;
            })
        );

        $app["model.post"] = 'Model\Post';
        $app["model.comment"] = 'Model\Comment';

        $app["provider.post"] = $app->share(function ($app) {
            return new DBALProvider($app["db"], array(
                "name"  => "post",
                "model" => $app["model.post"],
                "id"    => "id"
            ));
        });

        $app["service.post"] = $app->share(function ($app) {
            return new Service($app["provider.post"]);
        });

        $app["rest.controller.post"] = $app->share(function ($app) {
            return new Controller(array(
                "resource" => "post",
                "service"  => $app["service.post"],
                "model"    => $app["model.post"],
                "allow"    => array("read", "index", "create")
            ));
        });

        $app["provider.comment"] = $app->share(function ($app) {
            return new DBALProvider($app["db"], array(
                "name"  => "comment",
                "model" => $app["model.comment"],
                "id"    => "id"
            ));
        });

        $app["service.comment"] = $app->share(function ($app) {
            return new Service($app["provider.comment"]);
        });

        $app["rest.controller.comment"] = $app->share(function ($app) {
            return new Controller(array(
                "resource" => "comment",
                "service"  => $app["service.comment"],
                "model"    => $app["model.comment"],
                "allow"    => array("read", "index", "create")
            ));
        });
    }

    /**
     * {@inheritdoc}
     */
    public function boot(Application $app)
    {
        // home page
        $app->get("/", function (Application $app) {
            $content = "content";
            return $app["twig"]->render("index.html.twig", array("content" => $content));
        })->bind("home");

        // mounting controllers
        $app->mount("/api/$app[apiv]", $app["rest.controller.post"]);
        $app->mount("/api/$app[apiv]", $app["rest.controller.comment"]);


    }
}