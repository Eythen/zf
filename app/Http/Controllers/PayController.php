<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PayController
{
    const HOST_URL = "https://oats.allinpay.com/gateway/cnp/quickpay";
    const WX_HOST_URL = "https://oats.allinpay.com/gateway/pay/consumeTrans";

    const ACCESS_CODE = '85200764';

    const VERSION = "V2.0.0";
    const SIGN_TYPE = "RSA2";
//    const PUBLIC_KEY = "-----BEGIN PUBLIC KEY-----\nMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAsNGWmxYl6uYA/X3k1OOYnMlLvmgJpYMvahxDLUc9CEXbaqMoMMuLbsvfR6Zf3JIeYCjjfgNVDJTsJY/HWWbpHEd4GvQAgv6wywsQ8AJqIHe3fM3B8iwS3XIxZM9fs92lU+mHuVHQdMvciQyaB3iw3IvBBzCEgyqSFcGBrlQOGf1x7fZZKY9RH3EDxqzE+Zrs27BjE8T3sNvUCKcfWGhQGKX80jcqLEnFBl9CIlgL4TRSksQ1U4GhOY0/4Db6UsmbTAQeG2plWgbJ0l0khJ2ODYqTtDujl4zN3tGXQ2gwCErxqBbukIFMkT+jS1lxrBeGGrvuOXTz408tDbAsJnbUYwIDAQAB\n-----END PUBLIC KEY-----";
    const PUBLIC_KEY = "-----BEGIN PUBLIC KEY-----\nMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA2LJVX+qtHD6w2Blyj083kODSzVzhkr5MueyfBZg8sGk32VlUYGlhyWtWEHxsmXv/4hTOB+CdLhbHWNLTB3U4ucLCttuk8aL24xBzhuMkYeYzEEAr5NHLFdPD8sDHO5IkIsQWqibfx8KZaTIWSEplm0Dds82Bg6sUFkuKOofP2lbU3DakZevfOzCVYxgpQ9MwvXhqptgz69Dm0x7PEbXkvXZjVV2cS31C31NTGsw4eplETzU1dQNDMzexFt1aNJok8cqlmhZKUd7dZ4uHu5zVfa1IkCx6UqvvWbWAsyus++CUKFX4PzXV+bpO/cbBozecjRWVy6AHmxB+XsEfAytuAwIDAQAB\n-----END PUBLIC KEY-----";
//    const MERCHANT_ID = "852999958120566";
    const MERCHANT_ID = "852999954993290";
//    const PRIVATE_KEY = "-----BEGIN RSA PRIVATE KEY-----\nMIIEpAIBAAKCAQEA1snjaOc1LRYlfYZ+17FiUYPsjF/aQJSaw5/19OlQv+n6tE/R8xY6yArnJm3v5XKTHhRmKRgbAGrVvhA5ivs7FebxaefoG3+53l/vYivHISICf3jPYy8F6mTzzd2IIl+udNvBbAijAJpc7wOZNTwKgl0emggjU8n23ya3Azxtx0IHrBoEa/+CnPFV6t8t8yjhWbG0BB8eXfHyuVKEZOSvoNF54OKXz2U3BAUNlTybJw9eCWXiYL04G90vhAMgSSEiullKb8fckwAknqDhd/144uhjfTMRFNNEcxd9aL3dhJ6T2+YDmgpaOHWBeMlPTzlzVbPRwwNQVVmlFPKN2+fzOwIDAQABAoIBAEJpmk9NbjvKpTzy4TWAO45I5FNjL/DYAiKKy1o26ijtB//IznoDXZmNBXv0ckDX9HVQiWYbdf3jCsQB8Ejw9YwIJI1Cj5oxHB+OOk54itHL2knf6QAaAhI/tMLqxLUcMK0hZeUppn0BPcsJqc20CuvULyohagr2X8cQCXaOsMLzLqUDrrRojIiNaFE8aaY5hbpcVoWCq7fgjdsTALr3NJ7u3uhcjT4Aa1Oc9I22sPgezkaHjRex7AfEy48yaGC7d9u03xsxH/QRDeeij0hy7PVTO6LnsbqO9oPzDN/+U2Bs8BOCi0nkwv7HS7as2z7hDNSDLjd58kQApnmV0y5/WgECgYEA8mATGTgB449uFkXqq9LDP9WJBkusoaUV78BjM/7vqjyOLCFEdTxtDdPQukjWDfDsN6a9Tqp6/xIAiZS5Mc6HHYGn4l5KNTULkrs63H/aawuH1lraE1yn8HPmV4YcTmxA7DPEz3UvcYOXUtas5SZF4i8KVK4moOjdnE5Npm3D+1sCgYEA4tzTOiJqJ3pWD6e5pse42/v/OvzAslseCUsxD1ZkziHRh98BaX14zRD4scLo8XvgKdr0VKgFVYSLpv76zWQD7hZ5E8dONtCnBwPVtf+wYIKUlo6MEmjS4cFrwX0E9xuYkewDTahXXEf9rula80Jdo61IIKx1eZTfwUtKFitNzaECgYAJSGCy4JBB9OZUeA0K06GiujzrPs63yijS691gymzHalZPnl6O1ueeVfRyjgOUuRty7jHl52Wai0f1/PoyzCQknyic5NuWuhddYUpZ05O78c8cCJK9lxjffrDdvUcsQb0izsDE6UoN4OpUw+APTq3ygba1k43rL7/9Eoqqyx1sbQKBgQCkpprTjZi38E037YaLqlbbqmiSmlEM4Z7KJf2EYTKmfNsDHvJ6aqtbQh8NfSXt5fdKyXQdYRkF+T4WROcoXJeRnFPh6/wzQnqHV9wqzFlpojxPjUPSNKwhV21qr98Drc6s0buQCEbnXgSbhxgQh7FIkwJPXHuic092jbtGncVJIQKBgQDKKWcpMKU//nd7T3RfYVyoCpJL1xW58XNFAWbdV1+m59ECujETG5hh416QIaFFWDc3OfO7Ye24acR/Z44MzYt+EFCso1YM2v6Pn+Q1Jr1FYWb+UIobXbPYUnNi1E7gRKYj+cQ8IsyXCoJ1Hw52hNdUsFZ6BfLu8YP3VyTRpNLxow==\n-----END RSA PRIVATE KEY-----";
    const PRIVATE_KEY = "-----BEGIN RSA PRIVATE KEY-----\nMIIEowIBAAKCAQEA2JDstCInrxoEpJ19ZO4wrTAKoc5VvVhjQtRUbzu+DRaqTtzA3HLxmXfKLggUsE5VgOuWi24OR3A+F1jZMS2LVcmtqqjzRJoiLLaD+qYgk4L0u8EvjpzHKrBz3qSK4uu3roRwgqpSPyENOgvbeVxYYARrjQ69hP9uMsC1AZcDdzT0nnM5myy7xlzfwQeUxHyg2WSvKtwiBr7vQ8Y8+tI/6SCzCOj0zgCyOqHXb8Y+IG+H4WbdSzaE27qSKkJ17YsFTwtNbeJ+td6Zstxp589d3ewgl8VBNzrOrY/ihttmNYPjjXBj+eHiD+bb8FAQvFQP0u8g7hpNpEuWTx2a9PJxdwIDAQABAoIBACD+y6GSRpuOCkEOYal8BNyOIkCO0E9d5RmsggTEhGs4FdCYH6Y2uQqZzqr+vjAybyKKQlCR/wjxV/R0q/qrJrx2Ushan13HYgeP80HAB9yRqjnk8Br5VfryEWVNin+STFUBhqbRzmAh6AL9BX5TDH/sjHpcUZGu3RpMdAd++58woX0EfWlaTMfqtAg1fvn47YqHwomKqQe8EjRhV/G/aUk396YLXVG6RzyJ4sAyP7DmQ5iK8iAhCk2LxZ45wCk/PivjT4w3KI2IEnRyKrpLTQmgR56lwgkzTyxyn1AnKqwvps7XVNI8bz7IWQIXvihrbREB+GZRWE3iI7405tE5xNECgYEA9A3mqEekiEwtT49YcrxisftHwIXOo/6Wjtr19e+F4PrjyBFIS94TT25AkPJm5Jm58HsqPlehuZwKRacX6zHrqC0hn0At8sFxqa+Xxm24rNGXZ+c1LQfZoIv9lGT3P1UyxK56LlpZKihzUGysaZuhC0fflz/mPG2d4mWvfqkF91kCgYEA4yqV45qpF4ALahJq08v0t/A0v6RHStjt2HZ2/v9rKWgxkDuEk5P48yXHNNkvDLw3y+LgiTvaDtelWNgzEdJuLbKuSmFSsM4hnLM8C5U2oOxnJjGDuq6qa3BdHI2pue3sLqA/G7a69Rj4OrdVMVcqgZIizrerp5pZduIobLINZU8CgYB2E/OxH1h/iTuy7ovAl1y49/ZzM0oTFi4J1+6Amu6PN1PVjGcKLdvx5kne1yjpGWdY7n41w3g/sTtXD80GwhRePdeykP6qIOW5T3eDTbq4An/aiYa0zsOAZbq+fUsSnUn+1tvOaXAScZe5JZsVTXLRXmjTaNsgCXkF/GS4R1bXoQKBgQCpQYuYoB2o0tCuYbaSw/48Jo9G0uIDlInypKGY8TopCecT7iSjyLbOg7FfYQq7VGnGUe62kY+xS195SO0UNFO/XMibxtPTxGIq3Si6AJ1JXZqlTHM33vg/QOM/aRWy4OD/BIrA3W+DOu2I4hxpvOaA0B97IkKViF1sRKmWAzwT5QKBgDH/Xrdlcvtrws3gb4pMlpwt0j+heSPu89hCwFZJ4B1RkN80v3UaVu+1o56YOgsmVM5OyK8GnpnY0uLaSKuPRBTPUwTSKLKkrutaOnPI01geGoG7xQfpjgKf/9mDLOStHeaInWsTbYgyPM3T+A6dsC/xv/wIUEv0+LGN/P0+jeKW\n-----END RSA PRIVATE KEY-----";

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
        $isMobile = $this->isMobile();
        if ($isMobile) {
            return view('h5', compact('info'));
        } else {
            return view('pc', compact('info'));

        }
    }

    public function isMobile()
    {
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset ($_SERVER['HTTP_X_WAP_PROFILE'])) {
            return TRUE;
        }

        // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        if (isset ($_SERVER['HTTP_VIA'])) {
            return stristr($_SERVER['HTTP_VIA'], "wap") ? TRUE : FALSE;// 找不到为flase,否则为TRUE
        }

        // 判断手机发送的客户端标志,兼容性有待提高
        if (isset ($_SERVER['HTTP_USER_AGENT'])) {
            $clientkeywords = array(
                'mobile',
                'nokia',
                'sony',
                'ericsson',
                'mot',
                'samsung',
                'htc',
                'sgh',
                'lg',
                'sharp',
                'sie-',
                'philips',
                'panasonic',
                'alcatel',
                'lenovo',
                'iphone',
                'ipod',
                'blackberry',
                'meizu',
                'android',
                'netfront',
                'symbian',
                'ucweb',
                'windowsce',
                'palm',
                'operamini',
                'operamobi',
                'openwave',
                'nexusone',
                'cldc',
                'midp',
                'wap'
            );

            // 从HTTP_USER_AGENT中查找手机浏览器的关键字
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
                return TRUE;
            }
        }

        if (isset ($_SERVER['HTTP_ACCEPT'])) { // 协议法，因为有可能不准确，放到最后判断
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== FALSE) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === FALSE || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
                return TRUE;
            }
        }

        return FALSE;

    }

    public function pay(Request $request)
    {
        $post = $request->all();
        if (!$post['payment']) {
            $data = [
                'status' => false,
                'msg' => '支付方式必填（Payment method is required）',
                'pay_url' => '',
            ];
            return response()->json($data);
        }

        $data = [
            'status' => false,
            'msg' => '',
            'pay_url' => '',
        ];
        if ($post['payment'] == 1) {
            $params = $this->cnpSaleTestsJump($post);
            $rsp = self::request(self::HOST_URL, $params);
            $rspArray = json_decode($rsp, true);

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
                        'payment' => $post['payment'],
                    ]);
                    $data['status'] = true;
                    $data['pay_url'] = $rspArray['payUrl'];
                    $data['msg'] = $rspArray['resultDesc'];
                }
            } else {
                $data['msg'] = $rspArray['resultDesc'];
            }

        } else {
            $params = $this->wxOrderPay($post);

            $rsp = self::request(self::WX_HOST_URL, $params);
            $rspArray = json_decode($rsp, true);

            if ($rspArray['returnCode'] == "0000" && key_exists('payInfo', $rspArray)) {
//                if (self::validSign($rspArray)) {
                Order::create([
                    'order_sn' => $params['outTransNo'],
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
                    'payment' => $post['payment'],
                ]);
                $data['status'] = true;
                $data['pay_url'] = $rspArray['payInfo'];
                $data['msg'] = $rspArray['resultMsg'];
//                }
            } else {
                $data['msg'] = $rspArray['resultMsg'];
            }
        }

        return response()->json($data);
    }

    function wxOrderPay($data = array())
    {
        $params = array();
        $params["requestNo"] = time();
        $params["version"] = self::VERSION;
        $params["accessCode"] = self::ACCESS_CODE;
        $params["transType"] = "WXPAY_BRANCH_MP";
        $params["signType"] = self::SIGN_TYPE;
        $params["mchNo"] = self::MERCHANT_ID;
        $params["outTransNo"] = time() . rand(0000, 9999);
        $params["transAmount"] = $data['money'] * 100;
        $params["currency"] = $data['money_type'];
        $params["notifyUrl"] = 'https://www.twhealth.top/notify';
        $params["signature"] = self::signSHA256RSA($params);
        return $params;
    }

    public function notify(Request $request)
    {
        $data = $request->all();
        Log::info($data);
        if ($data['resultCode'] == '0000') {
            if (key_exists('accessOrderId', $data)) {
                $info = Order::where([
                    'order_sn' => $data['accessOrderId'],
                    'status' => 0
                ])->first();
            } elseif (key_exists('outTransNo', $data)) {
                $info = Order::where([
                    'order_sn' => $data['outTransNo'],
                    'status' => 0
                ])->first();
            }
            if ($info) {
                $info->status = 1;
                $info->save();
                return 'SUCCESS';
            }
        }
        return false;
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
        if ($data['money_type'] == 'USD' || $data['money_type'] == 'SGD') {
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
