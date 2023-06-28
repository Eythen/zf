<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="./static/jquery.js"></script>
    <!-- Wrap what we need here -->
    <!-- SEO -->
    <title>訂單確認</title>
    <meta name="description" content="Q&amp;amp;A">
    <meta name="viewport" content="initial-scale=1.0, viewport-fit=cover">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <meta name="google" value="notranslate">
    <!-- Shop icon -->
    <link rel="shortcut icon" type="image/png"
          href="https://img.shoplineapp.com/media/image_clips/5f9b6e0a64cce622e5a9d1c5/original.png?1604021770">

    <!--- Site Ownership Data -->
    <meta name="google-site-verification" content="N9OdHHConGP_RyyMWFyZuLkC2SdhUg4KRZHJnBUgdEY">
    <meta name="msvalidate.01" content="70BF0315F35BDCDF81689CD3C60CC29A">
    <!--- Site Ownership Data End-->

    <!-- Styles -->
    <link rel="stylesheet" media="all" href="/static/common-f47625baea59b7f28766c213f44af5679a3f7198f77cf8bb89041.css">
    <link rel="stylesheet" media="all" href="/static/theme_ultra_chic-34df8f9520b939abf6937e1b689bf39fb9bcbfe68b2.css">
    <link rel="stylesheet" media="all" href="/static/css2.css">
    <style>
        .leftti {
            font-size: 18px;
            padding-left: 10px;
            color: rgb(233, 72, 41);
        }

        .rithtti {
            font-size: 22px;
            padding-left: 10px;
        }

        td {
            border-bottom: 1px solid #eeeeee;
        }

        .activenav {
            color: red !important;
            border-bottom: 1.5px solid red;
        }
    </style>

</head>
<body class="pages show mix-navigation-fixed ultra_chic light_theme page_builder v2_theme ng-scope vsc-initialized"
      ng-controller="MainController" youdao="bind">
