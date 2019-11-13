<?php
require '../vendor/autoload.php';

$app = new Slim\Slim([
    'templates.path' => __DIR__.'/../resources/views',
    'view' => new \Slim\Views\Twig(__DIR__.'/../resources/views')
]);