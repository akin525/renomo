@include('layouts.sidebar')
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
        <br>
        <style>
            img {
                max-width: 100%;
                height: auto;
            }
        </style>
        <div class="card-body">
            <div class="center">
                <img    src="{{asset('images/r.jpg')}}" alt="" />    <! --I intentionally disabled this sectin sir  (there was alt="#" in this place) -->
            </div>
        </div>

        <br>
        <div class="card">
            <div class="card-body">
                <br>
                <br>
                @foreach($data2 as $data)
                    <div class='alert alert-success'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <i class='fa fa-ban-circle'></i><strong>Notification: </br></strong><b class='align-content-center'>Note that ₦{{$data->charges}} will be charged On every Funding</b></div>

                    <div class='alert alert-success'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <i class='fa fa-ban-circle'></i><strong>Notification: </br></strong><b class='align-content-center'>Note that ₦{{$data->len}}  is the Minimum Funding Amount</b></div>
            </div>
        </div>



        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><i class="mdi mdi-wallet"></i>Wallet Balance</h4>
                        <div class="wallet-details">
                            <!--                                <span>Wallet Balance</span>-->
                            <h3>NGN {{$wallet->balance}}</h3>
                            <div class="d-flex justify-content-between my-4">
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
                        <h4 class="card-title">Enter Amount Below</h4>
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
                        <form  action="" method="post" id="paymentForm" >
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">

                                        <label class="form-control">NGN</label>
                                    </div>
                                    <input type="number" min="{{$data->len}}" maxlength="4" class="form-control" name="amount" id="amount" placeholder="00.00" required/>
                                </div>
                                @endforeach
                            </div>
                            <input type="hidden"  id="email-address" value="{{$user->email}}">
                    </div>
                </div>
                <button class="btn btn-outline-success btn-block withdraw-btn" type="submit" onclick="payWithPaystack()">Click Fund With Paystack</button>
                <script src="https://js.paystack.co/v1/inline.js"> </script>
                <br>
                {{--                <a href="fun.php"><button  type="button" class=" btn-block withdraw-btn"  >Fund With Transfer</button></a>--}}

                </form>
                <!--                <button class="btn btn-success btn-block withdraw-btn" type="submit" onClick="makePayment()"> Fund With Flutterwave</button>-->
                <!--                <script src="https://checkout.flutterwave.com/v3.js"> </script>-->

            </div>
        </div>

        <p>OR</p>
        <div class="card">
            <div class="card-body">
                <div class='alert alert-info'>
                    <button type='button' class='close'></button>
                    <i class='fa fa-ban-circle'></i><h6 class="text-center text-white">Transfer money to your Virtual Bank Account to get your PrimeData Wallet credited instantly! </br></h6>

                    <center>
                        <div class="card-body">
                            <li  class=" btn-info">
                                @if ($wallet->account_number==1 && $wallet->account_name==1)
                                    <a href='{{route('vertual')}}' class='text-white'>create Virtual Account To Fund Your Wallet Automatically</a>
                                @else
                                    <h6 class='text-white'>{{$wallet->account_name}}</h6>
                                    <h5 class='text-white'>Account No:{{$wallet->account_number}}</h5>
                                    <h6 class='text-white'>WEMA-BANK</h6>
                                @endif



                            </li>
                        </div>
                    </center>
                </div>
            </div>
        </div>
        <!--        <div class="row">-->
        <!--            <div class="col-md-7 grid-margin stretch-card">-->
        <br>
        <br>
        <link href="{{asset('asset/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
        <link href="{{asset('asset/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
        <link href="{{asset('asset/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" />

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Deposit Transaction</h5>
                <div class="table-responsive">
                    <table id="data-table-buttons" class="table table-striped table-bordered align-middle">
                        <thead>
                        <th>Date</th>
                        <th>Username</th>
                        <th>Amount Fund</th>
                        <th>Payment_Ref</th>
                        </thead>
                        <tbody>
                        @foreach($fund as $po)
                            <tr>
                                <td>{{$po->date}}</td>
                                <td>{{\App\Console\encription::decryptdata($po->username)}}</td>
                                <td>{{$po->amount}}</td>
                                <td>{{$po->payment_ref}}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        (function() {
            var options = {
                whatsapp: "+2348103153004", // WhatsApp number
                call_to_action: "Message us", // Call to action
                position: "left", // Position may be 'right' or 'left'
            };
            var proto = document.location.protocol,
                host = "whatshelp.io",
                url = proto + "//static." + host;
            var s = document.createElement('script');
            s.type = 'text/javascript';
            s.async = true;
            s.src = url + '/widget-send-button/js/init.js';
            s.onload = function() {
                WhWidgetSendButton.init(host, proto, options);
            };
            var x = document.getElementsByTagName('script')[0];
            x.parentNode.insertBefore(s, x);
        })();
    </script>


    <script src="{{asset('asset/js/vendor.min.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>
    <script src="{{asset('asset/js/app.min.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>
    <script src="{{asset('asset/js/theme/default.min.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>


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

    <script>
        const paymentForm = document.getElementById('paymentForm');
        paymentForm.addEventListener("submit", payWithPaystack, false);
        function payWithPaystack(e) {
            e.preventDefault();
            let handler = PaystackPop.setup({
                key: 'pk_live_735384abd090d0bacf543011c2094f5c60446956', // Replace with your public key
                email: document.getElementById("email-address").value,
                amount: document.getElementById("amount").value * 100,
                ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
// label: "Optional string that replaces customer email"
                onClose: function(){
                    alert('Window closed.');
                },
                callback: function(response){
                    let message = 'Payment complete! Reference: ' + response.reference;
                    // alert(message);


                    window.location = '{{ route('tran', '/') }}/'+response.reference;

                }
            });
            handler.openIframe();
        }
    </script>
    <!-- html -->
    <table id="data-table-buttons" class="table table-striped table-bordered align-middle">
        <thead>
        <tr>
            <th width="1%"></th>
            <th width="1%" data-orderable="false"></th>
            ...
        </tr>
        </thead>
        <tbody>
        ...
        </tbody>
    </table>

    <!-- script -->
    <script>
        $('#data-table-default').DataTable({
            responsive: true,
            dom: '<"row"<"col-sm-5"B><"col-sm-7"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>',
            buttons: [
                { extend: 'copy', className: 'btn-sm' },
                { extend: 'csv', className: 'btn-sm' },
                { extend: 'excel', className: 'btn-sm' },
                { extend: 'pdf', className: 'btn-sm' },
                { extend: 'print', className: 'btn-sm' }
            ],
        });
    </script>
