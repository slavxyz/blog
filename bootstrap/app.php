<?php
session_start();
require '../vendor/autoload.php';
require '../app/config/config.php';

$app = new Slim\Slim([
    'templates.path' => __DIR__ . '/../resources/views',
    'view' => new \Slim\Views\Twig(__DIR__ . '/../resources/views'),
        ]);

$app->container->singleton('database', function () use ($db){
    $dbConn = new \Db\Connections\MySqlConnection((object) $db['mysql']);
    return $dbConn->getConnection();
});