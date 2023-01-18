
<?php

require_once __DIR__ . '/../app/Http/Controllers/FreightController.php';

abstract class RouteSwitch
{

  private $freightController;

  public function __construct(){
    $this->freightController = new FreightController();
  }

  protected function freight($method, $route)
  {

    if($method === "POST"){
      if($route === "calculate"){
        $this->freightController->calculate();
      }else{
        http_response_code(404);
      }
    }else{
      http_response_code(405);
    }
  }

  public function __call($name, $arguments)
  {
    http_response_code(404);
  }
}
