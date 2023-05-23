@include('layouts.sidebar')
<br>
<br>
<br>
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <!--                                        <h4 class="font-weight-bold mb-0">--><?php //echo $name; ?><!--</h4>-->
            </div>
        </div>
        <!--                    <div class="col-xl-9 col-md-8">-->
        <div class="col-12 grid-margin stretch-card">
            <div class="card corona-gradient-card">
                <div class="card-body py-0 px-0 px-sm-3">

                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <br>
                <br>
                <div class='alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>Notification: </br></strong><b class='align-content-center'>Note That ₦1,000 Will be charged to upgrade your account to reseller</b></div>

                <div class='alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>Notification: </br></strong><b class='align-content-center'>Note that You can request for a website after you upgrade. You will have access to cheaper prices of products too! </b></div>
            </div>
        </div>
        <br>
        <style>
            img {
                max-width: 100%;
                height: auto;
            }
        </style>
        <div class="card-body">
            <div class="center">
                <img    src="{{asset('images/re.jpeg')}}" alt="#" />
            </div>
        </div>

        <br>


        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><i class="mdi mdi-wallet"></i>Wallet Balance</h4>
                        <div class="wallet-details">
                            <!--                                <span>Wallet Balance</span>-->
                            <h3>NGN {{$wallet->balance}}</h3>
                            <div class="d-flex justify-content-between my-4">
                                {{--                                Reselle Amount: NGN1,000--}}
                            </div>
                            <div class="wallet-progress-chart">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Reseller Fee</h4>
                        <!--                        --><?php
                        //                        if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        //
                        //                            $amou=intval(mysqli_real_escape_string($con,$_POST['amount']));
                        //
                        //                            print "
                        //                    <script>
                        //                        window.location = 'fun.php?amount=$amou';
                        //                    </script>
                        //                    ";
                        //                        }
                        //                        ?>
                        <form  action="{{route('mp')}}" method="post"  >
                            @csrf
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">

                                        <label class="form-control">NGN1,000</label>
                                    </div>
                                    <input type="number"  class="form-control" name="amount" value="1000" required readonly/>
                                </div>
                            </div>
                    </div>
                </div>
                <button class="btn btn-outline-info " type="submit">Upgrade Now<span class="load loading"></span></button>
                <br>
                <script>
                    const btns = document.querySelectorAll('button');
                    btns.forEach((items)=>{
                        items.addEventListener('click',(evt)=>{
                            evt.target.classList.add('activeLoading');
                        })
                    })
                </script>
                </form>
                <!--                <button class="btn btn-success btn-block withdraw-btn" type="submit" onClick="makePayment()"> Fund With Flutterwave</button>-->
                <!--                <script src="https://checkout.flutterwave.com/v3.js"> </script>-->

            </div>
        </div>
    </div>
