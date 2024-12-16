<!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>
        هذا المتجر غير مكتمل
    </title>
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css" />
    <link rel="stylesheet" href="{{ url('/assets/css/vendor/bootstrap.rtl.min.css') }}">
    <style>
        @charset "UTF-8";
        /* CSS Document */

        body {
            background: #fff;
            padding: 0;
            margin: 0;
            font-family: Helvetica, Arial, sans-serif;
        }

        .container {
            background-color: #fff;
            margin: 0 auto;
            text-align: center;
            padding-top: 50px;
        }

        h1 {
            font-size: 30px;
            color: #ec681d;
            font-weight: bold;
            text-align: center;
            line-height: 130%;
        }

        .buton {
            background: #ec681d;
            padding: 10px 20px;
            color: #fff;
            font-weight: bold;
            text-align: center;
            border-radius: 3px;
            text-decoration: none;
        }

        a:hover {
            color: #ec681d;
        }

        span {
            font-size: 14px;
            color: #FFF;
            font-weight: normal;
            text-align: center;
        }

        span a {
            color: #ec681d;
            text-decoration: none;
        }

        span a:hover {
            color: #F00;
        }

        @media screen and (max-width: 500px) {
            img {
                width: 70%;
            }
            .container {
                padding: 70px 10px 10px 10px;
            }
            h3 {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
<div class="container">
    <img class="ops" src="{{ url('/suspended.png') }}" style="height:300px;text-align:center;" />
    <br/>
    <h1 style="margin-top:50px;">
        هذا المتجر غير مكتمل
    </h1>
    <p style="font-size:20px;">الرجاء استكمال بيانات المتجر مثل رفع صورة شعار المتجر وتحديد لون المتجر وهكذا</p>

    <br>
    <a href="{{route('website.home')}}" class="btn btn-success">الصفحة الرئيسية</a>

</div>

</body>

</html>
