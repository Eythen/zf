<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>訂單確認</title>
</head>
<style>
    /*公共样式*/
    body {
        background-color: #f7f7f8;
    }

    .red {
        color: red;
    }

    .pannel {
        margin-bottom: 10px;
        background-color: #fff;
        border-radius: 5px;
    }

    /*主体内容*/
    .main {
        padding: 12px 11px 5px; /*上 左右 下*/
    }

    .user_msg {
        display: flex;
        align-items: center;
        padding: 15px 0 15px 11px;
    }

    .user_msg .location {
        width: 30px;
        height: 30px;
        margin-right: 10px;
        background-image: linear-gradient(90deg,
        #6fc2aa 5%, #54b196 100%);
        border-radius: 50%;
        text-align: center;
        line-height: 30px;
        color: #fff;
    }

    .user_msg .user {
        flex: 1;
    }

    .user_msg .user .top {
        display: flex;
    }

    .user_msg .user .top h6 {
        width: 55px;
        font-size: 15px;
        font-weight: 400;
    }

    .user_msg .user .top p {
        font-size: 13px;
    }

    .user_msg .user .bottom {
        margin-top: 5px;
        font-size: 12px;
    }

    .user_msg .more {
        width: 44px;
        height: 44px;
        /* background-color:#54b196; */
        text-align: center;
        line-height: 44px;
        color: #808080;
    }

    /*底部左支付*/
    .pay {
        position: fixed;
        left: 0;
        bottom: 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        height: 80px;
        padding: 0 11px;
        background-color: white;
        border-top: 1px solid #ededed;
    }

    .pay .left {
        font-size: 12px;
    }

    .pay .left i {
        font-style: normal;
        font-size: 20px;
    }

    .pay .right a {
        display: block;
        width: 90px;
        height: 35px;
        background-image: linear-gradient(90deg,
        #6fc2aa 5%,
        #54b196 100%);
        border-radius: 3px;
        text-align: center;
        line-height: 35px;
        font-size: 13px;
        color: #fff;
        margin-right: 20px;
    }

    .goods {
        display: flex;
        padding: 11px 0 11px 11px;
    }

    .goods .pic {
        width: 85px;
        height: 85px;
        margin-right: 10px;
    }

    .goods .info {
        flex: 1;
    }

    .goods .info h5 {
        font-size: 13px;
        color: #262626;
        font-weight: 400;
    }

    .goods .info p {
        width: 95px;
        height: 20px;
        margin: 5px 0;
        background-color: #f7f7f8;
        font-size: 12px;
        color: #888;
    }

    .goods .info span:first-child {
        margin-right: 5px;
    }

    .goods .info .price {
        font-size: 12px;
    }

    .goods .info .price i {
        font-size: 16px;
    }

    .goods .count {
        width: 44px;
        height: 44px;
        text-align: center;
        line-height: 44px;
    }

    .rest {
        padding: 15px;
    }

    .rest div {
        display: flex;
        margin-bottom: 30px;
    }

    .rest h5, .rest p {
        font-size: 12px;
        color: #262626;
        font-weight: 400;
    }

    .rest2 {
        padding: 15px;
    }

    .rest2 div {
        display: flex;
        margin-bottom: 30px;
    }

    .rest2 div {
        justify-content: space-between;
        font-size: 12px;
    }

    .rest2 h5, .rest p {
        font-size: 12px;
        color: #262626;
        font-weight: 400;
    }
</style>
<body>
<!--商品信息-->
<div class="pannel goods">
    <div class="pic">
        <a href="#"><img width="85px" src="{{ $info->pic }}" alt=""> </a>
    </div>
    <div class="info">
        <h5>{{$info->name}}</h5>
        <div class="price">
            <span class="red">{{$info->money_type}}<i>{{$info->money}}</i></span>
        </div>
    </div>
    <div class="count">
        <i class="iconfont icon-x"></i>
        <span>x{{$info->num}}</span>
    </div>
</div>
<section class="pannel rest">
    <form method="post" action="" id="data_form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <input type="hidden" name="product_name" value="{{$info->name}}">
        <input type="hidden" name="product_num" value="{{$info->num}}">
        <input type="hidden" name="product_id" value="{{$info->id}}">
        <input type="hidden" name="pic" value="{{$info->pic}}">
        <input type="hidden" name="uid" value="{{$info->uid}}">
        <input type="hidden" name="money" value="{{$info->money}}">
        <input type="hidden" name="money_type" value="{{$info->money_type}}">
        <div>
            <h5>收貨人姓氏<br>(first_name)</h5>
            <input type="text"
                   name="first_name"
                   style="border:1px solid #ccc;border-radius: 10px;padding-left: 10px;margin-left: 5px;width: 500px"
                   placeholder="請輸入收貨人姓氏">
        </div>
        <div>
            <h5>收貨人名字<br>(last_name)</h5>
            <input type="text"
                   name="last_name"
                   style="border:1px solid #ccc;border-radius: 10px;padding-left: 10px;margin-left: 5px;width: 500px"
                   placeholder="請輸入收貨人名字">
        </div>
        <div>
            <h5>電話<br>(mobile)</h5>
            <input type="text"
                   name="mobile"
                   style="border:1px solid #ccc;border-radius: 10px;padding-left: 10px;margin-left: 5px;width: 500px"
                   placeholder="請輸入收貨人電話">
        </div>
        <div>
            <h5>收貨地址<br>(adress)</h5>
            <input type="text"
                   name="address"
                   style="border:1px solid #ccc;border-radius: 10px;padding-left: 10px;margin-left: 15px;width: 500px"
                   placeholder="請輸入收貨地址">
        </div>
        <div style="font-size: 10px;">
            <h5>付款方式<br>(Payment method)</h5>
            <select name="payment">
                <option value="1">VISA銀行卡支付</option>
                <option value="2">微信支付</option>
            </select>
        </div>
    </form>
</section>
<div class="pay">
    <div class="left">
        合计：<span class="red">{{$info->money_type}}<i>{{$info->money}}</i></span>
    </div>
    <div class="right">
        <a href="#" id="submit">提交</a>
    </div>
</div>
</body>
</html>
<script src="./static/jquery.js"></script>
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
