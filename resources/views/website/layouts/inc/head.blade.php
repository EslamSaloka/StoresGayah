
<title>غاية اكسبريس</title>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="keywords" content="">

<link rel="shortcut icon" type="image/x-icon" href="assets/website/img/logo/favicon.png">
<link href="assets/website/css/bootstrap.min.css" rel="stylesheet"/>
<link href="assets/website/css/all-fontawesome.min.css" rel="stylesheet"/>
<link href="assets/website/css/icomoon.css" rel="stylesheet"/>
<link href="assets/website/css/magnific-popup.css" rel="stylesheet"/>
<link href="assets/website/css/owl.carousel.min.css" rel="stylesheet"/>
<link href="assets/website/css/owl.theme.default.min.css" rel="stylesheet"/>
<link href="assets/website/css/nice-select.min.css" rel="stylesheet"/>
<link href="assets/website/css/jquery-ui.min.css" rel="stylesheet"/>
<link href="assets/website/css/animate.min.css" rel="stylesheet"/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@300&display=swap" rel="stylesheet">
<link href="assets/website/css/style.css" rel="stylesheet">

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-262677314-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-262677314-1');
</script>

<!-- Snap Pixel Code -->
<script type='text/javascript'>
(function(e,t,n){if(e.snaptr)return;var a=e.snaptr=function()
{a.handleRequest?a.handleRequest.apply(a,arguments):a.queue.push(arguments)};
a.queue=[];var s='script';r=t.createElement(s);r.async=!0;
r.src=n;var u=t.getElementsByTagName(s)[0];
u.parentNode.insertBefore(r,u);})(window,document,
'https://sc-static.net/scevent.min.js');

snaptr('init', '907b79c3-585a-400a-8bc4-f9022962334f', {
'user_email': 'g.wx.990@gmail.com'
});

snaptr('track', 'PAGE_VIEW');

</script>
<!-- End Snap Pixel Code -->



<style>

    .fabs-wrapper {
        position: fixed;
        bottom: 5rem;
        right: 3rem;
        z-index: 999999;
    }
    .fabs-checkbox {
        display: none;
    }
    .fabs {
        position: absolute;
        bottom: -1rem;
        right: -1rem;
        width: 4rem;
        height: 4rem;
        background: #ec681d;
        border-radius: 50%;
        transition: all 0.4s ease;
        z-index: 1999999;
        border-bottom-left-radius: 6px;
        border: 1px solid #ec681d;
    }

    .fabs:before {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.1);
    }
    .fabs-checkbox:checked ~ .fabs:before {
        width: 90%;
        height: 90%;
        left: 5%;
        top: 5%;
        background-color: rgba(255, 255, 255, 0.2);
    }
    .fabs:hover {
        background: #ec681d;
        box-shadow: 0px 5px 20px 5px #ec681d;
    }

    .fabs-dots {
        position: absolute;
        height: 8px;
        width: 8px;
        background-color: white;
        border-radius: 50%;
        top: 50%;
        transform: translateX(0%) translateY(-50%) rotate(0deg);
        opacity: 1;
        animation: blink 3s ease infinite;
        transition: all 0.3s ease;
    }

    .fabs-dots-1 {
        left: 15px;
        animation-delay: 0s;
    }
    .fabs-dots-2 {
        left: 50%;
        transform: translateX(-50%) translateY(-50%);
        animation-delay: 0.4s;
    }
    .fabs-dots-3 {
        right: 15px;
        animation-delay: 0.8s;
    }

    .fabs-checkbox:checked ~ .fabs .fabs-dots {
        height: 6px;
    }

    .fabs .fabs-dots-2 {
        transform: translateX(-50%) translateY(-50%) rotate(0deg);
    }

    .fabs-checkbox:checked ~ .fabs .fabs-dots-1 {
        width: 32px;
        border-radius: 10px;
        left: 50%;
        transform: translateX(-50%) translateY(-50%) rotate(45deg);
    }
    .fabs-checkbox:checked ~ .fabs .fabs-dots-3 {
        width: 32px;
        border-radius: 10px;
        right: 50%;
        transform: translateX(50%) translateY(-50%) rotate(-45deg);
    }

    @keyframes blink {
        50% {
            opacity: 0.25;
        }
    }

    .fabs-checkbox:checked ~ .fabs .fabs-dots {
        animation: none;
    }

    .fabs-wheel {
        position: absolute;
        bottom: 0;
        right: 0;
        border: 0 solid #ec681d;
        width: 10rem;
        height: 10rem;
        transition: all 0.3s ease;
        transform-origin: bottom right;
        transform: scale(0);
    }

    .fabs-checkbox:checked ~ .fabs-wheel {
        transform: scale(1);
    }
    .fabs-action {
        position: absolute;
        background: #ec681d;
        border: 1px solid #ccc;
        width: 3rem;
        height: 3rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: White;
        transition: all 1s ease;
        opacity: 0;
    }

    .fabs-checkbox:checked ~ .fabs-wheel .fabs-action {
        opacity: 1;
    }

    .fabs-action:hover {
        background-color: #4d5152;
    }

    .fabs-wheel .fabs-action-1 {
        right: -7px;
        bottom: 65px;
    }

    .fabs-wheel .fabs-action-2 {
        right: -7px;
        bottom: 120px;
    }
    .fabs-wheel .fabs-action-3 {
        right: -7px;
        bottom: 175px;
    }
    .fabs-wheel .fabs-action-4 {
        left: 0;
        bottom: -1rem;
    }

</style>
