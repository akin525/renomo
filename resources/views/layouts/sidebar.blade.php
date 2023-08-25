
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>{{\App\Console\encription::decryptdata(Auth::user()->name) }} Dashboard</title>
    <meta name="keywords" content="Buy data in a few clicks to keep surfing the internet. You can buy whatever size of data plan for whichever network you desire. All plans are topped-up to your specified number in seconds.">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" href="https://renomobilemoney.com/images/bn.jpeg"  />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{asset('asset/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('asset/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('asset/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
    <!-- site css -->
    <link rel="stylesheet" href="{{asset('style1.css')}}" />
    <!-- responsive css -->
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}" />
    <!-- color css -->
    <link rel="stylesheet" href="{{asset('css/color_2.css')}}" />
    <!-- select bootstrap -->
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.css')}}" />
    <!-- scrollbar css -->
    <link rel="stylesheet" href="{{asset('css/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/sweet-alert2/sweetalert2.min.css')}}" />
    <!-- custom css -->
    <link rel="stylesheet" href="{{asset('css/custom.css')}}" />

    <link rel="stylesheet" href="{{asset('hp/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('hp/main.css')}}" />

    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">

    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>


{{--    <script type="text/javascript" src="https://cdn.engagespot.co/engagespot-client.min.js"></script>--}}
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4783566552108386"
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.min.css">
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">

    <!-- SweetAlert JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.js"></script>


