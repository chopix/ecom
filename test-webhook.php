<?php

$webhookUrl = 'https://app.groupbuyseo.org/webhook/razorpay';
$secret = 'cff309dc64073e812d1c5064dbc0496f'; // Directly use the secret from .env for the test

$data = [
    'event' => 'payment.captured',
    'payload' => [
        'payment' => [
            'entity' => [
                'id' => 'pay_29QQoUBi66xm2f',
                'amount' => 50000,
                'currency' => 'INR',
                'method' => 'card',
                'notes' => [
                    'user_id' => 1,
                    'products' => '1, 2, 3',
                ],
            ],
        ],
    ],
];

$body = json_encode($data);
$signature = hash_hmac('sha256', $body, $secret);

echo "Generated Signature: $signature\n";

$headers = [
    "Content-Type: application/json",
    "X-Razorpay-Signature: $signature",
];

$ch = curl_init($webhookUrl);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);
curl_close($ch);

echo $response;