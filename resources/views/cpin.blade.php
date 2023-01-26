@include('layouts.sidebar')
<div class="full_container" style="background-color: darkgrey">
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
                    <center><h3 class="text-wh text-red"><b>Create Transaction Pin</b></h3></center>
                    <br>
                    <br>
                    <hr>
                    <center>
                    <x-jet-validation-errors class="alert alert-danger" />
                    </center>

                    <br>
                    <form method="POST" action="{{ route('cepin') }}">
                        @csrf
                        <fieldset>
                            <div class="field">

                                <label class="label_field">pin</label>
                                <x-jet-input id="pin" class="block mt-1 w-full" type="number" name="pin" minlength="4" :value="old('pin')" required autofocus />
                            </div>

                            <div class="field">
                                <label class="label_field">Confirm Pin</label>
                                <input  class="block mt-1 w-full" type="number" name="pin1" id="myInput" required autocomplete="current-password" />
                            </div>

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


{{--                                    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>--}}
{{--                                    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">--}}

                                    <button type="submit" class="btn btn-primary" >Create Now <span class="load loading"></span></button>
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

                        </fieldset>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