</head>
<style>
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .loading-spinner {
        width: 40px;
        height: 40px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #3498db;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<body class="dashboard dashboard_1">
<div id="loading-wrapper">
    <div class="spinner-border"></div>
    RENOMOBILEMONEY......
</div>

<div class="full_container">
    <div class="inner_container">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar_blog_1">
                <div class="sidebar-header">
                    <div class="logo_section">
                        <a href="{{route('dashboard')}}"><img class="logo_icon img-responsive" src="{{asset("images/bn.jpeg")}}" alt="#" /></a>
                    </div>
                </div>
                <div class="sidebar_user_info">
                    <div class="icon_setting"></div>
                    <div class="user_profle_side">
                        @if(Auth::user()->profile_photo_path==NULL)
                        <div class="user_img"><img class="img-responsive" src="{{asset("images/layout_img/user_img.jpg")}}" alt="#" /></div>
                        @elseif(\Illuminate\Support\Facades\Auth::user()->google_id!=NULL)
                        <div class="user_img"><img class="img-responsive" src="{{Auth::user()->profile_photo_path}}" alt="#" /></div>
                        @else
                            <div class="user_img"><img class="img-responsive" src="{{url('/', Auth::user()->profile_photo_path)}}" alt="#" /></div>
                        @endif
                            <div class="user_info">
                            <h6> {{ \App\Console\encription::decryptdata(Auth::user()->username) }}</h6>
                            <p><span class="online_animation"></span> Online</p>
                        </div>
                    </div>
{{--                    <form method="post" action="{{route('pic')}}" enctype="multipart/form-data">--}}
{{--                        @csrf--}}
{{--                        <input type="file" name="pic" required><button type="submit" class="badge badge-success">Upload</button>--}}
{{--                    </form>--}}
{{--                    <form method="POST" action="{{ route('logout') }}" x-data>--}}
{{--                        @csrf--}}
{{--                        <br>--}}
{{--                        <a href="{{ route('logout') }}"><button type="submit" class="btn btn-success">logout</button></a>--}}
{{--                    </form>--}}
                </div>

            </div>
            <div class="sidebar_blog_2">
                <h4>
                    <a href="https://play.google.com/store/apps/details?id=com.renomobilemoney" target=”_blank” class="font-weight-bold text-center">
                        <img width="150" src="{{asset('images/dd.png')}}" alt="">

                    </a>
                </h4>
                <ul class="list-unstyled components">
                    @if(Auth::user()->role=="admin")
                        <li class="active">
                            <a href="{{ route('admin/dashboard') }}"  ><i class="fa fa-amazon orange_color"></i> <span>Administrartor</span></a>
                        </li>
                    @endif
                    <li class="active">
                        <a href="https://documenter.getpostman.com/view/16410443/UzXPwG8p#f16ada4e-643a-48fa-a08f-0a1176054993" target=”_blank” ><i class="fa fa-plug white_color"></i> <span>Api Documentation</span></a>
                    </li>
                        <li class="active">
                        <a href="{{url('vtu')}}" ><i class="fa fa-wordpress white_color"></i> <span>Own A Webite</span></a>
                    </li>
                        <li class="active">
                        <a href="{{ route('dashboard') }}"  ><i class="fa fa-dashboard white_color"></i> <span>Dashboard</span></a>
                    </li>
                        <li class="active">
                        <a href="{{ route('commission') }}"  ><i class="fa fa-money white_color"></i> <span>My Commission</span></a>
                    </li>
                        </li>
                        <li class="active">
                        <a href="{{ route('datapin') }}"  ><i class="fa fa-mobile white_color"></i> <span>Buy Data-Pin</span></a>
                    </li>
                        <li>
                            <a href="{{route('invoice')}}"><i class="fa fa-sticky-note "></i> <span>Bills Invoice</span></a>
                        </li>
                        <li>
                            <a href="#app4" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-bullhorn"></i> <span>Recharge</span></a>
                            <ul class="collapse list-unstyled" id="app4">
                                @if(Auth::user()->apikey ==NULL)
                                    <li>
                                        <a href="{{route('select')}}"><i class="fa fa-laptop "></i> <span>Buy Data</span></a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{route('select1')}}"><i class="fa fa-laptop "></i> <span>Reseller Data</span></a>
                                    </li>
                                @endif

                                <li>
                                    <a href="{{route('airtime')}}"><i class="fa fa-phone "></i> <span>Buy Airtime</span></a>
                                </li>
                                <li>
                                    <a href="{{url('picktv')}}"><i class="fa fa-tv"></i> <span>Pay Tv</span></a>
                                </li>


                                <li>
                                    <a href="{{route('elect')}}"><i class="fa fa-power-off"></i> <span>Pay Electricity</span></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#app2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-book"></i> <span>Education</span></a>
                            <ul class="collapse list-unstyled" id="app2">
                                <li><a href="{{ route('waec') }}"><i class="fa fa-cab orange_color"></i> <span>Waec Checker</span></a></li>
                                <li><a href="{{ route('neco') }}"><i class="fa fa-cab"></i> <span>Neco Checker</span></a></li>

                            </ul>
                        </li>
                        <li>
                            <a href="#app7" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-users"></i> <span>Self Service</span></a>
                            <ul class="collapse list-unstyled" id="app7">
                                <li><a href="{{ url('verifybill') }}"><i class="fa fa-bookmark"></i> <span>Verify Airtime/Data</span></a></li>
                                <li><a href="{{ url('verifydeposit') }}"><i class="fa fa-newspaper-o"></i> <span>Verify Deposit</span></a></li>

                            </ul>
                        </li>
                        <li><a href="{{ route('fund') }}"><i class="fa fa-credit-card orange_color"></i> <span>Fund Wallet</span></a></li>
                        <li>
                            <a href="#app1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-gift"></i> <span>Giveaway</span></a>
                            <ul class="collapse list-unstyled" id="app1">
                                <li class="active">
                                    <a href="{{ route('bonus') }}"  ><i class="fa fa-gift orange_color"></i> <span>Create Giveaway</span></a>
                                </li>
                                <li class="active">
                                    <a href="{{ route('claim') }}"  ><i class="fa fa-folder-open white_color"></i> <span>Claim Giveaway</span></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#app3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-user"></i> <span>Profile</span></a>
                            <ul class="collapse list-unstyled" id="app3">
                                @if(Auth::user()->apikey ==NULL)
                                    <li>
                                        <a href="{{route('reseller')}}"><i class="fa fa-shopping-cart orange_color"></i> <span>Become Reseller</span></a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{route('upgrade')}}"><i class="fa fa-book "></i> <span>Api</span></a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{route('myaccount')}}"><i class="fa fa-user "></i> <span>My Profile</span></a>
                                </li>
                                    <li class="active">
                                        <a href="{{ route('profile.show') }}"  ><i class="fa fa-user white_color"></i> <span>Account Setting</span></a>
                                    </li>

                            </ul>
                        </li>
                        <li>
                            <a href="#app5" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-money"></i> <span>Savings</span></a>
                            <ul class="collapse list-unstyled" id="app5">
                                <li>
                                    <a href="{{url('safelock')}}"><i class="fa fa-lock"></i> <span>Create Safelock</span></a>
                                </li>
                                <li>
                                    <a href="{{url('allock')}}"><i class="fa fa-lock orange_color"></i> <span>All-lock</span></a>
                                </li>

                            </ul>
                        </li>

                        <li>
                            <a href="#app6" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-bookmark"></i> <span>Transaction</span></a>
                            <ul class="collapse list-unstyled" id="app6">

                                <li>
                                    <a href="{{route('charges')}}"><i class="fa fa-sticky-note"></i> <span>Charges</span></a>
                                </li>

                            </ul>
                        </li>

                        <li>
                            <a href="{{route('withdraw')}}"><i class="fa fa-money orange_color"></i> <span>Withdraw Request</span></a>
                        </li>
{{--                        <li>--}}
{{--                            <a href="https://play.google.com/store/apps/details?id=com.renomobilemoney" class="font-weight-bold text-center">--}}
{{--                                <img width="300" src="{{asset('images/dd.png')}}" alt="">--}}
{{--                                <span>Download  our Mobile App</span>--}}


