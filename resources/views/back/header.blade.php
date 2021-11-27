<!doctype html>
<html lang="tr" class="default-style layout-fixed layout-navbar-fixed">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
{{--        <link rel="stylesheet" href="{{ asset('css/bootstrap-material.css') }}">--}}

<!-- Bootstrap CSS -->
    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/toastr.scss') }}" rel="stylesheet">
    <link href="{{ asset('public/css/custom.css') }}" rel="stylesheet">
<!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('css/back/all.min.css') }}">


    <!-- Confirm CSS -->
    <link rel="stylesheet" href="{{ asset('css/jquery-confirm.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap-table.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/bootstrap-datepicker/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/bootstrap-material-datetimepicker/bootstrap-material-datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/timepicker/timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/back/bootstrap4-toggle.min.css') }}">


    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('css/back/style.css') }}">

    <style>
        .container{
            width: 100% !important;
            max-width: 100%;
        }
    </style>

    <title>@yield('title') iDeal Data</title>

    <style>
        .btn{
            border-radius: 15px 15px 15px 15px;
        }
        .active{
            background-color: #6C757D !important;
        }
        .navback{
            background-color: #6C757D !important;
        }
    </style>

    @yield('header')

</head>

<body class="loading">
<div class="modal_lutfenbekleyiniz"></div>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg navback">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/panel') }}">
            <img src="{{ asset('images/navbarlogo-admin.png') }}" alt="HCT Bilişim" height="40">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" style="font-weight: bold; color: #fd7e14"
                       href="{{ url('/') }}">Siteye Git</a>
                </li>
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ url('my-account') }}" class="nav-link" href="{{ url('profile') }}"><i class="fa fa-user"></i> Profilim</a>--}}
                {{--                        </li>--}}
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle"   id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#" href="{{ url('notifications') }}" ><i class="fa fa-envelope"></i> Bildirimler <span class="badge badge-primary ncount">-</span></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

{{--                        <a class="dropdown-item notification-item" href="{{ url('panel/order/detail/' }}"> Numaralı Yeni Sipariş</a>--}}

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:void(0)" onclick="bildirimkapat()">Hepsini Okundu Olarak İşaratle</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('logout') }}"><i class="fas fa-sign-out-alt"></i> Çıkış Yap</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

@if(session()->has('success'))
    <div class="alert alert-success">
        <i class="fa fa-check"></i> <b>İşlem Başarılı.</b>
        {{ is_string( session('success') ) ? session('success') : '' }}
    </div>
@elseif(session()->has('danger'))
    <div class="alert alert-danger">
        <i class="fa fa-times"></i> <b>İşlem Başarısız.</b>
        {{ is_string( session('danger') ) ? session('danger') : '' }}
    </div>
@elseif(session()->has('must'))
    <div class="alert alert-warning">
        <i class="fa fa-angle-right"></i> <b>Uyarı!</b>
        {{ is_string( session('must') ) ? session('must') : '' }}
    </div>
@endif

