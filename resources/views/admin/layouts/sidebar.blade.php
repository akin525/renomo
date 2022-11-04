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
    <link rel="icon" href="{{asset("images/bn.jpeg")}}" type="image/jpeg" />
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
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
    <!-- custom css -->
    <link rel="stylesheet" href="{{asset('css/custom.css')}}" />
    <link rel="stylesheet" href="{{asset('Buy Data _ MobileNig_files/w3(1).css')}}">

    <link rel="stylesheet" href="{{asset('Buy Data _ MobileNig_files/w3(2).css')}}">
    <link rel="stylesheet" href="{{asset('Buy Data _ MobileNig_files/font-awesome.min.css')}}">
    <link href="{{asset('Buy Data _ MobileNig_files/icon')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('hp/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('hp/main.css')}}" />
</head>

<body class="dashboard dashboard_1">
<div id="loading-wrapper">
    <div class="spinner-border"></div>
    RENOMOBILEMONEY ADMIN......
</div>
<div class="full_container">
    <div class="inner_container">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar_blog_1">
                <div class="sidebar-header">
                    <div class="logo_section">
                        <a href="#"><img class="logo_icon img-responsive" src="{{asset("images/bn.jpeg")}}" alt="#" /></a>
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
                    <form method="post" action="{{route('pic')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="pic" required><button type="submit" class="badge badge-success">Upload</button>
                    </form>
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
                    <li class="active">
                        <a href="{{ route('dashboard') }}"  ><i class="fa fa-amazon white_color"></i> <span>Back To User Account</span></a>
                    </li>
                    <li>
                        <a href="#app1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-product-hunt"></i> <span>Control Product</span></a>
                        <ul class="collapse list-unstyled" id="app1">
                            <li class="nav-item">
                                <a  class="nav-link" href="{{ route('admin/air') }}"  ><i class="fa fa-laptop white_color"></i> <span>Airtime Control</span></a>
                            </li>
                            <li class="nav-item">
                                <a  class="nav-link" href="{{ route('admin/product1') }}"  ><i class="fa fa-shopping-cart white_color"></i> <span>Honorworld Product</span></a>
                            </li>
                            <li class="active">
                                <a href="{{ route('admin/product') }}"  ><i class="fa fa-shopping-cart red_color"></i> <span>MCD Product</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a  class="nav-link" href="{{ route('admin/dashboard') }}"  ><i class="fa fa-dashboard red_color"></i> <span>Dashboard</span></a>
                    </li>
                    <li>
                        <a href="#app4" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-lock"></i> <span>Locks</span></a>
                        <ul class="collapse list-unstyled" id="app4">
                            <li class="nav-item">
                                <a  class="nav-link" href="{{ route('admin/com') }}"  ><i class="fa fa-money red_color"></i> <span>Completed Safelock</span></a>
                            </li>
                            <li class="nav-item">
                                <a  class="nav-link" href="{{ route('admin/interest') }}"  ><i class="fa fa-money red_color"></i> <span>Dailly Interest</span></a>
                            </li>
                            <li class="nav-item">
                                <a  class="nav-link" href="{{ route('admin/allock') }}"  ><i class="fa fa-lock red_color"></i> <span>All Safelock</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#app6" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-laptop"></i> <span>Others</span></a>
                        <ul class="collapse list-unstyled" id="app6">
                            <li class="nav-item">
                                <a  class="nav-link" href="{{ route('admin/vertual') }}"  ><i class="fa fa-area-chart red_color"></i> <span>All-Vertual</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin/refer') }}"  ><i class="fa fa-bar-chart white_color"></i> <span>All-Referal</span></a>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <a href="#app" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-recycle"></i> <span>Query</span></a>
                        <ul class="collapse list-unstyled" id="app">
                            <li class="active">
                                <a href="{{ route('admin/depositquery') }}"  ><i class="fa fa-calendar"></i> <span>Query Deposite</span></a>
                            </li>
                            <li class="active">
                                <a href="{{ route('admin/billquery') }}"  ><i class="fa fa-calendar"></i> <span>Query Bills</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#apps" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-object-group blue2_color"></i> <span>Report</span></a>
                        <ul class="collapse list-unstyled" id="apps">
                            <li><a href="{{url('admin/report_daily')}}"><i class="fa fa-book"></i><span>Daily Report</span></a></li>
                            <li><a href="{{url('admin/report_monthly')}}"><i class="fa fa-book"></i><span>Monthly Report</span></a></li>
                            <li><a href="{{url('admin/report_yearly')}}"><i class="fa fa-book"></i><span>Yearly Report</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#app3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-database"></i> <span>Settings</span></a>
                        <ul class="collapse list-unstyled" id="app3">

                            <li class="nav-item">
                                <a  class="nav-link" href="{{ route('admin/setcharge') }}"  ><i class="fa fa-bell red_color"></i> <span>Set Charges</span></a>
                            </li>
                            <li class="active">
                                <a href="{{ route('admin/server') }}"  ><i class="fa fa-bars red_color"></i> <span>Control Server</span></a>
                            </li>
                            <li class="active">
                                <a href="{{ route('admin/noti') }}"  ><i class="fa fa-bell white_color"></i> <span>Change Notification</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#app5" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-bar-chart"></i> <span>Transactions</span></a>
                        <ul class="collapse list-unstyled" id="app5">
                            <li class="nav-item">
                                <a  class="nav-link" href="{{ route('admin/bills') }}"  ><i class="fa fa-shopping-basket white_color"></i> <span>All Bills</span></a>
                            </li>

                            <li class="nav-item">
                                <a  class="nav-link" href="{{ route('admin/mcdtransaction') }}"  ><i class="fa fa-home white_color"></i> <span>Mcdtransaction</span></a>
                            </li>
                            <li class="active">
                                <a href="{{ route('admin/finddeposite') }}"  ><i class="fa fa-search red_color"></i> <span>Find Deposit</span></a>
                            </li>

                            <li class="active">
                                <a href="{{ route('admin/deposits') }}"  ><i class="fa fa-shopping-bag white_color"></i> <span>All-Deposit</span></a>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <a href="#app2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-users"></i> <span>Users</span></a>
                        <ul class="collapse list-unstyled" id="app2">
                            <li class="nav-item">
                                <a href="{{ route('admin/credit') }}"  ><i class="fa fa-money red_color"></i> <span>Credit User</span></a>
                            </li>
                            <li class="active">
                                <a href="{{ route('admin/charge') }}"  ><i class="fa fa-money white_color"></i> <span>Charge User</span></a>
                            </li>
                            <li class="active">
                                <a href="{{ route('admin/user') }}"  ><i class="fa fa-users red_color"></i> <span>All User</span></a>
                            </li>
                            <li class="active">
                                <a href="{{ route('admin/finds') }}"  ><i class="fa fa-search white_color"></i> <span>Find User</span></a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item">
                        <a  class="nav-link" href="{{ route('admin/request') }}"  ><i class="fa fa-microphone "></i> <span>Withdraw Request</span></a>
                    </li>
                    <li class="nav-item">
                        <a  class="nav-link" href="{{ route('admin/webbook') }}"  ><i class="fa fa-bookmark white_color"></i> <span>Webbook</span></a>
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
                    </div>
                </nav>
            </div>
            <!-- end topbar -->
            @include('sweetalert::alert')



            <script type="text/javascript">
                (function() {
                    var options = {
                        whatsapp: "+2348066215840", // WhatsApp number
                        call_to_action: "Message us", // Call to action
                        position: "left", // Position may be 'right' or 'left'
                    };
                    var proto = document.location.protocol,
                        host = "whatshelp.io",
                        url = proto + "//static." + host;
                    var s = document.createElement('script');
                    s.type = 'text/javascript';
                    s.async = true;
                    s.src = url + '/widget-send-button/js/init.js';
                    s.onload = function() {
                        WhWidgetSendButton.init(host, proto, options);
                    };
                    var x = document.getElementsByTagName('script')[0];
                    x.parentNode.insertBefore(s, x);
                })();
            </script>













            <!-- jQuery -->
            <script src="{{asset('js/jquery.min.js')}}"></script>
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




