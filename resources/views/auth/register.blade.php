
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
                                          Sign Up
                                        </button>

                                        <!-- 2nd tab button -->
                                        <button class="nav-link"  onclick="window.location.href='{{ route('login') }}'">
                                            Login
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- tab content 1 -->
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="car-tab" role="tabpanel" aria-labelledby="car-insurance-tab" tabindex="0">

                                <!-- 1st tab form -->
                                <form class="entrance_animation" method="post" action="{{ route('register') }}">
                                    @csrf

                                    <!-- 1st tab heading -->
                                    <div class="main-heading">
                                       Buy Airtime/Data
                                        <br/>
                                      Pay Bills
                                    </div>

                                    <!--1st tab label/input -->
                                        <x-jet-validation-errors class="alert alert-danger" />
                                        <center>
                                            <a href="{{ route('google.login') }}" class="btn btn-outline-success btn-user" >
                                                <img width="50" src="{{asset('google.png')}}" alt="#"/>
                                                Sign Up With Google
                                            </a>
                                        </center>
                                        <div>
                                        <label class="label-text">Name</label>
                                        <input class="form_input" type="text" name="name" placeholder="Full Name" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 tab-100">
                                            <label class="label-text">Username</label>
                                            <input class="form_input" type="text" name="username" placeholder="Username">
                                        </div>
                                        <div class="col-md-6 tab-100">
                                            <label class="label-text">Email</label>
                                            <input class="form_input" type="text" id="mail-email1" name="email" placeholder="Name@example.com" required>
                                        </div>
                                        <div class="col-md-6 tab-100">
                                            <label class="label-text">Phone Number</label>
                                            <input class="form_input" type="number" name="phone" placeholder="081">
                                        </div>
                                        <div class="col-md-6 tab-100">
                                            <label class="label-text">Gender</label>
                                            <select class="form_select" name="gender">
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- 1st tab select field -->
                                    <div class="multi-select">
                                        <div class="row">
                                            <div class="col-md-6 tab-100">
                                                <label class="label-text">Addres</label>
                                                <input class="form_input" type="text" name="address" placeholder="Address" required>
                                            </div>
                                            <div class="col-md-6 tab-100">
                                                <label class="label-text">Date Of Birth</label>
                                                <input class="form_input" type="date" name="dob" placeholder="Nemar" required>
                                            </div>
                                            <div class="col-md-6 tab-100">
                                                <label class="label-text">Password</label>
                                                <input class="form_input" type="password" name="password" required>
                                            </div>
                                            <div class="col-md-6 tab-100">
                                                <label class="label-text">Confirm Password</label>
                                                <input class="form_input" type="password" name="password_confirmation" required>
                                            </div>
                                            @if(isset($request->refer))
                                                <div>
                                                    <label class="label-text">Refer</label>
                                                    <input class="form_input" type="text" name="refer" value="{{$request->refer}}">
                                                </div>
                                            @else
                                                                                            <input id="username" class="block mt-1 w-full" type="hidden" name="refer" value="" required autofocus autocomplete="username" readonly/>
                                            @endif

                                        </div>
                                        <div class="multi-select-inner"></div>
                                    </div>

                                <!-- step 1 next button -->
                                <div class="next-btn">
                                    <button type="submit" class="btn btn-success">Sign Up</button>
                                </div>
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





{{--<div class="full_container">--}}
{{--        <div class="container">--}}
{{--            <div class="center verticle_center full_height">--}}
{{--                <div class="login_section">--}}
{{--                    <div class="logo_login">--}}
{{--                        <div class="center">--}}
{{--                            <img width="110" src="{{asset("images/bn.jpeg")}}" alt="#" />--}}
{{--                        </div>--}}
{{--                    </div>--}}



{{--                        <div class="login_form">--}}
{{--                            <h3 class="text-center text-purple">SIGN-UP</h3>--}}
{{--                            <hr>--}}
{{--                            <center>--}}
{{--                                <a href="{{ route('google.login') }}" class="btn btn-outline-success btn-user" >--}}
{{--                                    <i class="fa fa-google "></i>Signup With Google--}}
{{--                                </a>--}}
{{--                            </center>--}}
{{--                            <center>--}}
{{--                                <div class="card-body">--}}
{{--                                    <x-jet-validation-errors class="mb-4" />--}}
{{--                                </div>--}}
{{--                            </center>--}}
{{--                            <div class="col-lg-6 col-md-6">--}}
{{--                                <div class="form-wizard">--}}


