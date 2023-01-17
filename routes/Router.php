<?php

require_once __DIR__ . '/RouteSwitch.php';

class Router extends RouteSwitch
{
  public function run(string $requestUri, string $http_method)
  {
    $endpoint = explode("/", $requestUri);
    $route_group = $endpoint[1];
    $route = implode("/", array_slice($endpoint, 2));
    
    $this->$route_group($http_method, $route);
  }
}
