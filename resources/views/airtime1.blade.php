
@include('layouts.sidebar')

<style>
    .subscribe {
        position: relative;
        padding: 20px;
        background-color: #FFF;
        border-radius: 4px;
        color: #333;
        box-shadow: 0px 0px 60px 5px rgba(0, 0, 0, 0.4);
    }

    .subscribe:after {
        position: absolute;
        content: "";
        right: -10px;
        bottom: 18px;
        width: 0;
        height: 0;
        border-left: 0px solid transparent;
        border-right: 10px solid transparent;
        border-bottom: 10px solid #208b37;
    }

    .subscribe p {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        letter-spacing: 4px;
        line-height: 28px;
    }



    .subscribe .submit-btn {
        position: absolute;
        border-radius: 30px;
        border-bottom-right-radius: 0;
        border-top-right-radius: 0;
        background-color: #208b37;
        color: #FFF;
        padding: 12px 25px;
        display: inline-block;
        font-size: 12px;
        font-weight: bold;
        letter-spacing: 5px;
        right: -10px;
        bottom: -20px;
        cursor: pointer;
        transition: all .25s ease;
        box-shadow: -5px 6px 20px 0px rgba(26, 26, 26, 0.4);
    }

    .subscribe .submit-btn:hover {
        background-color: #208b37;
        box-shadow: -5px 6px 20px 0px rgba(88, 88, 88, 0.569);
    }
</style>

<div style="padding:90px 15px 20px 15px">
    <!--    <h4 class="align-content-center text-center">Data Subscription</h4>-->





    <!--            <div class="box w3-card-4">-->

    @if(Auth::user()->pin !="0")
        <form action="{{ route('pin') }}" method="post">
            @else
                <form action="{{ route('buyairtime') }}" method="post">
                    @endif
        @csrf
                    <div class="row">
                        <div class="col-sm-8">
                            <br>
                            <br>
                            <div id="AirtimePanel">
                                <div class="subscribe">
                                    <p>AIRTIME PURCHASE</p>
                                    {{--                       <input placeholder="Your e-mail" class="subscribe-input" name="email" type="email">--}}
                                    <br/>
                                    <div id="div_id_network" class="form-group">
                                        <label for="network" class=" requiredField">
                                            Network<span class="asteriskField">*</span>
                                        </label>
                                        <div class="">
                                            <select name="id" class="text-success form-control" required="">

                                                <option value="m">MTN</option>
                                                <option value="g">GLO</option>
                                                <option value="a">AIRTEL</option>
                                                <option value="9">9MOBILE</option>

                                            </select>
                                        </div>
                                    </div>
                                    <br/>
                                    <div id="div_id_network" >
                                        <label for="network" class=" requiredField">
                                            Enter Amount<span class="asteriskField">*</span>
                                        </label>
                                        <div class="">
                                            <input type="number" name="amount" min="100" max="4000" class="text-success form-control" required>
                                        </div>
                                    </div>
                                    <br/>
                                    <div id="div_id_network" class="form-group">
                                        <label for="network" class=" requiredField">
                                            Enter Phone Number<span class="asteriskField">*</span>
                                        </label>
                                        <div class="">
                                            <input type="number" name="number" minlength="11" class="text-success form-control" required>
                                        </div>
                                    </div>
                                    <input type="hidden" name="refid" value="<?php echo rand(10000000, 999999999); ?>">
                                    <button type="submit" class="submit-btn">PURCHASE<span class="load loading"></span></button>
                                </div>


                                {{--                    <button type="submit" class=" btn btn-success" style="color: white;background-color: #28a745" id="warning"> Purchase Now<span class="load loading"></span></button>--}}
                                <script>
                                    const btns = document.querySelectorAll('button');
                                    btns.forEach((items)=>{
                                        items.addEventListener('click',(evt)=>{
                                            evt.target.classList.add('activeLoading');
                                        })
                                    })
                                </script>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.js"></script>
                                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                <script src="sweetalert2.all.min.js"></script>
                                <script>
                                    //Warning Message
                                    $('#warning').click(function () {
                                        swal({
                                            title: 'Are you sure?',
                                            text: "You won't be able to revert this!",
                                            type: 'warning',
                                            showCancelButton: true,
                                            cancelButtonClass: 'btn btn-danger',
                                            // cancelButtonUrl: window.location = "#";
                                            confirmButtonText: 'Yes, delete it!'
                                        }).then(function (result) {
                                            if (result.value) {
                                                console.log(window.url);
                                                window.location.href = "#";
                                            }
                                        });
                                    });

                                </script>


                            </div>


                        </div>
                        <div class="col-sm-4 ">
                            <br>

                            <p><b>You can use the codes below to check your Airtime Balance!  </b> </p>


                            <h6>
                                <ul class="list-group">
                                    <b><li class="list-group-item list-group-item-primary bold"> MTN *556#</li></b>
                                    <b><li class="list-group-item list-group-item-success">MTN [CG] *131*4# or *460*260#</li></b>
                                    <b><li class="list-group-item list-group-item-action">9mobile  *223#</li></b>
                                    <b><li class="list-group-item list-group-item-info">Airtel *123#</li></b>
                                    <b><li class="list-group-item list-group-item-secondary">Glo *124*0#</li></b>
                                </ul>
                            </h6>
                            <br>
                            <style>
                                img {
                                    max-width: 100%;
                                    height: auto;
                                }
                            </style>
                            <div class="card-body">
                                <div class="center">
                                    <img    src="{{asset('images/tp.jpeg')}}" alt="#" />
                                </div>
                            </div>

                            <br>




                        </div>
                    </div>

                    <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

    </form>


</div>


</div>


