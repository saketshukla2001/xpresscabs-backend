<?php

namespace App\Helpers\Payment;

use GuzzleHttp\Client;

class ThawaniPaymentService
{
    private $secretKey;
    private $apiUrl;
    private $client;

    public function __construct()
    {
        $this->secretKey = 'rRQ26GcsZzoEhbrP2HZvLYDbn9C9et';

        $this->apiUrl = 'https://uatcheckout.thawani.om';

        $this->client = new Client([
            'base_uri' => $this->apiUrl,
            'headers' => [
                'Authorization' => "Bearer {$this->secretKey}",
                'Content-Type' => 'application/json',
            ]
        ]);
    }

    public function createSession($amount, $orderId)
    {     


        $user_id = request()->user_id;

        $success_url = env('APP_URL').'thawani-success?user_id='.$user_id.'&amount='.$amount.'&orderId='.$orderId;
        
        $cancel_url = env('APP_URL').'thawani-cancel';


$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://uatcheckout.thawani.om/api/v1/checkout/session",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode([
    'client_reference_id' => '123412',
    'mode' => 'payment',
    'products' => [
        [
                'name' => 'product 1',
                'quantity' => 1,
                'unit_amount' => 100
        ]
    ],
    'success_url' => $success_url,
    'cancel_url' => $cancel_url,
    'metadata' => [
        'Customer name' => 'somename',
        'order id' => 0
    ]
  ]),
  CURLOPT_HTTPHEADER => [
    "Accept: application/json",
    "Content-Type: application/json",
    "thawani-api-key: rRQ26GcsZzoEhbrP2HZvLYDbn9C9et"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
      


return json_decode($response, true);
    
}

}
