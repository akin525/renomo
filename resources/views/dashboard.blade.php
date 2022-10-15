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
        <div class="card">
            <div class="card-body">
                <div class="alert alert-success">
                    <ul style="list-style-type:square">
                        <li><h4 class="text-white"><b>{{$me->message}}.</b></h4></li>
                    </ul>
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
                            <a href='{{route('vertual')}}' class='text-white'>Click this section to get your permament Virtual Bank Account (Transfer money to the account no to get your PrimeData Wallet funded instantly!)</a>
                        @else
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
            img {
                max-width: 100%;
                height: auto;
            }
        </style>
        <div class="card-body">
            <div class="center">
                <img    src="{{asset('images/banner.jpeg')}}" alt="#" />
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
{{--        <div class="card">--}}
{{--            <div class="card-body">--}}
{{--                <h6>Your Referal Link</h6>--}}
{{--                <!-- The text field -->--}}
{{--                <input id="myInput" type="text" class="form-control" value="https://renomobilemoney.com/register?refer={{$user->username}}" >--}}

{{--                <!-- The button used to copy the text -->--}}
{{--                <button class="btn-info" onclick="myFunction()">Copy Referal Link</button>--}}
{{--            </div>--}}
{{--        </div>--}}


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

        <div class="row column1">
            <div class="col-md-7 col-lg-6">
                <div class="full counter_section margin_bottom_30">
                    <div class="counter_no">
                        <div>
                            <a href="{{route('waec')}}">
                            <img src="{{asset('img/wa.jpg')}}" alt="">
                            </a>
{{--                            <h5 class="total_no text-center">₦{{number_format(intval($lock *1),2)}}</h5>--}}
                            <h6 class="head_couter">Waec Result Checker</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-lg-6">
                <div class="full counter_section margin_bottom_30">
                    <div class="counter_no">
                        <div>
                            <a href="{{route('neco')}}">
                                <img height="100" src="{{asset('img/neco.jpg')}}"  alt="">
                            </a>
{{--                            <h5 class="total_no text-center">₦{{number_format(intval($totalrefer *1),2)}}</h5>--}}
                            <h6 class="head_couter">Neco Result Checker</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="content">
        <div class="module">
            <div class="module-head">
{{--                <h3>--}}
                    <!--                            My Invoice</h3>-->
            </div>
            <link href="{{asset('asset/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
            <link href="{{asset('asset/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
            <link href="{{asset('asset/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" />

            <div class="content">
                <div class="module">
                    <div class="module-head">
                        <div class="card">
                            <div class="card-body">
                                <h3>Transactions</h3>
                                <div class="table-responsive">
                                    <table id="data-table-buttons" class="table table-striped table-bordered align-middle">
                                        <thead>
                                            <th>Date</th>
                                            <th>Username</th>
                                            <th>Plan</th>
                                            <th>Amount</th>
                                            <th>Phone No</th>
                                            <th>Payment_Ref</th>
                                            <th>Token </th>
                                            <!--                                                    <th>Action</th>-->

                                        </thead>
                                        <tbody>
                                        @foreach($bil2 as $re)
                                            <tr>
                                                <td>{{$re->timestamp}}</td>
                                                <td>{{\App\Console\encription::decryptdata($re->username)}}</td>
                                                <td>{{$re->product}}</td>
                                                <td>{{$re->amount}}</td>
                                                <td>{{$re->number}}</td>
                                                <td>{{$re->transactionid}}</td>
                                                <td>{{$re->token}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
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

