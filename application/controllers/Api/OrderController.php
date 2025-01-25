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
  CURLOPT_POSTFIELDS =>'{
  "amount": 900,
  "currency": "INR",
  "receipt": "Receipt no. 2",
  "notes": {
    "notes_key_1": "Tea, Earl Grey, Hot",
    "notes_key_2": "Tea, Earl Grey… decaf."
  }
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Basic cnpwX3Rlc3RfM2htNThiWEM3S1ZnbUs6THRnSXVYclVJaWMyT1JxOEpjeVNwWmFo'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

      
    }
}
