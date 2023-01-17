<?php

require 'vendor/autoload.php';
require './app/Services/CorreiosService.php';
// use App\WebService\Correios;

$correios = new CorreiosService();

$shipping = $correios->calculateShipping(
  CorreiosService::SEDEX_SERVICE, // service code
  '09010100', // origin cep
  '31845010', // destination cep
  2, // weight
  CorreiosService::PACKAGE_CX_FORMAT, // format
  15, // height
  15, // width
  15, // length
  0, // diameter
  false, // own hand
  0, // declared value
  0 // receipt
);

print_r($shipping);