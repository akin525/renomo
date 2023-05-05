@include('layouts.sidebar')

<script src="{{asset('asset/js/vendor.min.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>
<script src="{{asset('asset/js/app.min.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>
<script src="{{asset('asset/js/theme/default.min.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>

{{--@livewireChartsScripts--}}
<script>
    $(document).ready(function() {
        toastr.options.timeOut = 60000;
        @if (Session::has('error'))
        toastr.error('{{ Session::get('error') }}');
        @elseif(Session::has('success'))
        toastr.success('{{ Session::get('success') }}');
        @endif
    });

</script>
@foreach($give as $away)
    <script>
        $(document).ready(function() {
            toastr.options.timeOut = 60000;
            toastr.info('{{\App\Console\encription::decryptdata( $away->username) }} just create giveaway👊  of {{$away->product}} claim it now <button type="button" class="btn btn-success" onclick="toastr.clear()">Claim Now</button>');
        });
    </script>
@endforeach
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>My Dashboard</h2>
                </div>
            </div>
        </div>
        <h5 class="text-success"><b>{{$greet}} {{\App\Console\encription::decryptdata(Auth::user()->name)}}</b></h5>
        <div class="card">
            <div class="card-body">
                <div class="alert alert-success">
                    <ul style="list-style-type:square">
                        <li><h5 class="text-white"><b>{{$me->message}}.</b></h5></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="alert alert-secondary">
                <center>
                            <!--                    <h4 class="w3-text-green"><b>&nbsp;&nbsp; &nbsp;&nbsp; <a class="w3-btn w3-green w3-border w3-round-large" href="with.php">Withdraw From MCD Wallet</a>-->
                            <a class="badge badge-info" href="{{route('invoice')}}">Get Invoice</a>
                            <a class="badge badge-info" href="{{route('withdraw')}}">Withdraw</a>


                            <a class="badge badge-info" href="{{route('giveaway')}}">Create Giveaway</a>
                            <a class="badge badge-info" href="{{url('verifybill')}}">Validate Biils</a>
                            <a class="badge badge-info" href="{{url('verifydeposit')}}">Validate Deposit</a>

                            <!--                            <a class="w3-btn w3-green w3-border w3-round-large" href="method.php">All Payment Method</a>-->
                        </center>
                </div>
                    </div>
        </div>


        {{--        <marquee width="100%" direction="left" height="100px" class="text-success"><h4 class="text-success">--}}
{{--                {{$me->message}}.</h4></marquee>--}}
        <div class="card">
            <div class="card-body">
                <div class="alert alert-success">

                    @foreach($wallet as $wallet1)

                        @if ($wallet1->account_number==1 && $wallet1->account_name==1)

                            <div class="row column1">
                                <div class="col-md-7 col-lg-6">
                                    <div class="card-body">
                                        <ul style="list-style-type:square">
                                            <li class="text-white"><h3 class="text-white"><b>Personal Vertual Account Number</b></h3></li>
                                            <br>
                                            <li class='text-white'><h5 class="text-white"><b>{{$wallet1->account_name1}}</b></h5></li>
                                            <li class='text-white'><h5 class="text-white"><b>Account No:{{$wallet1->account_number1}}</b></h5></li>
                                            <li class='text-white'><h5 class="text-white"><b>{{$wallet1->bank}}</b></h5></li>
                                            <br>
                                            <li class='text-white'><h5 class="text-white"><b>Note: All vertual funding are being set automatically</b></h5></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-7 col-lg-6">
                                    <div>
                                        <center>
                                            <a href="#">
                                                <img width="200" src="{{asset("images/bn.jpeg")}}"  alt="">
                                            </a>
                                        </center>
                                    </div>
                                </div>
                            </div>
{{--                            <a href='{{route('vertual')}}' class='text-white'>Click this section to get your permament Virtual Bank Account (Transfer money to the account no to get your PrimeData Wallet funded instantly!)</a>--}}
                        @elseif ($wallet1->account_number!=1 && $wallet1->account_name!=1)
                            <div class="row column1">
                                <div class="col-md-7 col-lg-6">
                                    <div class="card-body">
                                        <ul style="list-style-type:square">
                                            <li class="text-white"><h3 class="text-white"><b>Personal Vertual Account Number</b></h3></li>
                                            <br>
                                            <li class='text-white'><h5 class="text-white"><b>{{$wallet1->account_name}}</b></h5></li>
                                            <li class='text-white'><h5 class="text-white"><b>Account No:{{$wallet1->account_number}}</b></h5></li>
                                            <li class='text-white'><h5 class="text-white"><b>WEMA-BANK</b></h5></li>
                                            <br>
                                            <li class='text-white'><h5 class="text-white"><b>Note: All vertual funding are being set automatically</b></h5></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-7 col-lg-6">
                                    <div>
                                        <center>
                                            <a href="#">
                                                <img width="200" src="{{asset("images/bn.jpeg")}}"  alt="">
                                            </a>
                                        </center>
                                    </div>
                                </div>
                            </div>

                        @endif
                    @endforeach
                </div>
            </div>
        </div>


        <br>

        <style>
            .tooltip {
                position: relative;
                display: inline-block;
            }

            .tooltip .tooltiptext {
                visibility: hidden;
                width: 140px;
                background-color: #555;
                color: #fff;
                text-align: center;
                border-radius: 6px;
                padding: 5px;
                position: absolute;
                z-index: 1;
                bottom: 150%;
                left: 50%;
                margin-left: -75px;
                opacity: 0;
                transition: opacity 0.3s;
            }

            .tooltip .tooltiptext::after {
                content: "";
                position: absolute;
                top: 100%;
                left: 50%;
                margin-left: -5px;
                border-width: 5px;
                border-style: solid;
                border-color: #555 transparent transparent transparent;
            }

            .tooltip:hover .tooltiptext {
                visibility: visible;
                opacity: 1;
            }

        </style>
        <div class="card">
            <div class="card-body">
                <h6>Your Referal Link</h6>
                <!-- The text field -->
                <input id="myInput" type="text" class="form-control" value="https://renomobilemoney.com/register?refer={{$user->username}}" >

                <!-- The button used to copy the text -->
                <button class="btn-info" onclick="myFunction()">Copy Referal Link</button>
            </div>
        </div>


        <script>
            function myFunction() {
                /* Get the text field */
                var copyText = document.getElementById("myInput");

                /* Select the text field */
                copyText.select();
                copyText.setSelectionRange(0, 99999); /* For mobile devices */

                /* Copy the text inside the text field */
                navigator.clipboard.writeText(copyText.value);

                /* Alert the copied text */
                alert( copyText.value);
            }
        </script>
        <br>
    <br>
    <div class="row column1">
        <div class="col-md-6 col-lg-4">
            <div class="full counter_section margin_bottom_30">
                <div class="couter_icon">
                    <div>
                        <i class="fa fa-google-wallet yellow_color"></i>
                    </div>
                </div>
                <div class="counter_no">
                    <div>
                        <h5 class="total_no text-center">₦{{number_format(intval($wallet1->balance *1),2)}}</h5>
                        <h6 class="head_couter">Wallet Balance</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="full counter_section margin_bottom_30">
                <div class="couter_icon">
                    <div>
                        <i class="fa fa-money blue1_color"></i>
                    </div>
                </div>
                <div class="counter_no">
                    <div>
                        <h5 class="total_no text-center">₦{{number_format(intval($totaldeposite *1), 2)}}</h5>
                        <h6 class="head_couter">Total Deposit</h6>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="full counter_section margin_bottom_30">
                <div class="couter_icon">
                    <div>
                        <i class="fa fa-money green_color"></i>
                    </div>
                </div>
                <div class="counter_no">
                    <div>
                        <h5 class="total_no text-center">₦{{number_format(intval($bill *1),2)}}</h5>
                        <h6 class="head_couter">Total Bills</h6>
                    </div>
                </div>
            </div>
        </div>

    </div>

        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <div class="row column1">
        <div class="col-md-7 col-lg-6">
            <div class="full counter_section margin_bottom_30">
                <div class="couter_icon">
                    <div>
                        <i class="fa fa-money yellow_color"></i>
                    </div>
                </div>
                <div class="counter_no">
                    <div>
                        <h5 class="total_no text-center">₦{{number_format(intval($lock *1),2)}}</h5>
                        <h6 class="head_couter">Safelock Balance</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 col-lg-6">
            <div class="full counter_section margin_bottom_30">
                <div class="couter_icon">
                    <div>
                        <i class="fa fa-money blue1_color"></i>
                    </div>
                </div>
                <div class="counter_no">
                    <div>
                        <h5 class="total_no text-center">₦{{number_format(intval($totalrefer *1),2)}}</h5>
                        <h6 class="head_couter">Referal Bonus</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="row column3">
            <div class="col-md-6">
            <div class="dark_bg full margin_bottom_30">
                <div class="full graph_head">
                    <div class="heading1 margin_0">
                        <h2>Your Last Deposit</h2>
                    </div>
                </div>
                <div class="full graph_revenue">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="content testimonial">
                                <div id="testimonial_slider" class="carousel slide" data-ride="carousel">
                                    <!-- Wrapper for carousel items -->
                                    <div class="carousel-inner">
                                        @foreach($pam as $deposit)
                                        <div class="item carousel-item active">
                                            <div class="img-box"><img src="https://renomobilemoney.com/images/bn.jpeg" alt=""></div>
                                            <p class="testimonial">Your Account Was Funded With ₦{{number_format(intval($deposit->amount *1),2)}} On {{$deposit->date}}.</p>
                                            <p class="overview"><b>Payment Confirmed</b>By Admin</p>
                                        </div>
                                        @endforeach
                                            @foreach($pam1 as $deposit1)
                                            <div class="item carousel-item">
                                                <div class="img-box"><img src="https://renomobilemoney.com/images/bn.jpeg" alt=""></div>
                                                <p class="testimonial">Your Account Was Funded With ₦{{number_format(intval($deposit1->amount *1),2)}} On {{$deposit1->date}}.</p>
                                                <p class="overview"><b>Payment Confirmed</b>By Admin</p>
                                            </div>
                                            @endforeach
                                    </div>
                                    <!-- Carousel controls -->
                                    <a class="carousel-control left carousel-control-prev" href="#testimonial_slider" data-slide="prev">
                                        <i class="fa fa-angle-left"></i>
                                    </a>
                                    <a class="carousel-control right carousel-control-next" href="#testimonial_slider" data-slide="next">
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <div class="col-md-6">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <div class="heading1 margin_0">
                            <h2>Progress Bar</h2>
                        </div>
                    </div>
                    <div class="full progress_bar_inner">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="progress_bar">
                                    <!-- Skill Bars -->
                                    <span class="skill" style="width: 80%;">Total Deposit<span class="info_valume">{{$cdeposite}}</span></span>
                                    <div class="progress skill-bar ">
                                        <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="{{$cdeposite}}" aria-valuemin="0" aria-valuemax="1000" style="width: {{$cdeposite}}%;">
                                        </div>
                                    </div>
                                    <span class="skill" style="width:80%;">Total Purchase<span class="info_valume">{{$cbill}}</span></span>
                                    <div class="progress skill-bar ">
                                        <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="{{$cbill}}" aria-valuemin="0" aria-valuemax="1000" style="width: {{$cbill}}%;">
                                        </div>
                                    </div>
                                    <span class="skill" style="width:80%;">Total Giveaway<span class="info_valume">{{$cgive}}</span></span>
                                    <div class="progress skill-bar ">
                                        <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="{{$cgive}}" aria-valuemin="0" aria-valuemax="1000" style="width: {{$cgive}}%;">
                                        </div>
                                    </div>
                                    <span class="skill" style="width:80%;">Total All Transaction<span class="info_valume">{{$all}}</span></span>
                                    <div class="progress skill-bar ">
                                        <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="{{$all}}" aria-valuemin="0" aria-valuemax="1000" style="width: {{$all}}%;">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>