{{--                            </a>--}}
{{--                        </li>--}}

                </ul>
            </div>
        </nav>
        <div id="content">
            <!-- topbar -->
            <div class="topbar">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="full">
                        <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
                        <div class="logo_section m-1">
                            <a href="{{ route('dashboard') }}"><img class="img-responsive" src="{{asset("images/bn.jpeg")}}" alt="#" /></a>
                        </div>
                        <br>
{{--                        @if(Auth::user()->pin =="0")--}}
{{--                            <button type="button" onclick="window.location.href='{{route('createpin')}}'" class="btn btn-success mb-3">Enable Transaction Pin for secure purpose</button>--}}
{{--                        @endif--}}
                    </div>

                </nav>
            </div>
            <!-- end topbar -->

{{--            <div class="alert alert-info">--}}
{{--                <button type='button' class='close' data-dismiss='alert'>&times;</button>--}}
{{--                <i class="fa fa-bell"></i><b>Notics:</b><h6 class="align-content-center text-center text-white"><b><button type="button" class="btn btn-success" onclick="window.location.href='{{route('referwith')}}';">Click to Withdraw Your Referal Bonus</button></b></h6>--}}
{{--            </div>--}}


{{--            <center>--}}
{{--                <div class="container-fluid">--}}
{{--                    <div class="row column_title">--}}
{{--                        <div class="card card-body align-content-center">--}}
{{--                            <a href="https://play.google.com/store/apps/details?id=com.renomobilemoney" class="font-weight-bold text-center">--}}
{{--                                <b>Download  our Mobile App</b>--}}
{{--                                <img width="300" src="{{asset('images/dd.png')}}" alt="">--}}

{{--                            </a>--}}

{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </center>--}}
            @include('sweetalert::alert')
            @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])


{{--            <center>--}}
{{--            <iframe width="250" height="100"--}}
{{--                    src="https://www.youtube.com/embed/ICXSsBrh9_0?autoplay=1"--}}
{{--                    title="PrimeData Promo Video Official | Buy Data Easily!"--}}
{{--                    frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>--}}