{{--                            <form method="POST" role="form" action="{{ route('register') }}">--}}
{{--                                @csrf--}}
{{--                                <div class="form-wizard-header">--}}
{{--                                    <p>Fill all form field to go next step</p>--}}
{{--                                    <ul class="list-unstyled form-wizard-steps clearfix">--}}
{{--                                        <li class="active"><span>1</span></li>--}}
{{--                                        <li><span>2</span></li>--}}
{{--                                        <li><span>3</span></li>--}}
{{--                                        <li><span>4</span></li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                                <fieldset class="wizard-fieldset show">--}}
{{--                                    <h5>Personal Information</h5>--}}
{{--                                    <div class="tab">Name:--}}
{{--                                        <div class="field">--}}
{{--                                        <label class="label_field">Full Name</label>--}}
{{--                                            <input id="name" class="form-control wizard-required"  type="text" name="name"  required autofocus autocomplete="name" />--}}
{{--                                            <div class="wizard-form-error"></div>--}}
{{--                                    </div>--}}
{{--                                    <div class="field">--}}
{{--                                        <label class="label_field">Phone Number</label>--}}
{{--                                        <p><input id="phone" type="number" name="phone"  required autofocus autocomplete="phone "/></p>--}}
{{--                                    </div>--}}
{{--                                    <div class="field">--}}
{{--                                        <label class="label_field">Username</label>--}}
{{--                                        <p><input id="username"  type="text" name="username"  required autofocus autocomplete="username" /></p>--}}
{{--                                    </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="tab">Contact Info:--}}
{{--                                    <div class="field">--}}
{{--                                        <label class="label_field">Address</label>--}}
{{--                                        <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autofocus autocomplete="Address" />--}}
{{--                                    </div>--}}
{{--                                    <div class="field">--}}
{{--                                        <label class="label_field">Gender</label>--}}
{{--                                        <select id="address" class="block mt-1 w-full"  name="gender"  required autofocus autocomplete="Address" >--}}
{{--                                            <option value="Male">Male</option>--}}
{{--                                            <option value="Female">Female</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                    <div class="field">--}}
{{--                                        <label class="label_field">Date Of Birth</label>--}}
{{--                                        <x-jet-input id="dob" class="block mt-1 w-full" type="date" name="dob" :value="old('dob')" required autofocus autocomplete="dob" />--}}
{{--                                    </div>--}}
{{--                                    @if(isset($request->refer))--}}
{{--                                        <div class="field">--}}
{{--                                            <label class="label_field">Refer</label>--}}
{{--                                            <input id="username" class="block mt-1 w-full" type="text" name="refer" value="{{$request->refer}}" required autofocus autocomplete="username" readonly/>--}}
{{--                                        </div>--}}
{{--                                    @else--}}
{{--                                        <div class="field">--}}
{{--                                            --}}{{--                        <label class="label_field">Refer</label>--}}
{{--                                            <input id="username" class="block mt-1 w-full" type="hidden" name="refer" value="" required autofocus autocomplete="username" readonly/>--}}
{{--                                        </div>--}}
{{--                                    @endif--}}
{{--                                    </div>--}}
{{--                                    <div class="tab">Mail & Password--}}
{{--                                    <div class="field">--}}
{{--                                        <label class="label_field">Email</label>--}}
{{--                                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />--}}
{{--                                    </div>--}}

{{--                                    <div class="field">--}}
{{--                                        <label class="label_field">Password</label>--}}
{{--                                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />--}}
{{--                                    </div>--}}

{{--                                    <div class="field">--}}
{{--                                        <label class="label_field">Confirmed-Password</label>--}}
{{--                                        <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />--}}
{{--                                    </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="field">--}}
{{--                                        <label class="label_field hidden">hidden label</label>--}}
{{--                                        <!--                                <label class="form-check-label"><input type="checkbox" id="rememberMe" class="form-check-input"> Remember Me</label>-->--}}
{{--                                        <a class="forgot" href="{{route('login')}}">Already Signed-Up, then Login</a>--}}
{{--                                    </div>--}}
{{--                                    <br>--}}
{{--                                    <div class="field margin_0">--}}
{{--                                            <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>--}}
{{--                                            <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>--}}
{{--                                    </div>--}}

