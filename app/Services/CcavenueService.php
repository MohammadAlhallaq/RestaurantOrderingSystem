<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class CcavenueService
{
    public function generateUrl($account, $cost)
    {
        $body['merchant_id'] = env('INDIPAY_MERCHANT_ID');
        $body['working_key'] = env('INDIPAY_WORKING_KEY');
        $body['access_code'] = env('INDIPAY_ACCESS_CODE');
        $body['amount'] = $cost;
        $body['redirect_url'] = route('handlePayment');
        $body['cancel_url'] = route('handlePayment');
        $body['billing_name'] = $account->account_name;
        $body['billing_address'] = "Dubai";
        $body['billing_city'] = "Dubai";
        $body['billing_state'] = "Dubai";
        $body['billing_zip'] = "232";
        $body['billing_country'] = "UAE";
        $body['billing_tel'] = str_replace(' ', '', $account->phone_number);
        $body['billing_email'] = $account->email;
        $body['delivery_name'] = "";
        $body['delivery_address'] = "";
        $body['delivery_city'] = "";
        $body['delivery_state'] = "";
        $body['delivery_zip'] = "";
        $body['delivery_country'] = "";
        $body['delivery_tel'] = "";

        $url = "https://payment.allin1uae.com/api/Request.php";

        $postdata = json_encode($body);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $jsonResult = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($jsonResult);

        return $response;
    }

    public function generateRenewUrl($account, $cost)
    {
        $body['merchant_id'] = env('INDIPAY_MERCHANT_ID');
        $body['working_key'] = env('INDIPAY_WORKING_KEY');
        $body['access_code'] = env('INDIPAY_ACCESS_CODE');
        $body['amount'] = $cost;
        $body['redirect_url'] = route('handlePaymentRenew');
        $body['cancel_url'] = route('handlePaymentRenew');
        $body['billing_name'] = $account->account_name;
        $body['billing_address'] = "Dubai";
        $body['billing_city'] = "Dubai";
        $body['billing_state'] = "Dubai";
        $body['billing_zip'] = "232";
        $body['billing_country'] = "UAE";
        $body['billing_tel'] = str_replace(' ', '', $account->phone_number);
        $body['billing_email'] = $account->email;
        $body['delivery_name'] = "";
        $body['delivery_address'] = "";
        $body['delivery_city'] = "";
        $body['delivery_state'] = "";
        $body['delivery_zip'] = "";
        $body['delivery_country'] = "";
        $body['delivery_tel'] = "";

        $url = "https://payment.allin1uae.com/api/Request.php";

        $postdata = json_encode($body);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $jsonResult = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($jsonResult);

        return $response;
    }


    public function checkResponse($body){

        $url = 'https://payment.allin1uae.com/api/Response.php';
        $postdata = json_encode($body);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $jsonResult = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($jsonResult);

        return $response;
    }
}