<div class="container" style="padding-top: 25px">
    <div class="row">
        <div class="col-lg-2 col-md-3 col-sm-3 col-12">
            <div class="list-group">
                <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark">
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li>
                            <a href="{{ url('panel') }}" class="nav-link text-white {{ Request::path() == 'panel' ? 'active' : '' }}">
                                <i class="fas fa-home"></i>&nbsp;Anasayfa
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('panel/order/list') }}" class="nav-link text-white {{ Request::path() == 'panel/order/list' ? 'active' : '' }}">
                                <i class="fab fa-amazon-pay"></i>
                                Siparişler
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('panel/suspended') }}" class="nav-link text-white {{ Request::path() == 'panel/suspended' ? 'active' : '' }}">
                                <i class="fas fa-pause"></i>
                                &nbsp;Askıya Alınan İşlemler
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('panel/demo/list') }}" class="nav-link text-white {{ Request::path() == 'panel/demo/list' ? 'active' : '' }}">
                                <i class="fas fa-user-clock"></i>
                                Demolar
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('panel/customer/list') }}" class="nav-link text-white {{ Request::path() == 'panel/customer/list' ? 'active' : '' }}">
                                <i class="fas fa-users"></i>
                                Müşteriler
                            </a>
                        </li>
                        @if(\Illuminate\Support\Facades\Auth::user()->authorization == 1)
                            <li>
                                <a href="{{ url('panel/user/list') }}" class="nav-link text-white {{ Request::path() == 'panel/user/list' ? 'active' : '' }}">
                                    <i class="fas fa-users-cog"></i>
                                    Admin Kullanıcıları
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('panel/product/list') }}" class="nav-link text-white {{ Request::path() == 'panel/product/list' ? 'active' : '' }}">
                                    <i class="fas fa-tags"></i>
                                    Ürünler
                                </a>
                            </li>
                            <li>
                                <a class="nav-link text-white {{ Request::path() == 'panel/report/sales-report' || Request::path() == 'panel/report/license-report' ? 'active' : '' }}" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="fas fa-angle-right"></i>&nbsp;Raporlar
                                </a>
                            </li>

                            <div class="collapse" id="collapseExample">
                                <hr>
                                <ul>
                                    <li><a href="{{ url('panel/report/sales-report') }}" class="nav-link text-white bg-secondary {{ Request::path() == 'panel/report/sales-report' ? 'active' : '' }}">Satış Raporları</a></li>
                                    <li><a href="{{ url('panel/report/license-report') }}" class="nav-link text-white bg-secondary {{ Request::path() == 'panel/report/license-report' ? 'active' : '' }}">Lisans Raporları</a>
                                    </li>
                                </ul>
                                <hr>

                            </div>


                            <li>
                                <a href="{{ url('panel/downloadlink') }}" class="nav-link text-white {{ Request::path() == 'panel/downloadlink' ? 'active' : '' }}">
                                    <i class="fas fa-download"></i>
                                    Download Linkleri
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('panel/intermediaries') }}" class="nav-link text-white {{ Request::path() == 'panel/intermediaries' ? 'active' : '' }}">
                                    <i class="fas fa-handshake"></i>
                                    Anlaşmalı Kurumlar
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('panel/add-static') }}" class="nav-link text-white {{ Request::path() == 'panel/add-static' ? 'active' : '' }}">
                                    <i class="fas fa-file"></i>
                                    Statik Alan
                                </a>
                            </li>
                            <br>
                            <small>Bakım Modu</small>
                            <input type="checkbox" id="switchButton" onclick="clickApply()" data-toggle="toggle" {{ maintenance() == 1 ? 'checked' : '' }} data-size="xs">
                        @endif
                    </ul>
                    <hr>
                    <div>
                        <i class="fas fa-user"></i>&nbsp;&nbsp;&nbsp;
                        <strong>Onur</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-12">
            @yield('content')
        </div>
    </div>
</div>


