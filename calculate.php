<?php

require 'vendor/autoload.php';
require './app/WebService/Correios.php';
// use App\WebService\Correios;

$correios = new Correios();

$shipping = $correios->calculateShipping(
  Correios::SEDEX_SERVICE, // service code
  '09010100', // origin cep
  '31845010', // destination cep
  2, // weight
  Correios::PACKAGE_CX_FORMAT, // format
  15, // height
  15, // width
  15, // length
  0, // diameter
  false, // own hand
  0, // declared value
  0 // receipt
);

print_r($shipping);