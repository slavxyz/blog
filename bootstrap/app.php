<?php

session_start();
require '../vendor/autoload.php';
require '../app/config/config.php';

$app = new \Slim\Slim(array(
    'templates.path' => '/var/www/html/blog/resources/views/',
    'view' => new Slim\Views\Twig('/var/www/html/blog/resources/views/')
));
$view = $app->view();

$view->parserOptions = array(
    'debug' => true,
    'cache' => false
);
$view->parserDirectory = 'Twig';

$view->parserExtensions = array(
    new \Slim\Views\TwigExtension(),
);

$app->container->singleton('database', function () use ($db) {
    $dbConn = new \Db\Connections\MySqlConnection((object) $db['mysql']);
    return $dbConn->getConnection();
});