<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;
class PixelController extends Controller
{
    public function sendPurchaseEvent($purchase_vale = null): JsonResponse
    {
        $pixelId = '1004193577377838';
        $apiVersion = 'v12.0';
        $cairoTimeStamp = Carbon::now('Africa/Cairo')->timestamp;

        $cairoTime = Carbon::now('Africa/Cairo');
        $sevenDaysAgo = $cairoTime->subDays(7);
        $cairoTime = $sevenDaysAgo->timestamp;

        if($purchase_vale == null) {
            $purchase_vale = '250';
        } else {
            $purchase_vale = $purchase_vale;
        }

        $eventData = [
            "data" => [
                [
                    "event_name" => "Purchase",
                    "event_time" => $cairoTime, // Replace with the actual timestamp
                    "action_source" => "website",
                    "user_data" => [
                        "em" => [
                            "7b17fb0bd173f625b58636fb796407c22b3d16fc78302d79f0fd30c2fc2fc068"
                        ],
                        "ph" => [null]
                    ],
                    "custom_data" => [
                        "currency" => "EGP",
                        "value" => $purchase_vale // Replace with the actual purchase value
                    ]
                ]
            ]
        ];

        $accessToken = 'EAAWn6kx9FPwBO22rYM5NZC7aj5NPhbG3XGGPyjVUlvsXpQFRAtsmAmhWof8bA5KmfdHwi7YVHbpRvn2rhZCAy1BFlVS4psmSIrW55e7T1juHOl4iR5QRBLwz7r0GPhxEEuZCP37bPdBpND6G3bq3aS5b1ZBI632TZAp308yaA8F5Jl1XtVFZC5S3oPjIyWFgffQQZDZD'; // You need a Facebook access token

        $url = "https://graph.facebook.com/{$apiVersion}/{$pixelId}/events?access_token={$accessToken}";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($eventData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $response = curl_exec($ch);
        curl_close($ch);

        // You can handle the response as needed (e.g., error checking).
        return response()->json(['message' => 'Purchase event sent to Facebook.']);
    }


}
