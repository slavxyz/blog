<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require '../bootstrap/app.php';
require '../routes/routes.php';

$app->run();