{{--                                    <!-- Circles which indicates the steps of the form: -->--}}
{{--                                    <div style="text-align:center;margin-top:40px;">--}}
{{--                                        <span class="step"></span>--}}
{{--                                        <span class="step"></span>--}}
{{--                                        <span class="step"></span>--}}
{{--                                        <span class="step"></span>--}}
{{--                                    </div>--}}
{{--                                    <div class="field margin_0">--}}
{{--                                        <label class="label_field hidden">hidden label</label>--}}
{{--                                        <button type="submit" class="main_bt">Sign Up<span class="load loading"></span></button>--}}
{{--                                    </div>--}}
{{--                                    <script>--}}
{{--                                        const btns = document.querySelectorAll('button');--}}
{{--                                        btns.forEach((items)=>{--}}
{{--                                            items.addEventListener('click',(evt)=>{--}}
{{--                                                evt.target.classList.add('activeLoading');--}}
{{--                                            })--}}
{{--                                        })--}}
{{--                                    </script>--}}

{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--<script>--}}
{{--    var currentTab = 0; // Current tab is set to be the first tab (0)--}}
{{--    showTab(currentTab); // Display the current tab--}}

{{--    function showTab(n) {--}}
{{--        // This function will display the specified tab of the form ...--}}
{{--        var x = document.getElementsByClassName("tab");--}}
{{--        x[n].style.display = "block";--}}
{{--        // ... and fix the Previous/Next buttons:--}}
{{--        if (n == 0) {--}}
{{--            document.getElementById("prevBtn").style.display = "none";--}}
{{--        } else {--}}
{{--            document.getElementById("prevBtn").style.display = "inline";--}}
{{--        }--}}
{{--        if (n == (x.length - 1)) {--}}
{{--            document.getElementById("nextBtn").innerHTML = "Submit";--}}
{{--        } else {--}}
{{--            document.getElementById("nextBtn").innerHTML = "Next";--}}
{{--        }--}}
{{--        // ... and run a function that displays the correct step indicator:--}}
{{--        fixStepIndicator(n)--}}
{{--    }--}}

{{--    function nextPrev(n) {--}}
{{--        // This function will figure out which tab to display--}}
{{--        var x = document.getElementsByClassName("tab");--}}
{{--        // Exit the function if any field in the current tab is invalid:--}}
{{--        if (n == 1 && !validateForm()) return false;--}}
{{--        // Hide the current tab:--}}
{{--        x[currentTab].style.display = "none";--}}
{{--        // Increase or decrease the current tab by 1:--}}
{{--        currentTab = currentTab + n;--}}
{{--        // if you have reached the end of the form... :--}}
{{--        if (currentTab >= x.length) {--}}
{{--            //...the form gets submitted:--}}
{{--            document.getElementById("regForm").submit();--}}
{{--            return false;--}}
{{--        }--}}
{{--        // Otherwise, display the correct tab:--}}
{{--        showTab(currentTab);--}}
{{--    }--}}

{{--    function validateForm() {--}}
{{--        // This function deals with validation of the form fields--}}
{{--        var x, y, i, valid = true;--}}
{{--        x = document.getElementsByClassName("tab");--}}
{{--        y = x[currentTab].getElementsByTagName("input");--}}
{{--        // A loop that checks every input field in the current tab:--}}
{{--        for (i = 0; i < y.length; i++) {--}}
{{--            // If a field is empty...--}}
{{--            if (y[i].value == "") {--}}
{{--                // add an "invalid" class to the field:--}}
{{--                y[i].className += " invalid";--}}
{{--                // and set the current valid status to false:--}}
{{--                valid = false;--}}
{{--            }--}}
{{--        }--}}
{{--        // If the valid status is true, mark the step as finished and valid:--}}
{{--        if (valid) {--}}
{{--            document.getElementsByClassName("step")[currentTab].className += " finish";--}}
{{--        }--}}
{{--        return valid; // return the valid status--}}
{{--    }--}}

{{--    function fixStepIndicator(n) {--}}
{{--        // This function removes the "active" class of all steps...--}}
{{--        var i, x = document.getElementsByClassName("step");--}}
{{--        for (i = 0; i < x.length; i++) {--}}
{{--            x[i].className = x[i].className.replace(" active", "");--}}
{{--        }--}}
{{--        //... and adds the "active" class to the current step:--}}
{{--        x[n].className += " active";--}}
{{--    }--}}
{{--</script>--}}
{{--                            <style>--}}
{{--                                .float{--}}
{{--                                    position:fixed;--}}
{{--                                    width:60px;--}}
{{--                                    height:60px;--}}
{{--                                    bottom:40px;--}}
{{--                                    left:40px;--}}
{{--                                    background-color:#25d366;--}}
{{--                                    color:#FFF;--}}
{{--                                    border-radius:50px;--}}
{{--                                    text-align:center;--}}
{{--                                    font-size:30px;--}}
{{--                                    box-shadow: 2px 2px 3px #999;--}}
{{--                                    z-index:100;--}}
{{--                                }--}}

{{--                                .my-float{--}}
{{--                                    margin-top:16px;--}}
{{--                                }--}}
{{--                            </style>--}}

{{--                            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">--}}
{{--                            <a href="https://api.whatsapp.com/send?phone=+2348066215840" class="float" target="_blank">--}}
{{--                                <i class="fa fa-whatsapp my-float"></i>--}}
{{--                            </a>--}}



{{--                            --}}{{-- toastr js --}}
{{--                            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>--}}
{{--                            <!--Start of Tawk.to Script-->--}}
{{--                            <script type="text/javascript">--}}
{{--                                var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();--}}
{{--                                (function(){--}}
{{--                                    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];--}}
{{--                                    s1.async=true;--}}
{{--                                    s1.src='https://embed.tawk.to/619093ea6885f60a50bbb339/default';--}}
{{--                                    s1.charset='UTF-8';--}}
{{--                                    s1.setAttribute('crossorigin','*');--}}
{{--                                    s0.parentNode.insertBefore(s1,s0);--}}
{{--                                })();--}}
{{--                            </script>--}}
{{--                            <!--End of Tawk.to Script-->--}}

{{--    <!-- Scripts -->--}}
{{--    <script>--}}
{{--        const rmCheck = document.getElementById("rememberMe"),--}}
{{--            emailInput = document.getElementById("email");--}}

{{--        if (localStorage.checkbox && localStorage.checkbox !== "") {--}}
{{--            rmCheck.setAttribute("checked", "checked");--}}
{{--            emailInput.value = localStorage.username;--}}
{{--        } else {--}}
{{--            rmCheck.removeAttribute("checked");--}}
{{--            emailInput.value = "";--}}
{{--        }--}}

{{--        function lsRememberMe() {--}}
{{--            if (rmCheck.checked && emailInput.value !== "") {--}}
{{--                localStorage.username = emailInput.value;--}}
{{--                localStorage.checkbox = rmCheck.value;--}}
{{--            } else {--}}
{{--                localStorage.username = "";--}}
{{--                localStorage.checkbox = "";--}}
{{--            }--}}
{{--        }--}}
{{--    </script>--}}
{{--<script src="{{asset('hp/jquery.min.js')}}"></script>--}}
{{--<script src="{{asset('hp/bootstrap.bundle.min.js')}}"></script>--}}
{{--<script src="{{asset('hp/modernizr.js')}}"></script>--}}
{{--<script src="{{asset('hp/moment.js')}}"></script>--}}
{{--<script src="{{asset('hp/main.js')}}"></script>--}}
{{--<script src="{{asset('auth/assets/js/jquery.min.js')}}"></script>--}}

{{--<script>--}}
{{--    $(document).ready(function () {--}}
{{--        $("#show_hide_password a").on('click', function (event) {--}}
{{--            event.preventDefault();--}}
{{--            if ($('#show_hide_password input').attr("type") == "text") {--}}
{{--                $('#show_hide_password input').attr('type', 'password');--}}
{{--                $('#show_hide_password i').addClass("bx-hide");--}}
{{--                $('#show_hide_password i').removeClass("bx-show");--}}
{{--            } else if ($('#show_hide_password input').attr("type") == "password") {--}}
{{--                $('#show_hide_password input').attr('type', 'text');--}}
{{--                $('#show_hide_password i').removeClass("bx-hide");--}}
{{--                $('#show_hide_password i').addClass("bx-show");--}}
{{--            }--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}
{{--    <script>--}}
{{--        jQuery(document).ready(function() {--}}
{{--            // click on next button--}}
{{--            jQuery('.form-wizard-next-btn').click(function() {--}}
{{--                var parentFieldset = jQuery(this).parents('.wizard-fieldset');--}}
{{--                var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps .active');--}}
{{--                var next = jQuery(this);--}}
{{--                var nextWizardStep = true;--}}
{{--                parentFieldset.find('.wizard-required').each(function(){--}}
{{--                    var thisValue = jQuery(this).val();--}}

{{--                    if( thisValue == "") {--}}
{{--                        jQuery(this).siblings(".wizard-form-error").slideDown();--}}
{{--                        nextWizardStep = false;--}}
{{--                    }--}}
{{--                    else {--}}
{{--                        jQuery(this).siblings(".wizard-form-error").slideUp();--}}
{{--                    }--}}
{{--                });--}}
{{--                if( nextWizardStep) {--}}
{{--                    next.parents('.wizard-fieldset').removeClass("show","400");--}}
{{--                    currentActiveStep.removeClass('active').addClass('activated').next().addClass('active',"400");--}}
{{--                    next.parents('.wizard-fieldset').next('.wizard-fieldset').addClass("show","400");--}}
{{--                    jQuery(document).find('.wizard-fieldset').each(function(){--}}
{{--                        if(jQuery(this).hasClass('show')){--}}
{{--                            var formAtrr = jQuery(this).attr('data-tab-content');--}}
{{--                            jQuery(document).find('.form-wizard-steps .form-wizard-step-item').each(function(){--}}
{{--                                if(jQuery(this).attr('data-attr') == formAtrr){--}}
{{--                                    jQuery(this).addClass('active');--}}
{{--                                    var innerWidth = jQuery(this).innerWidth();--}}
{{--                                    var position = jQuery(this).position();--}}
{{--                                    jQuery(document).find('.form-wizard-step-move').css({"left": position.left, "width": innerWidth});--}}
{{--                                }else{--}}
{{--                                    jQuery(this).removeClass('active');--}}
{{--                                }--}}
{{--                            });--}}
{{--                        }--}}
{{--                    });--}}
{{--                }--}}
{{--            });--}}
{{--            //click on previous button--}}
{{--            jQuery('.form-wizard-previous-btn').click(function() {--}}
{{--                var counter = parseInt(jQuery(".wizard-counter").text());;--}}
{{--                var prev =jQuery(this);--}}
{{--                var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps .active');--}}
{{--                prev.parents('.wizard-fieldset').removeClass("show","400");--}}
{{--                prev.parents('.wizard-fieldset').prev('.wizard-fieldset').addClass("show","400");--}}
{{--                currentActiveStep.removeClass('active').prev().removeClass('activated').addClass('active',"400");--}}
{{--                jQuery(document).find('.wizard-fieldset').each(function(){--}}
{{--                    if(jQuery(this).hasClass('show')){--}}
{{--                        var formAtrr = jQuery(this).attr('data-tab-content');--}}
{{--                        jQuery(document).find('.form-wizard-steps .form-wizard-step-item').each(function(){--}}
{{--                            if(jQuery(this).attr('data-attr') == formAtrr){--}}
{{--                                jQuery(this).addClass('active');--}}
{{--                                var innerWidth = jQuery(this).innerWidth();--}}
{{--                                var position = jQuery(this).position();--}}
{{--                                jQuery(document).find('.form-wizard-step-move').css({"left": position.left, "width": innerWidth});--}}
{{--                            }else{--}}
{{--                                jQuery(this).removeClass('active');--}}
{{--                            }--}}
{{--                        });--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--            //click on form submit button--}}
{{--            jQuery(document).on("click",".form-wizard .form-wizard-submit" , function(){--}}
{{--                var parentFieldset = jQuery(this).parents('.wizard-fieldset');--}}
{{--                var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps .active');--}}
{{--                parentFieldset.find('.wizard-required').each(function() {--}}
{{--                    var thisValue = jQuery(this).val();--}}
{{--                    if( thisValue == "" ) {--}}
{{--                        jQuery(this).siblings(".wizard-form-error").slideDown();--}}
{{--                    }--}}
{{--                    else {--}}
{{--                        jQuery(this).siblings(".wizard-form-error").slideUp();--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--            // focus on input field check empty or not--}}
{{--            jQuery(".form-control").on('focus', function(){--}}
{{--                var tmpThis = jQuery(this).val();--}}
{{--                if(tmpThis == '' ) {--}}
{{--                    jQuery(this).parent().addClass("focus-input");--}}
{{--                }--}}
{{--                else if(tmpThis !='' ){--}}
{{--                    jQuery(this).parent().addClass("focus-input");--}}
{{--                }--}}
{{--            }).on('blur', function(){--}}
{{--                var tmpThis = jQuery(this).val();--}}
{{--                if(tmpThis == '' ) {--}}
{{--                    jQuery(this).parent().removeClass("focus-input");--}}
{{--                    jQuery(this).siblings('.wizard-form-error').slideDown("3000");--}}
{{--                }--}}
{{--                else if(tmpThis !='' ){--}}
{{--                    jQuery(this).parent().addClass("focus-input");--}}
{{--                    jQuery(this).siblings('.wizard-form-error').slideUp("3000");--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}

{{--    </script>--}}

{{--</x-guest-layout>--}}
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

<!-- Jquery -->
<script src="../../../../code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- custom JS -->
<script src="{{asset('auth/assets/js/custom.js')}}"></script>
</body>