<nav class="NavigationBar mod-desktop js-navbar-desktop nav-bg-color visible-lg">
    <div class="NavigationBar-container clearfix">
        <a class="NavigationBar-logo js-nav-logo" href="http://shaji.twhealth.top/index.html"><img
                src="/static/logo.png" loading="lazy"></a>
        <a class="NavigationBar-logo js-nav-logo" href="http://shaji.twhealth.top/index.html"><img
                src="/static/logo.png" loading="lazy"></a>
        <ul class="NavigationBar-mainMenu" style="margin-left: 219px;">
            <li class="navigation-menu nav-color">
                <ul class="navigation-menu-top-layer">
                    <li class="navigation-menu-item">
                        <a class="navigation-menu-item-label" href="http://shaji.twhealth.top/special-event.html"
                           target="" ng-non-bindable="">沙棘：植物软黄金 康复养生首选</a>
                    </li>
                    <li class="navigation-menu-item navigation-menu-item--nested">
                        <a class="navigation-menu-item-label" href="http://shaji.twhealth.top/health.html" target="">沙棘保健品<span
                                class="fa fa-angle-down"></span></a>
                    </li>
                    <li class="navigation-menu-item navigation-menu-item--nested">
                        <a class="navigation-menu-item-label" href="http://shaji.twhealth.top/beautiful.html" target="">
                            沙棘保養品<span class="fa fa-angle-down"></span> </a>
                    </li>
                    <li class="navigation-menu-item navigation-menu-item--nested">
                        <a class="navigation-menu-item-label" href="http://shaji.twhealth.top/know-seabuckthorn.html"
                           target=""> 認識沙棘<span class="fa fa-angle-down"></span> </a>
                    </li>
                    <li class="navigation-menu-item navigation-menu-item--nested"><a class="navigation-menu-item-label"
                                                                                     href="http://shaji.twhealth.top/news.html"
                                                                                     target=""> 最新消息<span
                                class="fa fa-angle-down"></span> </a>
                    </li>
                    <li class="navigation-menu-item navigation-menu-item--nested"><a class="navigation-menu-item-label"
                                                                                     href="http://shaji.twhealth.top/about.html"
                                                                                     target=""> 關於我們<span
                                class="fa fa-angle-down"></span> </a>
                    </li>
                    <li class="navigation-menu-item navigation-menu-item--nested"><a class="navigation-menu-item-label"
                                                                                     href="http://shaji.twhealth.top/qa.html"
                                                                                     target=""> Q&amp;A<span
                                class="fa fa-angle-down"></span> </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<div id="Content" class="js-content">
    <div class="CustomPage" style="visibility: visible;">
        <div class="Grid-row-wrapper">
            <div class="Grid-row">
                <div id="page-item-5ffd4722cbe4060035c57a63" class="Grid-item Grid-text-item">
                    <div class="Grid-item-title primary-border-color-after">
                        <p>
                            <strong><span style="color:#231815;"><span style="font-size:22px;"><span
                                            style="background-color: rgb(255, 255, 255);">訂單確認</span></span></span></strong>
                        </p>
                    </div>
                    <div class="Grid-item-content">
                        <form method="post" action="" id="data_form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="product_name" value="{{$info->name}}">
                            <input type="hidden" name="product_num" value="{{$info->num}}">
                            <input type="hidden" name="product_id" value="{{$info->id}}">
                            <input type="hidden" name="pic" value="{{$info->pic}}">
                            <input type="hidden" name="uid" value="{{$info->uid}}">
                            <table style="width: 100%;line-height: 8em;" id="jsjiesh">
                                <tbody>
                                <tr>
                                    <td width="10%"><span class="leftti">產品（product）</span></td>
                                    <td width="50%"><span class="rithtti">
                                    <img src="{{ $info->pic }}"
                                         style="width:80px;vertical-align:middle;display:inline-block">&nbsp;&nbsp;{{$info->name}}×{{$info->num}}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="leftti">收貨人姓氏（first_name）</span></td>
                                    <td><span class="rithtti"><input type="text"
                                                                     name="first_name"
                                                                     style="width: 500px;height: 40px;border:1px solid #ccc;border-radius: 10px;padding-left: 10px;font-size: 18px;"
                                                                     placeholder="請輸入收貨人姓氏"></span></td>
                                </tr>
                                <tr>
                                    <td><span class="leftti">收貨人名字（last_name）</span></td>
                                    <td><span class="rithtti"><input type="text"
                                                                     name="last_name"
                                                                     style="width: 500px;height: 40px;border:1px solid #ccc;border-radius: 10px;padding-left: 10px;font-size: 18px;"
                                                                     placeholder="請輸入收貨人名字"></span></td>
                                </tr>
                                <tr>
                                    <td><span class="leftti">電話（mobile）</span></td>
                                    <td><span class="rithtti"><input type="text"
                                                                     name="mobile"
                                                                     style="width: 500px;height: 40px;border:1px solid #ccc;border-radius: 10px;padding-left: 10px;font-size: 18px;"
                                                                     placeholder="請輸入收貨人電話"></span></td>
                                </tr>
                                <tr>
                                    <td><span class="leftti">收貨地址（adress）</span></td>
                                    <td><span class="rithtti"><input type="text"
                                                                     name="address"
                                                                     style="width: 500px;height: 40px;border:1px solid #ccc;border-radius: 10px;padding-left: 10px;font-size: 18px;"
                                                                     placeholder="請輸入收貨地址"></span></td>
                                </tr>
                                <tr>
                                    <td><span class="leftti">金額（amount）</span></td>
                                    <input type="hidden" name="money" value="{{$info->money}}">
                                    <input type="hidden" name="money_type" value="{{$info->money_type}}">
                                    <td><span class="rithtti">{{$info->money_type}}${{$info->money}}</span></td>
                                </tr>
                                <tr>
                                    <td><span class="leftti">付款方式（Payment method）</span></td>
                                    <td>
                                        <span class="rithtti"><input type="radio" name="payment" value="1">VISA銀行卡支付</span>
                                        <span class="rithtti"><input type="radio" name="payment" value="2">微信扫码</span>
                                    </td>
                                </tr>
{{--                                <tr>--}}
{{--                                    <td><span class="leftti">卡號（Card number）</span></td>--}}
{{--                                    <td><span class="rithtti"><input type="text"--}}
{{--                                                                     name="id_number"--}}
{{--                                                                     style="width: 500px;height: 40px;border:1px solid #ccc;border-radius: 10px;padding-left: 10px;font-size: 18px;"--}}
{{--                                                                     placeholder="請輸入銀行卡卡號"></span></td>--}}
{{--                                </tr>--}}
                                </tbody>
                            </table>
                        </form>
                        <div style="margin-top: 20px;text-align: center;">
                            <button id="submit"
                                    style="color: white;border: none;border-radius: 20px;padding: 10px 200px;background-color: rgb(233, 72, 41);letter-spacing: 5px;font-size: 20px;">
                                提交付款
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div ga-page-view="" class="ng-isolate-scope"></div>
</div>
<div id="Footer">
    <div class="Footer-grids">
        <div class="container global-primary  ">
            <div class="container-md-height" style="height: 100%; table-layout: fixed; width: 100%;">
                <!-- height and width must be difined for td to size correctly -->
                <div class="row row-md-height" style="height: 100%;">
                    <div id="grid-item-5f83ca07b0a5e8001bd5616b" class="item col-xs-12
                  col-md-12
                  col-md-height
                  " style="vertical-align: top; height: 100%;">
                        <div style="height: 100%;">
                            <div class="box-info " style="">
                                <div class="description" ng-non-bindable=""><h4><span
                                            style="font-size:18px;"><strong><span
                                                    style="color:#231815;">關於我們</span></strong></span></h4>

                                    <ul class="list-unstyled">
                                        <li><span style="font-size:16px;"><a href="JavaScript:;pages/news"
                                                                             target="_self"><span
                                                        style="color:#595757;">最新消息</span></a></span></li>
                                        <li><span style="font-size:16px;"><a href="JavaScript:;pages/about"
                                                                             target="_self"><span
                                                        style="color:#595757;">品牌故事</span></a></span></li>
                                        <li><span style="font-size:16px;"><a href="JavaScript:;pages/media-reports"
                                                                             target="_self"><span
                                                        style="color:#595757;">媒體報導</span></a></span></li>
                                        <li><span style="font-size:16px;"><a href="JavaScript:;pages/inspection"
                                                                             target="_self"><span
                                                        style="color:#595757;">檢驗報告</span></a></span></li>
                                        <li>&nbsp;</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="grid-item-5f83ca07b0a5e8001bd5616c" class="item col-xs-12
                  col-md-12
                  col-md-height
                  " style="vertical-align: top; height: 100%;">
                        <div style="height: 100%;">
                            <div class="box-info " style="">
                                <div class="description" ng-non-bindable=""><h4><span style="font-size:18px;"><span
                                                style="color:#231815;"><strong>顧客服務</strong></span></span></h4>

                                    <ul class="list-unstyled">
                                        <li><a href="JavaScript:;pages/partner" target="_self"><span><span
                                                        style="font-size:16px;"><span
                                                            style="color:#595757;">企業合作</span></span></span></a>
                                        </li>
                                        <li><a href="JavaScript:;pages/store" target="_self"><span><span
                                                        style="font-size:16px;"><span
                                                            style="color:#595757;">銷售據點</span></span></span></a>
                                        </li>
                                        <li><a href="http://shaji.twhealth.top/shopping-question.html"
                                               target="_self"><span><span style="font-size:16px;"><span
                                                            style="color:#595757;">購物Q&amp;A</span></span></span></a>
                                        </li>
                                        <li><span style="font-size:16px;"><span style="color:#595757;"><a
                                                        href="http://shaji.twhealth.top/privacy-policy.html"
                                                        style="color:#595757;"
                                                        target="_blank">隱私權政策</a></span></span></li>
                                        <li>&nbsp;</li>
                                        <li>&nbsp;</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="grid-item-5f83ca07b0a5e8001bd5616d" class="item col-xs-12
                  col-md-12
                  col-md-height
                  " style="vertical-align: top; height: 100%;">
                        <div style="height: 100%;">
                            <div class="box-info " style="">
                                <div class="description" ng-non-bindable=""><h4><span style="font-size:18px;"><span
                                                style="color:#231518;"><strong>聯絡我們</strong></span></span></h4>
                                    <ul class="list-unstyled">
                                        <li><span style="font-size:16px;"><span style="color:#595757;">電話 / +85253848840</span></span>
                                        </li>
                                        <li><span style="font-size:16px;"><span style="color:#595757;">時間 / 9:00 - 17:00</span></span>
                                        </li>
                                        <li><span style="font-size:16px;"><span style="color:#595757;">電郵 / beataxp5ch@outlook.com</span></span>
                                        </li>
                                        <li><span style="font-size:16px;"><span style="color:#595757;">地址 / 香港九龙红磡民裕街51号凯旋工商中心</span></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="grid-item-5fb34fb04d482b03d4d69c7e" class="item col-xs-12
                  col-md-12
                  col-md-height
                  " style="vertical-align: top; height: 100%;">
                        <div style="height: 100%;">
                            <div class="box-info " style="">
                                <div class="description" ng-non-bindable=""><p></p>
                                    <p><span
                                            style="font-weight: 700; color: rgb(35, 24, 21); font-size: 16px; text-align: center; background-color: rgb(255, 255, 255);">橙果國際Whats官方帳號</span>
                                    </p>
                                    <p><a href="whatsapp://send?phone=+85253848840&amp;text=hi"><img
                                                src="/static/whats.jpg" style="width:169px;"></a></p></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container global-primary  ">
            <div class="container-md-height" style="height: 100%; table-layout: fixed; width: 100%;">
                <!-- height and width must be difined for td to size correctly -->
                <div class="row row-md-height" style="height: 100%;">
                    <div id="grid-item-60331f4bb1dcdc86696782d3" class="item col-xs-12
                  col-md-12
                  col-md-height
                  " style="vertical-align: top; height: 100%;">
                        <div style="height: 100%;">
                            <div class="box-info " style="">
                                <div class="description" ng-non-bindable="">
                                    <div class="credit-cards" style="text-align: center;"><img
                                            src="/static/1400x_005.webp"> <img
                                            src="/static/1400x_002.webp"><img
                                            src="/static/1400x_004.webp"> <img
                                            src="/static/1400x.webp"><img
                                            src="/static/1400x_003.webp"><img
                                            src="/static/1400x_006.webp"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container global-primary  ">
            <div class="container-md-height" style="height: 100%; table-layout: fixed; width: 100%;">
                <!-- height and width must be difined for td to size correctly -->
                <div class="row row-md-height" style="height: 100%;">
                    <div id="grid-item-5f83ca07b0a5e8001bd56171" class="item col-xs-12
                  col-md-12
                  col-md-height
                  " style="vertical-align: top; height: 100%;">
                        <div style="height: 100%;">
                            <div class="box-info " style="">
                                <div class="description" ng-non-bindable="">
                                    <div class="credit-cards" style="text-align: center;"><img
                                            src="/static/card_visa.png"
                                            style="max-height: 40px; width: auto; display: inline-block; margin-right: 10px;"
                                            height="40"><img src="/static/card_master.png"><img
                                            src="/static/card_jcb.png"
                                            style="max-height: 40px; width: auto; display: inline-block; margin-right: 10px;"
                                            height="40"><img src="/static/card_linepay.png"
                                                             style="max-height: 40px; width: auto; display: inline-block; margin-right: 10px;"
                                                             height="40"><img src="/static/original.png"
                                                                              style="max-height:40px; width: auto; display: inline-block; margin-right: 10px;"
                                                                              height="40"></div>

                                    <div class="credit-cards" style="text-align: center;"><img
                                            src="/static/card_tw_711_pay.png"> <img
                                            src="/static/card_tw_fm_pay.png"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container global-primary  ">
            <div class="container-md-height" style="height: 100%; table-layout: fixed; width: 100%;">
                <!-- height and width must be difined for td to size correctly -->
                <div class="row row-md-height" style="height: 100%;">
                    <div id="grid-item-5f83ca07b0a5e8001bd5616f" class="item col-xs-12
                  col-md-12
                  col-md-height
                  " style="vertical-align: top; height: 100%;">
                        <div style="height: 100%;">
                            <div class="box-info " style="">
                                <div class="description" ng-non-bindable=""><p class="text-center"><span
                                            style="font-size:14px;"><span style="color:#231815;"><a
                                                    href="http://shaji.twhealth.top/shopping-question.html"
                                                    target="_self"><span>退換貨政策 </span></a>| <a
                                                    href="http://shaji.twhealth.top/privacy-policy.html"
                                                    target="_self"><span>隱私權政策</span></a> | 2017 ©ALTAIS橙果國際</span></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script type="text/javascript">
    $('#submit').click(function () {
        $.ajax({
            type: "post",
            url: "/pay",
            data: $("#data_form").serialize(),
            success: function (result) {
                console.log(result);
                if (result.status) {
                    window.location.href = result.pay_url
                    // alert(result.pay_url)
                } else {
                    alert(result.msg)
                }
            }
        });
    });
</script>
