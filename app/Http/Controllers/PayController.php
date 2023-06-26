<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PayController
{
    const HOST_URL = "https://test.allinpayhk.com/gateway/cnp/quickpay";
    const VERSION = "V2.0.0";
    const SIGN_TYPE = "RSA2";
    const PUBLIC_KEY = "-----BEGIN PUBLIC KEY-----\nMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAsNGWmxYl6uYA/X3k1OOYnMlLvmgJpYMvahxDLUc9CEXbaqMoMMuLbsvfR6Zf3JIeYCjjfgNVDJTsJY/HWWbpHEd4GvQAgv6wywsQ8AJqIHe3fM3B8iwS3XIxZM9fs92lU+mHuVHQdMvciQyaB3iw3IvBBzCEgyqSFcGBrlQOGf1x7fZZKY9RH3EDxqzE+Zrs27BjE8T3sNvUCKcfWGhQGKX80jcqLEnFBl9CIlgL4TRSksQ1U4GhOY0/4Db6UsmbTAQeG2plWgbJ0l0khJ2ODYqTtDujl4zN3tGXQ2gwCErxqBbukIFMkT+jS1lxrBeGGrvuOXTz408tDbAsJnbUYwIDAQAB\n-----END PUBLIC KEY-----";
    const MERCHANT_ID = "852999958120566";
    const PRIVATE_KEY = "-----BEGIN RSA PRIVATE KEY-----\nMIIEpAIBAAKCAQEA1snjaOc1LRYlfYZ+17FiUYPsjF/aQJSaw5/19OlQv+n6tE/R8xY6yArnJm3v5XKTHhRmKRgbAGrVvhA5ivs7FebxaefoG3+53l/vYivHISICf3jPYy8F6mTzzd2IIl+udNvBbAijAJpc7wOZNTwKgl0emggjU8n23ya3Azxtx0IHrBoEa/+CnPFV6t8t8yjhWbG0BB8eXfHyuVKEZOSvoNF54OKXz2U3BAUNlTybJw9eCWXiYL04G90vhAMgSSEiullKb8fckwAknqDhd/144uhjfTMRFNNEcxd9aL3dhJ6T2+YDmgpaOHWBeMlPTzlzVbPRwwNQVVmlFPKN2+fzOwIDAQABAoIBAEJpmk9NbjvKpTzy4TWAO45I5FNjL/DYAiKKy1o26ijtB//IznoDXZmNBXv0ckDX9HVQiWYbdf3jCsQB8Ejw9YwIJI1Cj5oxHB+OOk54itHL2knf6QAaAhI/tMLqxLUcMK0hZeUppn0BPcsJqc20CuvULyohagr2X8cQCXaOsMLzLqUDrrRojIiNaFE8aaY5hbpcVoWCq7fgjdsTALr3NJ7u3uhcjT4Aa1Oc9I22sPgezkaHjRex7AfEy48yaGC7d9u03xsxH/QRDeeij0hy7PVTO6LnsbqO9oPzDN/+U2Bs8BOCi0nkwv7HS7as2z7hDNSDLjd58kQApnmV0y5/WgECgYEA8mATGTgB449uFkXqq9LDP9WJBkusoaUV78BjM/7vqjyOLCFEdTxtDdPQukjWDfDsN6a9Tqp6/xIAiZS5Mc6HHYGn4l5KNTULkrs63H/aawuH1lraE1yn8HPmV4YcTmxA7DPEz3UvcYOXUtas5SZF4i8KVK4moOjdnE5Npm3D+1sCgYEA4tzTOiJqJ3pWD6e5pse42/v/OvzAslseCUsxD1ZkziHRh98BaX14zRD4scLo8XvgKdr0VKgFVYSLpv76zWQD7hZ5E8dONtCnBwPVtf+wYIKUlo6MEmjS4cFrwX0E9xuYkewDTahXXEf9rula80Jdo61IIKx1eZTfwUtKFitNzaECgYAJSGCy4JBB9OZUeA0K06GiujzrPs63yijS691gymzHalZPnl6O1ueeVfRyjgOUuRty7jHl52Wai0f1/PoyzCQknyic5NuWuhddYUpZ05O78c8cCJK9lxjffrDdvUcsQb0izsDE6UoN4OpUw+APTq3ygba1k43rL7/9Eoqqyx1sbQKBgQCkpprTjZi38E037YaLqlbbqmiSmlEM4Z7KJf2EYTKmfNsDHvJ6aqtbQh8NfSXt5fdKyXQdYRkF+T4WROcoXJeRnFPh6/wzQnqHV9wqzFlpojxPjUPSNKwhV21qr98Drc6s0buQCEbnXgSbhxgQh7FIkwJPXHuic092jbtGncVJIQKBgQDKKWcpMKU//nd7T3RfYVyoCpJL1xW58XNFAWbdV1+m59ECujETG5hh416QIaFFWDc3OfO7Ye24acR/Z44MzYt+EFCso1YM2v6Pn+Q1Jr1FYWb+UIobXbPYUnNi1E7gRKYj+cQ8IsyXCoJ1Hw52hNdUsFZ6BfLu8YP3VyTRpNLxow==\n-----END RSA PRIVATE KEY-----";

    // CARD-VISA
    const CARD_HOLDER = "Peter";
    const CARD_NUMBER = "4761340000000076";
    const CARD_EXPIRY_MONTH = "12";
    const CARD_EXPIRY_YEAR = "2027";
    const CARD_CVV = "705";


    const Y4M2D2H2M2S2 = "YmdHis";

    public function index(Request $request)
    {
        $uid = $request->input('uid');
        if (!$uid) {
            return abort("404");
        }
        $info = Product::where('uid', $uid)->first();
        return view('welcome', compact('info'));
    }

    public function pay(Request $request)
    {
        $post = $request->all();
        $params = $this->cnpSaleTestsJump($post);
//        $params = $this->cnpSaleTestsDirect('HKD', '5');

        $rsp = self::request(self::HOST_URL, $params);
//        echo "response data: " . $rsp;
//        echo PHP_EOL;
        $rspArray = json_decode($rsp, true);
//        $resultCode = $rspArray['resultCode'];
//        echo "resultCode: " . $resultCode;
//        echo PHP_EOL;
//        $resultDesc = $rspArray['resultDesc'];
//        echo "resultDesc: " . $resultDesc;
//        echo PHP_EOL;
        // valid response data
//        self::validSign($rspArray);
//        if (self::validSign($rspArray)) {
////            dd($rspArray['payUrl']);
//            return redirect($rspArray['payUrl']);
//        }

        $data = [
            'status' => false,
            'msg' => '',
            'pay_url' => '',
        ];
        if ($rspArray['resultCode'] == "0000") {
            if (self::validSign($rspArray)) {
                Order::create([
                    'order_sn' => $params['accessOrderId'],
                    'product_id' => $post['product_id'],
                    'name' => $post['product_name'],
                    'pic' => $post['pic'],
                    'num' => $post['product_num'],
                    'money_type' => $post['money_type'],
                    'money' => $post['money'],
                    'first_name' => $post['first_name'],
                    'last_name' => $post['last_name'],
                    'mobile' => $post['mobile'],
                    'address' => $post['address'],
                    'status' => 0,
                ]);
                $data['status'] = true;
                $data['pay_url'] = $rspArray['payUrl'];
                $data['msg'] = $rspArray['resultDesc'];
            }
        } else {
            $data['msg'] = $rspArray['resultDesc'];
        }
        return response()->json($data);
    }

    public function notify(Request $request)
    {
        Log::info($request->all());
//        return $request->all();
    }

    public function success()
    {
        return view('success');
    }

    public static function accessTime()
    {
        date_default_timezone_set("PRC");
        return date(self::Y4M2D2H2M2S2, time());
    }

    public static function signSHA256RSA(array $array)
    {
        ksort($array);
        $preSign = self::toUrlParams($array, false);
//        echo "request data to be signed: [" . $preSign . "]";
//        echo PHP_EOL;
        $privateKeyId = openssl_pkey_get_private(self::PRIVATE_KEY);
        $encrypted = "";
        openssl_sign($preSign, $encrypted, $privateKeyId, OPENSSL_ALGO_SHA256);
        openssl_free_key($privateKeyId);
        $encrypted = base64_encode($encrypted);
//        echo "private key encrypt data: [" . $encrypted . "]";
//        echo PHP_EOL;
        return $encrypted;
    }

    public static function toUrlParams(array $array, $isUrlEncode)
    {
        $buff = "";
        foreach ($array as $k => $v) {
            if ($v != "" && !is_array($v)) {
                $buff .= $k . "=";
                if ($isUrlEncode) {
                    $buff .= urlencode($v);
                } else {
                    $buff .= $v;
                }
                $buff .= "&";
            }
        }

        $buff = trim($buff, "&");
        return $buff;
    }

    public static function request($url, array $array)
    {
        // url encode request data
        $paramsStr = self::toUrlParams($array, true);
//        echo "request url: [" . $url . "]";
//        echo PHP_EOL;
//        echo "request param: [" . $paramsStr . "]";
//        echo PHP_EOL;
        $ch = curl_init();
        $this_header = array("content-type: application/x-www-form-urlencoded;charset=UTF-8");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this_header);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $paramsStr);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

        $output = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
