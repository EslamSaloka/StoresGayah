$(".SendDataForm").submit(function(e){
    e.preventDefault();
    // ================== //
    $(".inputD").removeClass('style-error');
    $(".text-error").remove();
    // ================== //
    var data = new FormData(this);
    var action = $(this).attr('action');

    $.ajax({
        url: action,
        type: 'post',
        data: data,
        contentType: false,
        processData: false,
        success: (result) => {

            var ICON = (result.status == 1) ? 'success' : 'error';
            if(result.redirect == 0) {
                Swal.fire({
                    title: result.title,
                    text: result.message,
                    icon: ICON,
                    confirmButtonText: result.button
                });

            } else {
                if(result.message != '') {
                    Swal.fire({
                        title: result.title,
                        text: result.message,
                        icon: ICON,
                        confirmButtonText: result.button
                    });
                    setTimeout(function() {
                        window.location.href = result.redirect;
                    }, 1000);
                } else {
                    window.location.href = result.redirect;
                }
            }
            if(result.resetInput == 1) {
                $(this)[0].reset();
            }

        },error: (err)=>{
            var n = err.responseJSON.errors;
            if(n == undefined) {
                Swal.fire({
                    title: "تنبيه",
                    text: "برجاء تسجيل الدخول أولا",
                    icon: 'error',
                    confirmButtonText: "إغلاق"
                });
            } else {
                $.each(n, function(o, n) {
                    $("input[name="+o+"]").addClass("style-error");
                    $("textarea[name="+o+"]").addClass("style-error");
                    $( "<span class='text-error'>"+n+"</span>" ).insertAfter( "input[name="+o+"]" );
                    $( "<span class='text-error'>"+n+"</span>" ).insertAfter( "textarea[name="+o+"]" );
                });
            }
        }
    });

});


$(document).on("click",".callAction",function(e){
    e.preventDefault();
    var _this = $(this);
    var actionName = _this.data('action');
    var productId  = _this.data('id');
    var URL = $('.DOMAIN_NAME').data("url")+"/action/"+actionName+"/"+productId;
    $.get(URL,(result)=>{
        var ICON = (result.status == 1) ? 'success' : 'error';
        var TITLE = (result.status == 1) ? 'تـــم' : 'تنبيه';
        if(result.html == '') {
            Swal.fire({
                title: TITLE,
                text: result.message,
                icon: ICON,
                confirmButtonText: "إغلاق"
            });
            if(result.red != '') {
                setTimeout(function() {
                    location.reload();
                },2000);
            }
        } else {
            $("#quickView").html(' ').html(result.html);
            $("#quick-view-modal").modal('toggle');
            setTimeout(function() {
                $('.product-large-thumbnail').slick({
                    infinite: false,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    dots: false,
                    speed: 800,
                    draggable: false,
                    rtl: true,
                    asNavFor: '.product-small-thumb'
                });
                if ($('.zoom-gallery').length) {
                    $('.zoom-gallery').each(function() {
                        $(this).magnificPopup({
                            delegate: 'a.popup-zoom',
                            type: 'image',
                            gallery: {
                                enabled: true
                            }
                        });
                    });
                }

            }, 700);
        }
        if(result.remove == 1) {
            $("#fav_"+productId).remove();
        }
    });
});


$('.cartDeleteAction').click(function(){
    $("#id_preload_ship").css("display","block");
    var URL = $(this).data('url');
    var productId  = $(this).data('id');
    $.get(URL,(result)=>{
        $('.cartCount').html(result.count);
        $('.cartTotal').html(result.total);
        $("#cart_"+productId).remove();
        setTimeout(function() {
            location.reload();
        }, 100);
    });
});


$(".changeShippingCompany").click(function(){
    var sub    = parseFloat($("#cartSub").data("price"));
    var coupon = parseFloat($("#cartCoupon").data("price"));
    var vat    = parseFloat($("#cartVat").data("price"));
    var total  = (sub - coupon) + vat + parseFloat($("input[name=shipping_by]:checked").data("price"));
    $("#cartTotal").html(parseFloat(total)+" ر.س")
});

$("#checkoutNow").click(function(){
    if ($("input[name=shipping_by]:checked").length > 0) {
        $.ajax({
            url: $(this).data('url'),
            type: 'post',
            data: {
                _token:$(".DOMAIN_TOKEN").data('token'),
                shipping_by:$("input[name=shipping_by]:checked").val(),
            },
            success: (result) => {
                if(result.redirect != '') {
                    window.location.href = result.redirect;
                }
            }
        });
    } else {
        Swal.fire({
            title: "تنبيه",
            text: "برجاء تحديد شركه الشحن",
            icon: "error",
            confirmButtonText: "إغلاق"
        });
    }
});

$(".couponCheck").click(function(){
    $("#id_preload_ship").css("display","block");
    if($(".couponCode").val() == '') {
        $("#id_preload_ship").css("display","none");
        Swal.fire({
            title: "تنبيه",
            text: "برجاء ادخال كود الخصم",
            icon: "error",
            confirmButtonText: "إغلاق"
        });
    } else {
        $.ajax({
            url: $(this).data('url'),
            type: 'post',
            data: {
                _token:$(".DOMAIN_TOKEN").data('token'),
                coupon:$(".couponCode").val(),
            },
            success: (result) => {
                $("#id_preload_ship").css("display","none");
                if(result.status == 0) {
                    Swal.fire({
                        title: "تنبيه",
                        text: result.message,
                        icon: "error",
                        confirmButtonText: "إغلاق"
                    });
                    if(result.redirect != '') {
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                } else {
                    if(result.redirect != '') {
                        location.reload();
                    }
                }
            }
        });
    }
});




$(document).on('click',".cartQAction",function() {
    $("#id_preload_ship").css("display","block");
    $.ajax({
        url: $(this).parent().data('action'),
        type: 'post',
        data: {
            _token:$(".DOMAIN_TOKEN").data('token'),
            qty:$(this).parent().find('.quantity-input').val(),
        },
        success: (result) => {
            location.reload();
        }
    });
});


// $().click(function());