<script src="{{ asset('js/jquery-3.5.1.min.js') }} "></script>
<script src="{{ asset('js/popper.min.js') }} "></script>
<script src="{{ asset('js/bootstrap.min.js') }} "></script>
<script src="{{ asset('js/jquery-confirm.min.js') }} "></script>
<script src="{{ asset('js/bootstrap4-toogle.min.js') }} "></script>
<script>

    function bildirimkapat(){
        // Variable to hold request
        var request;
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();

        // Abort any pending request
        if (request) {
            request.abort();
        }

        // Ajax Post
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        request = $.ajax({
            url: "/panel",
            type: "post",
            data: ''
        });

        // Callback handler that will be called on success
        request.done(function (response, textStatus, jqXHR){
            // Log a message to the console
            $(".ncount").text("0");
            $(".notifications").remove();
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
            // Log the error to the console
            console.error(
                "The following error occurred: "+
                textStatus, errorThrown
            );
        });

        // Callback handler that will be called regardless
        // if the request failed or succeeded
        request.always(function () {
            // Reenable the inputs
            // $inputs.prop("disabled", false);
        });


    }

    // Ajax Post
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $body = $("body");

    $(document).on({
        ajaxStart: function() { $body.addClass("loading"); },
        ajaxStop: function() { $body.removeClass("loading"); },
    });

    $(document).ready(function (){
        $body.removeClass("loading");
    });

    $(document).ready(function (){
        $("#table").bootstrapTable();
    });
    $(document).ajaxStop(function () {
        run_scripts();
    });
    run_scripts();
    function run_scripts(){
        $(".btn-remove-item").click(function () {
            var user_name = $(this).attr("data-username");
            var delete_type = $(this).attr("data-item-type");
            var id = $(this).attr("data-id");
            var url = getAjaxURL(delete_type) + "/" + id;
            var addInfo;
            if(delete_type == 'order')
            {
                if(user_name != undefined && user_name != '-')
                {
                    addInfo = '<strong>BU KULLANICI BIR HESAP OLUŞTURMUŞ, YİNE DE DEVAM EDiLSİN Mİ?</strong>';
                }
                else
                {
                    addInfo = 'Kullanıcıya mail atılacak.';
                }
            }
            else
            {
                addInfo = '';
            }

            $.confirm({
                title: 'Emin misiniz?',
                content: 'Silme işlemini gerçekleştirmek istiyor musunuz? ' + addInfo,
                type: 'red',
                typeAnimated: true,
                buttons: {
                    areYouSure: {
                        text: 'Evet, Sil',
                        btnClass: 'btn-red',
                        draggable: true,
                        action: function(){
                            if(delete_type == 'order')
                            {
                                $('#staticBackdrop').modal("show");
                                $('#url').val(url);
                            }
                            else
                            {
                                // Ajax Post
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $.post(url,{ id: id }).done(function( data ) {
                                    $('table').bootstrapTable("refresh");

                                    // Jquery Confirm Success
                                    $.alert({
                                        title: 'İşlem Başarılı',
                                        content: 'Silme işlemi başarılı bir şekilde tamamlandı.',
                                        type: 'red',
                                        typeAnimated: true,
                                    });
                                });
                            }
                        }
                    },
                    close: {
                        text: 'Hayır, Silme',
                        action: function () { }
                    }
                }
            });
        });


        $(".apply").click(function () {
            var delete_type = $(this).attr("data-item-type");
            var id = $(this).attr("data-id");
            var url = getAjaxURL(delete_type) + "/" + id;

            $.confirm({
                title: 'Emin misiniz?',
                content: 'Sipariş onaylanacak ve kullanıcıya mail atılacak?',
                type: 'green',
                typeAnimated: true,
                buttons: {
                    areYouSure: {
                        text: 'Evet, Onayla',
                        btnClass: 'btn-green',
                        draggable: true,
                        action: function(){

                            // Ajax Post
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.post(url,{ id: id }).done(function( data ) {
                                $('table').bootstrapTable("refresh");

                                // Jquery Confirm Success
                                $.alert({
                                    title: 'İşlem Başarılı',
                                    content: 'Onaylama işlemi başarılı.',
                                    type: 'green',
                                    typeAnimated: true,
                                });
                            });

                        }
                    },
                    close: {
                        text: 'Hayır, Vazgeç',
                        action: function () { }
                    }
                }
            });
        })

        $(".waiting").click(function () {
            var delete_type = $(this).attr("data-item-type");
            var id = $(this).attr("data-id");
            var url = getAjaxURL(delete_type) + "/" + id;

            $.confirm({
                title: 'Emin misiniz?',
                content: 'Sipariş durumu bekliyor olarak değiştirilecek',
                type: 'orange',
                typeAnimated: true,
                buttons: {
                    areYouSure: {
                        text: 'Evet, Değiştir',
                        btnClass: 'btn-warning',
                        draggable: true,
                        action: function(){

                            // Ajax Post
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.post(url,{ id: id }).done(function( data ) {
                                $('table').bootstrapTable("refresh")

                                // Jquery Confirm Success
                                $.alert({
                                    title: 'İşlem Başarılı',
                                    content: 'Sipariş durumu değiştirildi.',
                                    type: 'orange',
                                    typeAnimated: true,
                                });
                            });

                        }
                    },
                    close: {
                        text: 'Hayır, Vazgeç',
                        action: function () { }
                    }
                }
            });
        })

        $(".getpay").click(function () {
            var delete_type = $(this).attr("data-item-type");
            var id = $(this).attr("data-id");
            var url = getAjaxURL(delete_type) + "/" + id;

            $.confirm({
                title: 'Emin misiniz?',
                content: 'Ödeme alındı olarak işaretlenip kişiye mail atılacak?',
                type: 'blue',
                typeAnimated: true,
                buttons: {
                    areYouSure: {
                        text: 'Evet, Ödeme Alındı',
                        btnClass: 'btn-info',
                        draggable: true,
                        action: function(){

                            // Ajax Post
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.post(url,{ id: id }).done(function( data ) {
                                $('table').bootstrapTable("refresh");

                                // Jquery Confirm Success
                                $.alert({
                                    title: 'İşlem Başarılı',
                                    content: 'Sipariş durumu değiştirildi.',
                                    type: 'blue',
                                    typeAnimated: true,
                                });
                            });

                        }
                    },
                    close: {
                        text: 'Hayır, Vazgeç',
                        action: function () { }
                    }
                }
            });
        })
    }

    function getAjaxURL(delete_type) {
        var url = "{{url('panel')}}" + "/" + delete_type + "/delete";
        return url;
    }
    function formatMyMoney(price) {

        var currency_symbol = "₺"

        var formattedOutput = new Intl.NumberFormat('tr-TR', {
            style: 'currency',
            currency: 'TRY',
            minimumFractionDigits: 2,
        });

        return formattedOutput.format(price).replace(currency_symbol, '')
    }
