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
                                        <button type="submit" class="btn btn-primary" >Sign-in <span class="load loading"></span></button>
                                        <script>
                                            const btns = document.querySelectorAll('button');
                                            btns.forEach((items)=>{
                                                items.addEventListener('click',(evt)=>{
                                                    evt.target.classList.add('activeLoading');
                                                })
                                            })
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
