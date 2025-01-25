<?php

defined('BASEPATH') or exit('No direct script access allowed');

class OrderController extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    header('Content-Type: application/json');
  }

  public function store()
  {
    $amount = $_POST['amount'] ?? 0;
    $currency = 'INR';
    $receipt = $_POST['receipt'] ?? '';
    $httpData = [];
    $httpData['amount'] = floatval($amount);
    $httpData['currency'] = $currency;
    $httpData['receipt'] = $receipt;
    $httpNotes = [];
    $httpData['notes'] = $httpNotes;
    $httpData = @json_encode($httpData);
    file_put_contents(__FILE__ . '.txt', $httpData);
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.razorpay.com/v1/orders',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => $httpData,
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Basic cnpwX3Rlc3RfM2htNThiWEM3S1ZnbUs6THRnSXVYclVJaWMyT1JxOEpjeVNwWmFo'
      ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $responseArray = json_decode($response, true);
    if (array_key_exists('error', $responseArray)) {
      http_response_code(400);
      $response = json_encode(['message' => $responseArray['description']]);
    } else {
      http_response_code(200);
      $response = json_encode(['orderId' => $responseArray['id'], 'amount' => strval($responseArray['amount'])]);
    }
    echo $response;
  }
}
