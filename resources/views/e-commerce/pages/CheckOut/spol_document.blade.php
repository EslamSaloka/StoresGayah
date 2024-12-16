<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=0.5, user-scalable=no">

    <title>SPL Shipping Barcode</title>
</head>

<style>
    .clearfix:after {
        content: "";
        display: table;
        clear: both;
    }

    a {
        color: #00c8e1;
        text-decoration: none;
    }

    body {
        position: relative;
        width: 90%;
        height: 29.7cm;
        margin: 0 auto;
        color: #555555;
        background: #FFFFFF;
        font-size: 14px;
    }

    header {
        padding: 10px 0;
        margin-bottom: 20px;
        border-bottom: 1px solid #AAAAAA;
    }


    #client .to {
        color: #777777;
    }

    h2.name {
        font-size: 1.4em;
        font-weight: normal;
        margin: 0;
    }

    #invoice h1 {
        color: #00c8e1;
        font-size: 2.4em;
        line-height: 1em;
        font-weight: normal;
        margin: 0  0 10px 0;
    }

    #invoice .date {
        font-size: 1.1em;
        color: #777777;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px;
    }


    table td {
        padding: 20px;
        background: #fff;
        text-align: center;
        border: 1px solid #aaa;
    }

    table th {
        padding: 20px;
        background: #00c8e1;
        text-align: center;
        font-size:20px;
        border: 1px solid #aaa;
    }

    table th {
        white-space: nowrap;
        font-weight: normal;
    }

    table td {
        text-align: right;
    }

    table td h3{
        color: #00c8e1;
        font-size: 1.2em;
        font-weight: normal;
        margin: 0 0 0.2em 0;
    }

    table .desc {
        text-align: left;
    }

    table td.unit,
    table td.qty,
    table td.total {
        font-size: 1.2em;
        background-color: #00c8e1 ;
    }

    table tbody tr:last-child td {
        border: none;
    }

    table tfoot td {
        padding: 10px 20px;
        background: #FFFFFF;
        border-bottom: none;
        font-size: 1.2em;
        white-space: nowrap;
        border-top: 1px solid #AAAAAA;
    }

    table tfoot tr:first-child td {
        border-top: none;
    }

    table tfoot tr:last-child td {
        color: #00c8e1;
        font-size: 1.4em;
        border-top: 1px solid #00c8e1;

    }

    table tfoot tr td:first-child {
        border: none;
    }


    #notices .notice {
        font-size: 1.2em;
    }

    footer {
        color: #777777;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #AAAAAA;
        padding: 8px 0;
        text-align: center;
    }


</style>

@php
    $cities = (new \App\Shipping\Spol())->getCities();
@endphp

<body>
<header class="clearfix">
    <div>
        <img src="https://splonline.com.sa/Design/images/Logo.svg" style="height:140px;">
    </div>
</header>
<main>
    <div id="details" class="clearfix">
        <div id="invoice" style="margin: 30px 0px;text-align:center;">
            <img src="https://barcode.tec-it.com/barcode.ashx?data={{$shipping->tracking_id}}&code=Code128&translate-esc=on">
        </div>
    </div>
    <table style="width:50%;float:left;">
        <thead>
        <tr>
            <th colspan="2" class="total" style="text-align:right;" >بيانات المستلم</th>
        </tr>
        </thead>
        <tbody  style="width:49.5%;text-align:right;">
            <tr>
                <td>{{ $shipping->customer['name'] }}</td>
                <td>الاسم</td>
            </tr>
            <tr>
                <td>{{ $shipping->customer['phone'] }}</td>
                <td>رقم الجوال</td>
            </tr>
            <tr>
                <td><b>{{ $cities[$shipping->customer['city']] }}</b></td>
                <td><b>المدينة</b></td>
            </tr>
            <tr>
                <td>{{ $shipping->customer['address_name'] }}</td>
                <td>العنوان</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>

        </tbody>
    </table>
    <table style="width:49.5%;float:right;">
        <thead>
        <tr>
            <th colspan="2" class="total" style="text-align:right;" >بيانات المرسل</th>
        </tr>
        </thead>
        <tbody  style="width:50%;text-align:right;">
        <tr>
            <td>{{ $shipping->store['name'] }}</td>
            <td>الاسم</td>
        </tr>
        <tr>
            <td>{{ $shipping->store['phone'] }}</td>
            <td>رقم الجوال</td>
        </tr>
        <tr>
            <td><b>{{ $cities[$shipping->store['city']] }}</b></td>
            <td><b>المدينة</b></td>
        </tr>
        <tr>
            <td>{{ $shipping->store['address_name'] }}</td>
            <td>العنوان</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>

        </tbody>
    </table>
    <table style="width:100%;float:right;">
        <thead>
        <tr>
            <th colspan="6" class="total" style="text-align:right;" >بيانات الشحنة</th>
        </tr>
        </thead>
        <tbody  style="width:100%;text-align:right;">
        <tr style="width:100%;">
            <td colspan="5">{{ $shipping->description }}</td>
            <td>الوصف</td>
        </tr>
        <tr>
            @if ($shipping->cod_price == -1)
            <td colspan="2"><strong><b>0</b></strong></td>
                <td><strong><b>COD Price</b></strong></td>
                <td colspan="2">شحنة عادية</td>
                <td>نوع الشحنة</td>
            @else
                <td colspan="2"><strong><b>{{ $shipping->cod_price }}</b></strong></td>
                <td><strong><b>COD Price</b></strong></td>
                <td colspan="2">دفع عند الاستلام</td>
                <td>نوع الشحنة</td>
            @endif
        </tr>
        <tr>
            <td colspan="2">{{ $shipping->pcs }}</td>
            <td>عدد القطع</td>
            <td colspan="2">كجم {{ $shipping->weight }} </td>
            <td>الوزن</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        </tbody>
    </table>
    <div id="notices">
        <div class="notice">
            <strong>
                <p style="float:right;">الرقم الموحد لخدمة العملاء هو 19992</p>
            </strong>
        </div>
    </div>
</main>

</body>
</html>
