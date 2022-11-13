<x-guest-layout>
    <body class="inner_page login">
    <div id="loading-wrapper">
        <div class="spinner-border"></div>
        RENOMOBILEMONEY.......
    </div>
    <div class="full_container">
        <div class="container">
            <div class="center verticle_center full_height">
                <div class="login_section">
                    <div class="logo_login">
                        <div class="center">
                            <img width="110" src="{{asset("images/bn.jpeg")}}" alt="#" />
                        </div>
                    </div>


                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="login_form">
                        <center><h3 class="text-wh text-red">LOG-IN</h3></center>
                        <br>
                        <br>
                        <hr>
                        <center>
                        <a href="{{ route('google.login') }}" class="btn btn-outline-success btn-user" >
                            <i class="fa fa-google "></i>login With Google
                        </a>
                        </center>
                        <br>
                        <form method="POST" action="{{ route('log') }}">
                            @csrf
                            <fieldset>
                                <div class="field">

                                    <label class="label_field">Username</label>
                                    <x-jet-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus />
                                </div>

                                <div class="field">
                                    <label class="label_field">Password</label>
                                    <input  class="block mt-1 w-full" type="password" name="password" id="myInput" required autocomplete="current-password" />
                                </div>
                                <center>
                                    <input  type="checkbox" onclick="myFunction()">Show Password
                                </center>
                                <script>
                                    function myFunction() {
                                        var x = document.getElementById("myInput");
                                        if (x.type === "password") {
                                            x.type = "text";
                                        } else {
                                            x.type = "password";
                                        }
                                    }
                                </script>
                                <center>
                                    <div class="field">
                                        <label class="label_field hidden">hidden label</label>

                                        <label class="form-check-label"><input type="checkbox" id="remember_me" name="remember" class="form-check-input"> Remember Me</label>
                                        @if (Route::has('password.request'))
                                            <a class="forgot" href="{{ route('password.request') }}">Forgotten Password?</a>
                                        @endif
                                        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
                                        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

                                        <button type="submit" class="btn btn-primary" >Sign-in <span class="load loading"></span></button>
                                        <br>
                                        <center>
                                            <a  onclick="web2app.biometric.check(myCallback);"><h4 class="text-success"><i class='fas fa-fingerprint' style='font-size:36px'></i>
                                                    Fingerprint</h4>Login With </a>
                                        </center>
                                        <script>
                                            const btns = document.querySelectorAll('button');
                                            btns.forEach((items)=>{
                                                items.addEventListener('click',(evt)=>{
                                                    evt.target.classList.add('activeLoading');
                                                })
                                            })
                                        </script>
                                        <script>
                                            function myCallback(data) {
                                                console.log("I am in callback")
                                                console.log(JSON.stringify(data));
                                            }

                                            function contactCallback(data) {
                                                console.log("I am in callback")
                                                console.log(JSON.stringify(data));
                                                document.getElementById('anyme').value=data.data;
                                            }
                                        </script>
                                    </div>
                                </center>
                                <div class="field margin_0">
                                    <label class="label_field hidden">hidden label</label>
                                    <a href="{{ route('register') }}" ><button type="button" class="main_bt">Sign Up </button></a>
                                </div>
                            </fieldset>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{asset('hp/jquery.min.js')}}"></script>
    <script src="{{asset('hp/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('hp/modernizr.js')}}"></script>
    <script src="{{asset('hp/moment.js')}}"></script>
    <script src="{{asset('hp/main.js')}}"></script>

</x-guest-layout>