</script>

<script>
    // Bakım modu click
    if($('#switchButton').change(function() {


        var checkControl = 0;

        if($(this).prop('checked') == true)
        {
            checkControl = 1;

            $.confirm({
                title: 'Emin misiniz?',
                content: 'Site bakım moduna geçecek ve kullanıcılar siteye erişemeyecek? ',
                type: 'red',
                typeAnimated: true,
                buttons: {
                    areYouSure: {
                        text: 'Evet',
                        btnClass: 'btn-red',
                        draggable: true,
                        action: function(){
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.post('{{url('maintenance')}}',{ 'checkControl': checkControl }).done(function( data ) {

                            });
                        }
                    },
                    close: {
                        text: 'Hayır',
                        action: function () {
                            document.getElementById("switchButton").checked = false;
                            // toggle btn btn-xs btn-light off
                            // toggle btn btn-xs btn-primary
                            $('#switchButton').parent().removeClass('btn-primary');
                            $('#switchButton').parent().addClass('btn-light off');
                        }
                    }
                }
            });
        }
        else
        {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post('{{url('maintenance')}}',{ 'checkControl': checkControl }).done(function( data ) {

            });
        }
    }));
</script>

<script>
    function cancelClick(submType = null) {
        $(':button').prop('disabled', true);
        var url = $('#url').val();
        var $form = $('#canceledPost');

        var serializedData = $form.serialize();

        request = $.ajax({
            url: url,
            type: "post",
            data: serializedData
        });

        request.done(function (response, textStatus, jqXHR) {
            if(response != 444)
            {
                $('#staticBackdrop').modal("hide");

                if(submType == 'detail')
                {
                    window.location.replace('{{ url('successCancel') }}');
                }
                else
                {
                    $('table').bootstrapTable("refresh");

                    $.alert({
                        title: 'İşlem Başarılı',
                        content: 'Sipariş başarıyla iptal edildi.',
                        type: 'red',
                        typeAnimated: true,
                    });
                }
            }
            else
            {
                $.alert({
                    title: 'Hata!',
                    content: 'Neden girilmesi zorunludur!',
                    type: 'red',
                    typeAnimated: true,
                });
            }

        });

        request.fail(function (jqXHR, textStatus, errorThrown) {

        });

        request.always(function () {
            $(':button').prop('disabled', false);
        });
    }
</script>

<script>
    $("form").submit(function () {
        $("body").addClass('loading'); // Loading ekranını aktif et
    });
</script>

@yield('footer')

</body>

</html>
