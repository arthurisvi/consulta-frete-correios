<?php

// namespace App\WebService;

class CorreiosService {

  const BASE_URL = 'http://ws.correios.com.br';

  public static function calculateShipping($data){

    $params = [
      'nCdEmpresa' => $data->company_code,
      'sDsSenha' => $data->company_password,
      'nCdServico' => $data->service_code,
      'sCepOrigem' => $data->origin_cep,
      'sCepDestino' => $data->destination_cep,
      'nVlPeso' => $data->weight,
      'nCdFormato' => $data->format,
      'nVlComprimento' => $data->length,
      'nVlAltura' => $data->height,
      'nVlLargura' => $data->width,
      'nVlDiametro' => $data->diameter,
      'sCdMaoPropria' => $data->own_hand ? 'S' : 'N',
      'nVlValorDeclarado' => $data->declared_value,
      'sCdAvisoRecebimento' => $data->receipt ? 'S' : 'N',
      'StrRetorno' => 'xml'
    ];

    $query = http_build_query($params);

    $result = self::get('/calculador/CalcPrecoPrazo.aspx?' . $query);

    return $result ? $result->cServico : null;
  }

  public static function get($resource){
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