</div>

<script src="{{asset('asset/datatables.net/js/jquery.dataTables.min.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>
<script src="{{asset('asset/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>
<script src="{{asset('asset/datatables.net-responsive/js/dataTables.responsive.min.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>
<script src="{{asset('asset/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>
<script src="{{asset('asset/js/demo/table-manage-default.demo.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>
<script src="{{asset('asset/%40highlightjs/cdn-assets/highlight.min.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>
<script src="{{asset('asset/js/demo/render.highlight.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>


<script src="{{asset('asset/datatables.net/js/jquery.dataTables.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
<script src="{{asset('asset/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
<script src={{asset('"asset/datatables.net-responsive/js/dataTables.responsive.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
<script src="{{asset('asset/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
<script src="{{asset('asset/datatables.net-buttons/js/dataTables.buttons.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
<script src="{{asset('asset/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
<script src="{{asset('asset/datatables.net-buttons/js/buttons.colVis.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
<script src="{{asset('asset/datatables.net-buttons/js/buttons.flash.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
<script src="{{asset('asset/datatables.net-buttons/js/buttons.html5.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
<script src="{{asset('asset/datatables.net-buttons/js/buttons.print.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
<script src="{{asset('asset/pdfmake/build/pdfmake.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
<script src="{{asset('asset/pdfmake/build/vfs_fonts.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
<script src="{{asset('asset/jszip/dist/jszip.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
<script src="{{asset('asset/js/demo/table-manage-buttons.demo.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
<script src="{{asset('asset/%40highlightjs/cdn-assets/highlight.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
<script src="{{asset('asset/js/demo/render.highlight.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
<script src="{{asset('cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js')}}" data-cf-settings="f1e2722e35a43ad4c1e3a0c8-|49" defer=""></script><script defer src="../../../../static.cloudflareinsights.com/beacon.min.js" data-cf-beacon='{"rayId":"6a910724bd190718","version":"2021.10.0","r":1,"token":"4db8c6ef997743fda032d4f73cfeff63","si":100}'></script>