{{--            </iframe>--}}
{{--            </center>--}}


            <style>
                .float{
                    position:fixed;
                    width:60px;
                    height:60px;
                    bottom:40px;
                    left:40px;
                    background-color:#25d366;
                    color:#FFF;
                    border-radius:50px;
                    text-align:center;
                    font-size:30px;
                    box-shadow: 2px 2px 3px #999;
                    z-index:100;
                }

                .my-float{
                    margin-top:16px;
                }
            </style>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
            <a href="https://wa.me/2348066215840" class="float" target="_blank">
                <i class="fa fa-whatsapp my-float"></i>
            </a>
            <style>

                .cta {
                    display: flex;
                    padding: 11px 33px;
                    text-decoration: none;
                    font-family: 'Poppins', sans-serif;
                    font-size: 25px;
                    color: white;
                    background: #208b37;
                    transition: 1s;
                    box-shadow: 6px 6px 0 black;
                    transform: skewX(-15deg);
                    border: none;
                }

                .cta:focus {
                    outline: none;
                }

                .cta:hover {
                    transition: 0.5s;
                    box-shadow: 10px 10px 0 #FBC638;
                }

                .cta .second {
                    transition: 0.5s;
                    margin-right: 0px;
                }

                .cta:hover  .second {
                    transition: 0.5s;
                    margin-right: 45px;
                }

                .span {
                    transform: skewX(15deg)
                }

                .second {
                    width: 20px;
                    margin-left: 30px;
                    position: relative;
                    top: 12%;
                }

                .one {
                    transition: 0.4s;
                    transform: translateX(-60%);
                }

                .two {
                    transition: 0.5s;
                    transform: translateX(-30%);
                }

                .cta:hover .three {
                    animation: color_anim 1s infinite 0.2s;
                }

                .cta:hover .one {
                    transform: translateX(0%);
                    animation: color_anim 1s infinite 0.6s;
                }

                .cta:hover .two {
                    transform: translateX(0%);
                    animation: color_anim 1s infinite 0.4s;
                }

                @keyframes color_anim {
                    0% {
                        fill: white;
                    }

                    50% {
                        fill: #FBC638;
                    }

                    100% {
                        fill: white;
                    }
                }
                * {
                    padding: 0;
                    margin: 0
                }


                button {
                    padding: 20px 30px;
                    font-size: 1.5em;
                    /*width:200px;*/
                    cursor: pointer;
                    border: 0px;
                    position: relative;
                    /*margin: 20px;*/
                    transition: all .25s ease;
                    /*background: rgba(116, 23, 231, 1);*/
                    color: #fff;
                    overflow: hidden;
                    /*border-radius: 10px*/
                }

                .load {
                    position: absolute;
                    left: 0px;
                    top: 0px;
                    width: 100%;
                    height: 100%;
                    background: inherit;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    border-radius: inherit
                }

                .load::after {
                    content: '';
                    position: absolute;
                    border-radius: 50%;
                    border: 3px solid #fff;
                    width: 30px;
                    height: 30px;
                    border-left: 3px solid transparent;
                    border-bottom: 3px solid transparent;
                    animation: loading1 1s ease infinite;
                    z-index: 10
                }

                .load::before {
                    content: '';
                    position: absolute;
                    border-radius: 50%;
                    border: 3px dashed #fff;
                    width: 30px;
                    height: 30px;
                    border-left: 3px solid transparent;
                    border-bottom: 3px solid transparent;
                    animation: loading1 2s linear infinite;
                    z-index: 5
                }

                @keyframes loading1 {
                    0% {
                        transform: rotate(0deg)
                    }

                    100% {
                        transform: rotate(360deg)
                    }
                }

                button.active {
                    transform: scale(.85)
                }

                button.activeLoading .loading {
                    visibility: visible;
                    opacity: 1
                }

                button .loading {
                    opacity: 0;
                    visibility: hidden
                }
            </style>

            <!--Start of Tawk.to Script-->
            <script type="text/javascript">
                var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
                (function(){
                    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
                    s1.async=true;
                    s1.src='https://embed.tawk.to/619093ea6885f60a50bbb339/default';
                    s1.charset='UTF-8';
                    s1.setAttribute('crossorigin','*');
                    s0.parentNode.insertBefore(s1,s0);
                })();
            </script>
            <!--End of Tawk.to Script-->
            <!-- jQuery -->
            <script src="{{asset('js/jquery.min.js')}}"></script>
            <script src="{{asset('assets/sweet-alert2/sweetalert2.min.js')}}"></script>
            <script src="{{asset('js/popper.min.js')}}"></script>
            <script src="{{asset('js/bootstrap.min.js')}}"></script>
            <!-- wow animation -->
            <script src="{{asset('js/animate.js')}}"></script>
            <!-- select country -->
            <script src="{{asset('js/bootstrap-select.js')}}"></script>
            <!-- owl carousel -->
            <script src="{{asset('js/owl.carousel.js')}}"></script>

            <!-- nice scrollbar -->
            <script src="{{asset('js/perfect-scrollbar.min.js')}}"></script>
            <script>
                var ps = new PerfectScrollbar('#sidebar');
            </script>
            <!-- custom js -->
            <script src="{{asset('js/custom.js')}}"></script>
            <script src="{{asset('js/chart_custom_style1.js')}}"></script>

            <script src="{{asset('hp/jquery.min.js')}}"></script>
            <script src="{{asset('hp/bootstrap.bundle.min.js')}}"></script>
            <script src="{{asset('hp/modernizr.js')}}"></script>
            <script src="{{asset('hp/moment.js')}}"></script>
            <script src="{{asset('hp/main.js')}}"></script>

            {{-- toastr js --}}
            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>







<script>
    function setCookie(name,value,days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days*24*60*60*1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "")  + expires + "; path=/";
    }
    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }

    setCookie("user_email","{{\App\Console\encription::decryptdata(Auth::user()->username)}}",30); //set "user_email" cookie, expires in 30 days
    var userEmail=getCookie("user_email");//"bobthegreat@gmail.co
</script>
