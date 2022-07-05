<x-guest-layout>
    <body class="inner_page login">
    <div class="full_container">
        <div class="container">
            <div class="center verticle_center full_height">
                <div class="login_section">
                    <div class="logo_login">
                        <div class="center">
                            <img width="110" src="{{asset("images/bn.jpeg")}}" alt="#" />
                        </div>
                    </div>


                    <x-jet-validation-errors class="alert alert-success" />
                    <div class="login_form">
                        <center><h5 class="text-wh text-red">Primedata Reset Password</h5></center>
                        <br>
                        <br>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <fieldset>
                <div class="field">
                    <label class="label_field">Email</label>
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>


                    <div class="field">
                        <label class="label_field">Password</label>
                <x-jet-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
            </div>

                        <div class="field">
                            <label class="label_field">Confirm Password</label>
                <x-jet-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="btn btn-outline-cyan">
                <x-jet-button>
                    {{ __('Reset Password') }}
                </x-jet-button>
            </div>
                    </fieldset>
        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
