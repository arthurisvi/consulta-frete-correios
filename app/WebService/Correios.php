<?php

// namespace App\WebService;

class Correios {

  const BASE_URL = 'http://ws.correios.com.br';

  const SEDEX_SERVICE = '04014';
  const SEDEX_12_SERVICE = '04782';
  const SEDEX_10_SERVICE = '04790';
  const SEDEX_TODAY_SERVICE = '04804';
  const PAC_SERVICE = '04510';

  const PACKAGE_CX_FORMAT = 1;
  const ROLL_PRISM_FORMAT = 2;
  const ENVELOPE_FORMAT = 3;

  private $company_code;
  private $company_password;

  public function __construct($company_code = '', $company_password = ''){
    $this->company_code = $company_code;
    $this->company_password = $company_password;
  }

  public function calculateShipping(
    $service_code, 
    $origin_cep, 
    $destination_cep,
    $weight, 
    $format, 
    $height, 
    $width, 
    $length, 
    $diameter = 0, 
    $own_hand = false,
    $declared_value = 0,
    $receipt = 0){

    $params = [
      'nCdEmpresa' => $this->company_code,
      'sDsSenha' => $this->company_password,
      'nCdServico' => $service_code,
      'sCepOrigem' => $origin_cep,
      'sCepDestino' => $destination_cep,
      'nVlPeso' => $weight,
      'nCdFormato' => $format,
      'nVlComprimento' => $length,
      'nVlAltura' => $height,
      'nVlLargura' => $width,
      'nVlDiametro' => $diameter,
      'sCdMaoPropria' => $own_hand ? 'S' : 'N',
      'nVlValorDeclarado' => $declared_value,
      'sCdAvisoRecebimento' => $receipt ? 'S' : 'N',
      'StrRetorno' => 'xml'
    ];

    $query = http_build_query($params);

    $result = $this->get('/calculador/CalcPrecoPrazo.aspx?' . $query);

    return $result ? $result->cServico : null;
  }

  public function get($resource){
    $url = self::BASE_URL . $resource;

    $curl = curl_init();

    curl_setopt_array($curl, [
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_CUSTOMREQUEST => 'GET',
    ]);

    $response= curl_exec ($curl);
    curl_close($curl);

    return strlen($response) ? simplexml_load_string($response) : null;  
  }

}