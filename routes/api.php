<?php

require_once __DIR__ . '/Router.php';

$request_uri = $_SERVER['REQUEST_URI'];
$request_method = $_SERVER['REQUEST_METHOD'];

$router = new Router;
$router->run($request_uri, $request_method);