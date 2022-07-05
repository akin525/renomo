<x-guest-layout>
    <body class="inner_page login">
    <div id="loading-wrapper">
        <div class="spinner-border"></div>
        PRIMEDATA......
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



                    <div class="login_form">
                        <center><h3 class="text-wh text-red"><b>Admin Login</b></h3></center>
                        <br>
                        <br>
                        @if (session('status'))
                            <div class="alert alert-danger">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('cuslog') }}">
                            @csrf

                            <fieldset>
                                @if ($errors->has('email'))<div class='alert alert-danger text-white'>
                                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                    <i class='fa fa-ban-circle'></i>
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                </div>
                                @endif
{{--                                @if ($errors->has('password'))<div class='alert alert-danger'>--}}
{{--                                    <button type='button' class='close' data-dismiss='alert'>&times;</button>--}}
{{--                                    <i class='fa fa-ban-circle'></i>--}}
{{--                                    <span class="text-danger">{{ $errors->first('password') }}</span>--}}
{{--                                </div>--}}
{{--                                @endif--}}
                                <div class="field">

                                    <label class="label_field">Email</label>
                                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                                </div>

                                <div class="field">
                                    <label class="label_field">Password</label>
                                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                                </div>
                                <center>
                                    <div class="field">
                                        <label class="label_field hidden">hidden label</label>

                                        <label class="form-check-label"><input type="checkbox" id="remember_me" name="remember" class="form-check-input"> Remember Me</label>
                                        @if (Route::has('password.request'))
                                            <a class="forgot" href="{{ route('password.request') }}">Forgotten Password?</a>
                                        @endif
                                        <button type="submit" class="btn btn-success">Sign-in</button>
                                    </div>
                                </center>

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
