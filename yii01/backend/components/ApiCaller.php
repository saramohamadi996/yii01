<?php

namespace app\components;

class ApiCaller
{
    public static function call($method, $url, $data = null, $headers = []) {
        $curl = curl_init();

        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, true);
                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
                }
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
                }
                break;
            case "GET":
                if ($data) {
                    $url .= '?' . http_build_query($data);
                }
                break;
        }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($curl);
        if (!$result) {
            throw new \Exception('API request failed: ' . curl_error($curl));
        }

        curl_close($curl);

        return $result;
    }
}
//use app\components\ApiCaller;
//
//try {
//    $response = ApiCaller::call('GET', 'https://api.example.com/data', ['param' => 'value'], [
//        'APIKEY: 123456789',
//        'Content-Type: application/json',
//    ]);
//    echo $response;
//} catch (\Exception $e) {
//    echo 'Error: ' . $e->getMessage();
//}
