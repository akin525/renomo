<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Renomobilemoney | Data Refill, Airtime, Cable TV, Electricity Subscription</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset("images/bn.jpeg")}}" type="image/png" />


    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{asset('auth/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('auth/use.fontawesome.com/releases/v6.1.1/css/all.css')}}">

    <!-- custom styles -->
    <link rel="stylesheet" type="text/css" href="{{asset('auth/assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('auth/assets/css/responsive.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('auth/assets/css/animation.css')}}">
</head>
<style>
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
<body class="show-section">
@include('sweetalert::alert')

<section class="step1">
    <div class="step1-inner">
        <div class="container">
            <div class="wrapper">
                <div class="row">
                    <div class="col-md-7 pe-md-4">
                        <div class="row">
                            <div class="col-md-6 tab-100">

                                <!-- Logo/Name-->
                                <div class="company">

                                    <!-- logo -->
                                    <div class="company_logo">
                                        <img alt="avatar" src="{{asset("images/bn.jpeg")}}">
                                    </div>

                                    <!-- Name -->
                                    <div class="company-name">
                                        <h4>RENOMOBILEMONEY</h4>
                                        <p>PAY BILLS</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 tab-100">

                                <!-- Tabs -->
                                <div class="form_tabs">
                                    <div class="nav nav-tabs" id="form-tabs" role="tablist">

                                        <!-- 1st tab button -->
                                        <button class="nav-link active" id="car-insurance-tab" data-bs-toggle="tab" data-bs-target="#car-tab" role="tab" aria-controls="car-tab" aria-selected="true">
                                            Login
                                        </button>

                                        <!-- 2nd tab button -->
                                        <button class="nav-link"  onclick="window.location.href='{{ route('register') }}'">
                                           Sign Up
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- tab content 1 -->
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="car-tab" role="tabpanel" aria-labelledby="car-insurance-tab" tabindex="0">

                                <!-- 1st tab form -->
                                <form class="entrance_animation" method="post" action="{{ route('log') }}">
                                @csrf

                                <!-- 1st tab heading -->
                                    <div class="main-heading">
                                        Buy Airtime/Data
                                        <br/>
                                        Pay Bills
                                    </div>
                                    @if (session('status'))
                                        <div class="mb-4 font-medium text-sm text-green-600">
                                            {{ session('status') }}
                                        </div>
                                @endif
                                    <!--1st tab label/input -->
                                    <x-jet-validation-errors class="alert alert-danger" />
                                    <center>
                                        <a href="{{ route('google.login') }}" class="btn btn-outline-success btn-user" >
                                            <img width="50" src="{{asset('google.png')}}" alt=""/>
                                            Login With Google
                                        </a>
                                    </center>
                                    <br/>

                                    <div>
                                        <label class="label-text">Username</label>
                                        <input class="form_input" type="text" name="username" placeholder="Username" required>
                                    </div>
                                    <div>
                                        <label class="label-text">Password</label>
                                        <input class="form_input" type="password" name="password" required>
                                    </div>

                                    @if (Route::has('password.request'))
                                        <a class="forgot" href="{{ route('password.request') }}">Forgotten Password?</a>
                                @endif
                                    <!-- step 1 next button -->
                                    <div class="next-btn">
                                        <button type="submit" class="btn btn-success">Login<span class="load loading"></span></button>
                                    </div>
                                    <script>
                                        const btns = document.querySelectorAll('button');
                                        btns.forEach((items)=>{
                                            items.addEventListener('click',(evt)=>{
                                                evt.target.classList.add('activeLoading');
                                            })
                                        })
                                    </script>
                            </div>
                            </form>
                        </div>
                    </div>

                    <!-- step 1 sidebar -->
                    <div class="col-md-5">

                        <!-- step 1 sidebar slider -->
                        <div class="sidebar-slider">
                            <div id="sidebar-slide-2" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="carousel-caption">

                                            <!-- sidebar 1st slide image -->
                                            <img alt="slider" src="{{asset("images/bn.jpeg")}}">

                                            <!-- after image text -->
                                            <span>
								      			about our Safe-lock
								      		</span>

                                            <!-- sidebar slider 1st slide heading -->
                                            <div class="main-heading">
                                                Create Safe-lock
                                                <br/>
                                                & Enjoy 10% Interest
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="carousel-caption">

                                            <!-- sidebar 2nd slide image -->
                                            <img alt="slider" src="{{asset("images/bn.jpeg")}}">

                                            <!-- after image text -->
                                            <span>
								      			about our Safe-lock
								      		</span>

                                            <!-- sidebar slider 1st slide heading -->
                                            <div class="main-heading">
                                                Create Safe-lock
                                                <br/>
                                                & Enjoy 10% Interest
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="carousel-caption">

                                            <!-- sidebar 3rd slide image -->
                                            <img alt="slider" src="{{asset("images/bn.jpeg")}}">

                                            <!-- after image text -->
                                            <span>
								      			about our Safe-lock
								      		</span>

                                            <!-- sidebar slider 1st slide heading -->
                                            <div class="main-heading">
                                                Create Safe-lock
                                                <br/>
                                                & Enjoy 10% Interest
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- slide indicators -->
                                <div class="carousel-indicators">

                                    <!-- 1st slide -->
                                    <button type="button" data-bs-target="#sidebar-slide-2" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>

                                    <!-- 2nd slide -->
                                    <button type="button" data-bs-target="#sidebar-slide-2" data-bs-slide-to="1" aria-label="Slide 2"></button>

                                    <!-- 3rd slide -->
                                    <button type="button" data-bs-target="#sidebar-slide-2" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div>
                            </div>
                            <div class="bg-shape">
                                <img alt="slider" src="{{asset("images/bn.jpeg")}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





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

<!-- bootstrap JS -->
<script src="{{asset('auth/assets/js/bootstrap.min.js')}}"></script>

<!-- custom JS -->
<script src="{{asset('auth/assets/js/custom.js')}}"></script>
</body>