//        echo "http code: " . $httpCode;
//        echo PHP_EOL;
        return $output;
    }

    public static function validSign(array $array)
    {
        $sign = $array['sign'];
        unset($array['sign']);
        $publicKeyId = openssl_get_publickey(self::PUBLIC_KEY);
        ksort($array);
        $preSign = self::toUrlParams($array, false);
//        echo "response data to be signed:[" . $preSign . "]";
//        echo PHP_EOL;
        $ok = openssl_verify($preSign, base64_decode($sign), $publicKeyId, OPENSSL_ALGO_SHA256);
        openssl_free_key($publicKeyId);
        $ok = $ok == 1 ? true : false;
//        echo "valid response sign result: ";
//        echo $ok ? "success" : "fail";
        return $ok;
    }

    protected function cnpSaleTestsJump($data = array())
    {
        $params = array();
        $params["panIsPaste"] = "1";
        $params["version"] = self::VERSION;
        $params["mchtId"] = self::MERCHANT_ID;
        $params["transType"] = "Pay";
        if ($data['money_type'] == 'USD') {
            $params["language"] = "en";
        } else {
            $params["language"] = "zh-hant";
        }
        $params["currency"] = $data['money_type'];
        $params["amount"] = $data['money'];
//        $params["productInfo"] = $this->getProductInfo();
        $product_info = [
            [
                'sku' => $data['uid'],
                'productName' => $data['product_name'],
                'price' => $data['money'],
                'quantity' => $data['product_num'],
            ]
        ];
        $params["productInfo"] = json_encode($product_info);
        $params["shippingFirstName"] = $data['first_name'];
        $params["shippingLastName"] = $data['last_name'];
        $params["shippingAddress1"] = $data['address'];
        $params["shippingCity"] = "shagnhai";
        $params["shippingCountry"] = "CN";
        $params["shippingState"] = "shagnhai";
        $params["shippingZipCode"] = "440000";
        $params["shippingPhone"] = $data['mobile'];
        $params["billingPhone"] = $data['mobile'];
        $params["notifyUrl"] = "https://www.twhealth.top/notify";
        $params["returnUrl"] = "https://www.twhealth.top/success";
//        $params["accessTime"] = self::accessTime();
//        $params["email"] = "961836760@qq.com";
//        $params["email"] = "";
//        $params["billingFirstName"] = "杰伦";
//        $params["billingLastName"] = "周";
//        $params["billingAddress1"] = "广东省广州市测试 测试 测试测试 测试 测试*";
//        $params["billingCity"] = "shagnhai";
//        $params["billingCountry"] = "CN";
//        $params["billingState"] = "shanghai";
//        $params["billingZipCode"] = "440000";
        $params["accessOrderId"] = time() . rand(0000, 9999);
        $params["signType"] = self::SIGN_TYPE;
//        $params["bizreserve"] = "test";
        $params["sign"] = self::signSHA256RSA($params);
        return $params;
    }

    protected function getDmInf()
    {
        $dmInf = array();
        $dmInf["MerchantType"] = "RETAILS";
        $dmInf["3DSFlag"] = "YES";
        $dmInf["OrderChannel"] = "WEBSITE";
        $dmInf["BuyerName"] = "Peter";
        $dmInf["AccountAge"] = "";
        return json_encode($dmInf);
    }

    protected function cnpSaleTestsDirect($currency, $amount)
    {
        $params = array();
        $params["version"] = self::VERSION;
        $params["mchtId"] = self::MERCHANT_ID;
        $params["transType"] = "QuickPay";
        $params["accessTime"] = self::accessTime();
        $params["currency"] = $currency;
        $params["amount"] = $amount;
        $params["language"] = "zh";
        $params["email"] = "961836760@qq.com";

        $params["cardHolder"] = self::CARD_HOLDER;
        $params["acctNo"] = self::CARD_NUMBER;
        $params["expiryMonth"] = self::CARD_EXPIRY_MONTH;
        $params["expiryYear"] = self::CARD_EXPIRY_YEAR;
        $params["acctCvv"] = self::CARD_CVV;

        $params["productInfo"] = $this->getProductInfo();
        $params["shippingFirstName"] = "Peter 三";
        $params["shippingLastName"] = "zh张";
        $params["shippingAddress1"] = "广东省广州市测试 测试 测试测试 测试 测试*";
        $params["shippingCity"] = "shanghai";
        $params["shippingState"] = "iai";
        $params["shippingCountry"] = "US";
        $params["shippingZipCode"] = "440000";
        $params["shippingPhone"] = "1231230080";

        $params["billingFirstName"] = "杰伦";
        $params["billingLastName"] = "周";
        $params["billingAddress1"] = "广东省广州市测试";
        $params["billingCity"] = "shagnhai";
        $params["billingState"] = "shanghai";
        $params["billingCountry"] = "CN";
        $params["billingZipCode"] = "440000";
        $params["billingPhone"] = "1231230080";

        $params["userAgent"] = "360Brower";
        $params["ipAddress"] = "120.0.0.1";
        $params["panIsPaste"] = "0";

        $params["accessOrderId"] = time() . rand(0000, 9999);

        // 3DS way
        $params["securityMode"] = "3DS";
        $params["dmInf"] = $this->getDmInf();

        $params["signType"] = self::SIGN_TYPE;
        // sign request data
        $params["sign"] = self::signSHA256RSA($params);

        return $params;
    }

    protected function getProductInfo()
    {
        return
            "[{\"sku\":\"123121\",\"productName\":\"test测试\", \"price\":\"113.9989\", \"quantity\":\"800\", \"productImage\":\"imageUrl\",\"productUrl\":\"goodsUrl\"},"
            . "{\"sku\":\"123122\",\"productName\":\"test测试1\", \"price\":\"114.99\", \"quantity\":\"800\", \"productImage\":\"imageUrl\",\"productUrl\":\"goodsUrl\"},"
            . "{\"sku\":\"123123\",\"productName\":\"test测试2\", \"price\":\"115.99\", \"quantity\":\"800\", \"productImage\":\"imageUrl\",\"productUrl\":\"goodsUrl\"},"
            . "{\"sku\":\"123124\",\"productName\":\"test测试3\", \"price\":\"116.99\", \"quantity\":\"800\", \"productImage\":\"imageUrl\",\"productUrl\":\"goodsUrl\"}]";
    }
}
