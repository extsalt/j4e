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
        $currency = $_POST['currency'] ?? 'INR';
        $receipt = $_POST['receipt'] ?? '';
        $curl = curl_init();
        $httpData = [];
        $httpData['amount'] = floatval($amount);
        $httpData['currency'] = $currecy;
        $httpData['receipt'] = $receipt;
        $httpNotes = [];
        $httpData['notes'] = $httpNotes;
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.razorpay.com/v1/orders',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => @json_encode($httpData),
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Basic cnpwX3Rlc3RfMHg1dEJDMmxuNTVMMm06SG9ib1NVcjB3Z2lES09IZ0tuek9qMzdl'
          ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        file_put_contents(__FILE__ . '.txt', $response);

        echo $response;
    }
}
