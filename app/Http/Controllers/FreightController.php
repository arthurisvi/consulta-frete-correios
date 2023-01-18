<?php

require_once __DIR__ . '/../../Services/CorreiosService.php';

class FreightController {

  public function calculate() {
    $request_data = json_decode(file_get_contents('php://input'));

    $freight = CorreiosService::calculateShipping($request_data);

    echo json_encode($freight);
  }

}