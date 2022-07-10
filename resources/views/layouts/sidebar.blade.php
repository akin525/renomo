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
    <!-- site icon -->
    {{-- ChartScript --}}

    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <link rel="icon" href="{{asset("images/bn.jpeg")}}" type="image/png" />
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
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
    <link rel="stylesheet" href="{{asset('css/colors.css')}}" />
    <!-- select bootstrap -->
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.css')}}" />
    <!-- scrollbar css -->
    <link rel="stylesheet" href="{{asset('css/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/sweet-alert2/sweetalert2.min.css')}}" />
    <!-- custom css -->
    <link rel="stylesheet" href="{{asset('css/custom.css')}}" />

    <link rel="stylesheet" href="{{asset('hp/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('hp/main.css')}}" />

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4783566552108386"
            crossorigin="anonymous"></script>

    {{-- toastr --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />

</head>

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
                        <a href="{{route('home')}}"><img class="logo_icon img-responsive" src="{{asset("images/bn.jpeg")}}" alt="#" /></a>
                    </div>
                </div>
                <div class="sidebar_user_info">
                    <div class="icon_setting"></div>
                    <div class="user_profle_side">
                        <div class="user_img"><img class="img-responsive" src="{{asset("images/layout_img/user_img.jpg")}}" alt="#" /></div>
                        <div class="user_info">
                            <h6> {{ \App\Console\encription::decryptdata(Auth::user()->username) }}</h6>
                            <p><span class="online_animation"></span> Online</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <br>
                        <a href="{{ route('logout') }}"><button type="submit" class="btn btn-success">logout</button></a>
                    </form>
                </div>

            </div>
            <div class="sidebar_blog_2">
                <h4>General</h4>
                <ul class="list-unstyled components">
                    @if(Auth::user()->role=="admin")
                        <li class="active">
                            <a href="{{ route('admin/dashboard') }}"  ><i class="fa fa-amazon orange_color"></i> <span>Administrartor</span></a>
                        </li>
                    @endif
                    <li class="active">
                        <a href="{{ route('dashboard') }}"  ><i class="fa fa-dashboard white_color"></i> <span>Dashboard</span></a>
                    </li>
                    @if(Auth::user()->apikey ==NULL)
                        <li>
                            <a href="{{route('reseller')}}"><i class="fa fa-shopping-cart orange_color"></i> <span>Become Reseller</span></a>
                        </li>
                    @else
                        <li>
                            <a href="{{route('upgrade')}}"><i class="fa fa-book "></i> <span>Api</span></a>
                        </li>
                    @endif


                    <li><a href="{{ route('fund') }}"><i class="fa fa-credit-card orange_color"></i> <span>Fund Wallet</span></a></li>
                        <li>
                            <a href="{{url('safelock')}}"><i class="fa fa-lock"></i> <span>Create Safelock</span></a>
                        </li>
                        <li>
                            <a href="{{url('allock')}}"><i class="fa fa-lock orange_color"></i> <span>All-lock</span></a>
                        </li>
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

{{--                    <li>--}}
{{--                        <a href="{{route('referal')}}"><i class="fa fa-laptop "></i> <span>Referal System</span></a>--}}
{{--                    </li>--}}
                    <li class="active">
                        <a href="{{ route('profile.show') }}"  ><i class="fa fa-user white_color"></i> <span>Account Setting</span></a>
                    </li>


                    <li>
                        <a href="{{url('picktv')}}"><i class="fa fa-tv"></i> <span>Pay Tv</span></a>
                    </li>


                    <li>
                        <a href="{{route('elect')}}"><i class="fa fa-power-off"></i> <span>Pay Electricity</span></a>
                    </li>
                        <li>
                            <a href="{{route('withdraw')}}"><i class="fa fa-money red_color"></i> <span>Withdraw Request</span></a>
                        </li>
                    <li>
                        <a href="{{route('invoice')}}"><i class="fa fa-sticky-note "></i> <span>Bills Invoice</span></a>
                    </li>
                    <li>
                        <a href="{{route('charges')}}"><i class="fa fa-sticky-note"></i> <span>Charges</span></a>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="content">
            <!-- topbar -->
            <div class="topbar">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="full">
                        <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
                        <div class="logo_section">
                            <a href="{{ route('dashboard') }}"><img class="img-responsive" src="{{asset("images/bn.jpeg")}}" alt="#" /></a>
                        </div>
                        {{--                        <div class="right_topbar">--}}
                        {{--                            <div class="icon_info">--}}
                        {{--                                <!--                                <ul>-->--}}
                        {{--                                <!--                                    <li><a href="#"><i class="fa fa-bell-o"></i><span class="badge">2</span></a>-->--}}
                        {{--                                <!--                                  -->--}}
                        {{--                                <!--                                    </li>-->--}}
                        {{--                                <!---->--}}
                        {{--                                <!--                                    <li><a href="#"><i class="fa fa-question-circle"></i></a></li>-->--}}
                        {{--                                <!--                                    <li><a href="#"><i class="fa fa-envelope-o"></i><span class="badge">3</span></a></li>-->--}}
                        {{--                                <!--                                </ul>-->--}}
                        {{--                                <ul class="user_profile_dd">--}}
                        {{--                                    <li>--}}
                        {{--                                        <a class="dropdown-toggle" data-toggle="dropdown"><img class="img-responsive rounded-circle" src="{{asset("images/layout_img/user_img.jpg")}}" alt="#" /><span class="name_user" > {{ Auth::user()->name }}</span></a>--}}
                        {{--                                        <div class="dropdown-menu">--}}
                        {{--                                            <a class="dropdown-item" href="{{ route('profile.show') }}">My Profile</a>--}}
                        {{--                                            <a class="dropdown-item" href="profile.php">Settings</a>--}}
                        {{--                                            <!--                                            <a class="dropdown-item" href="help.html">Help</a>-->--}}
                        {{--                                            <a class="dropdown-item" href=""><span>Log Out</span> <i class="fa fa-sign-out"></i></a>--}}
                        {{--                                        </div>--}}
                        {{--                                    </li>--}}
                        {{--                                </ul>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
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
{{--                            <a href="https://play.google.com/store/apps/details?id=com.wPrimeData_15605638" class="font-weight-bold text-center">--}}
{{--                                <b>Download  our Mobile App</b>--}}
{{--                                <img width="300" src="{{asset('images/dd.png')}}" alt="">--}}

{{--                            </a>--}}

{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </center>--}}
            @include('sweetalert::alert')


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
                    right:40px;
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
            <a href="https://api.whatsapp.com/send?phone=+2348066215840" class="float" target="_blank">
                <i class="fa fa-whatsapp my-float"></i>
            </a>

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






