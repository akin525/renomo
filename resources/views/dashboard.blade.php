@include('layouts.sidebar')

<script src="{{asset('asset/js/vendor.min.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>
<script src="{{asset('asset/js/app.min.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>
<script src="{{asset('asset/js/theme/default.min.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>
<script src="{{ asset('js/Chart.min.js') }}"></script>

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
        <div class="alert alert-info alert-dismissible alert-alt fade show">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
            </button>
            <strong>Alert!</strong> {{$me->message}}.
        </div>
{{--        <div class="card">--}}
{{--            <div class="card-body">--}}
{{--                <div class="alert alert-success">--}}
{{--                    <ul style="list-style-type:square">--}}
{{--                        <li><h5 class="text-white"><b>{{$me->message}}.</b></h5></li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="row">
            <div class="col-xl-6">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="any-card">
                            <div class="c-con">
                                <h4 class="heading mb-0">{{$greet}} <strong>{{\App\Console\encription::decryptdata(Auth::user()->username)}}!!</strong><img  src="#" alt=""></h4>
                                {{--                                <span>Best seller of the week</span>--}}
                                {{--                                <p class="mt-3">{{$me->message}}</p>--}}

                                <h6>Your Referal Link</h6>
                                <!-- The text field -->
                                <input id="myInput" type="text" class="form-control" value="https://renomobilemoney.com/register?refer={{$user->username}}" >

                                <!-- The button used to copy the text -->
                                <button class="btn btn-info mb-1" onclick="myFunction()">Copy Link</button>

                                <a href="{{route('myaccount')}}" class="btn btn-primary btn-sm">View Profile</a>
                            </div>
                            <img  src="{{asset('deve.png')}}" class="harry-img" alt="">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary">
                    <div class="card-header border-0">
                        <h4 class="heading mb-0 text-white">Balance & Deposit 😎</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="sales-bx">
                                <i class="fa fa-money yellow_color" style="font-size: 30px"></i>
                                <h4>₦{{number_format(intval($wallet1->balance *1))}}</h4>
                                <span>Balance</span>
                            </div>
                            <div class="sales-bx">
                                <i class="fa fa-money blue1_color" style="font-size: 30px"></i>
                                <h4>₦{{number_format(intval($totaldeposite *1))}}</h4>
                                <span>Total Deposit</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-secondary">
                    <div class="card-header border-0">
                        <h4 class="heading mb-0 text-white">Purchase & Safelock 😎</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="sales-bx">
                                <i class="fa fa-money yellow_color" style="font-size: 30px;"></i>
                                <h4>₦{{number_format(intval($bill *1))}}</h4>
                                <span>Total Bills</span>
                            </div>
                            <div class="sales-bx">
                                <i class="fa fa-lock yellow_color" style="font-size: 30px"></i>
                                <h4>₦{{number_format(intval($lock *1))}}</h4>
                                <span>Total Safelock</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-7 col-lg-6">
                <div class="card">
                    <canvas id="transactionChart" width="800" height="500"></canvas>
                </div>
            </div>
            <div class="col-md-7 col-lg-6">
                <div class="card">
                    <canvas id="transactionChart1" width="800" height="500"></canvas>
                </div>
            </div>
        </div>

            <div class="col-xl-12">
                <div class="card bg-secondary analytics-card">
                    <div class="card-body mt-4 pb-1">
                        <div class="row align-items-center">
                            <div class="col-xl-2">
                                <h3 class="mb-3 text-white">Solution</h3>
                                <p class="mb-0  pb-4 text-white">Validate all  <br>pending transaction</p>
                            </div>
                            <div class="col-xl-10">
                                <div class="row">
                                    <div class="col-xl-2 col-sm-4 col-6">
                                        <div class="card ov-card">
                                            <div class="card-body">
                                               <a href="{{route('invoice')}}"> <div class="ana-box">
                                                    <div class="ic-n-bx">
                                                        <div class="icon-box bg-primary ">
                                                            <i class="fa fa-book text-white"></i>
                                                        </div>
                                                    </div>
                                                    <div class="anta-data">
                                                        <h5>Invoice</h5>
                                                        <span>Check Bills</span>
{{--                                                        <h3>+23%</h3>--}}
                                                    </div>
                                                </div>
                                               </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-sm-4 col-6">
                                        <div class="card ov-card">
                                            <div class="card-body">
                                                <a href="{{route('withdraw')}}"> <div class="ana-box">
                                                    <div class="ic-n-bx">
                                                        <div class="icon-box bg-primary">
                                                            <i class="fa fa-brands fa-money text-white"></i>
                                                        </div>
                                                    </div>
                                                    <div class="anta-data">
                                                        <h5>Withdraw</h5>
                                                        <span>from wallet</span>
{{--                                                        <h3>-33%</h3>--}}
                                                    </div>
                                                </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-sm-4 col-6">
                                        <div class="card ov-card">
                                            <div class="card-body">
                                                <a href="{{route('giveaway')}}"> <div class="ana-box">
                                                    <div class="ic-n-bx">
                                                        <div class="icon-box bg-primary">
                                                            <i class="fa fa-brands fa-amazon text-white"></i>
                                                        </div>
                                                    </div>
                                                    <div class="anta-data">
                                                        <h5>Giveaway</h5>
                                                        <span>Bonus</span>
{{--                                                        <h3>-23%</h3>--}}
                                                    </div>
                                                </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-sm-4 col-6">
                                        <div class="card ov-card">
                                            <div class="card-body">
                                                <a href="{{url('verifybill')}}"> <div class="ana-box">
                                                    <div class="ic-n-bx">
                                                        <div class="icon-box bg-primary">
                                                            <i class=" fa fa-brands fa-bookmark text-white"></i>
                                                        </div>
                                                    </div>
                                                    <div class="anta-data">
                                                        <h5>Validate</h5>
                                                        <span>Bills</span>
{{--                                                        <h3>+25%</h3>--}}
                                                    </div>
                                                </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-sm-4 col-6">
                                        <div class="card ov-card">
                                            <div class="card-body">
                                                <a href="{{url('verifydeposit')}}"> <div class="ana-box">
                                                    <div class="ic-n-bx">
                                                        <div class="icon-box bg-primary ">
                                                            <i class="fa fa-brands fa-money text-white"></i>
                                                        </div>
                                                    </div>
                                                    <div class="anta-data">
                                                        <h5>Validate</h5>
                                                        <span>Deposit</span>
{{--                                                        <h3>+30%</h3>--}}
                                                    </div>
                                                </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-sm-4 col-6">
                                        <div class="card ov-card">
                                            <div class="card-body">
                                                <a href="{{route('airtime')}}"> <div class="ana-box">
                                                    <div class="ic-n-bx">
                                                        <div class="icon-box bg-primary ">
                                                            <i class="fa fa-brands fa-mobile-phone text-white"></i>
                                                        </div>
                                                    </div>
                                                    <div class="anta-data">
                                                        <h5>Airtime</h5>
                                                        <span>Purchase</span>
{{--                                                        <h3>-32%</h3>--}}
                                                    </div>
                                                </div>
                                                </a>
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

        <div class="row">
            @foreach($wallet as $wallet1)
                @if ($wallet1->account_number1!=1 && $wallet1->account_name1!=1)
                <div class="col-xl-6">
                <div class="card overflow-hidden">
                    <div class="card-body bg-secondary">
                        <div class="any-card">
                            <div class="c-con">
                                <h4 class="heading mb-0 text-white">Virtual <strong>Account 1</strong><img  src="#" alt=""></h4>
                                        <div class="card-body">
                                            <ul style="list-style-type:square">
                                                <li class='text-white'><h5 class="text-white"><b>{{$wallet1->account_name1}}</b></h5></li>
                                                <li class='text-white'><h5 class="text-white"><b>Account No:{{$wallet1->account_number1}}</b></h5></li>
                                                <li class='text-white'><h5 class="text-white"><b>{{$wallet1->bank}}</b></h5></li>
                                            </ul>
                                        </div>
                            </div>
                            <img  src="{{asset("images/bn.jpeg")}}" class="harry-img" alt="">
                        </div>
                    </div>
                </div>
                </div>
                                @endif

                                @if ($wallet1->account_number!=1 && $wallet1->account_name!=1)
                                    <div class="col-xl-6">
                                        <div class="card overflow-hidden">
                                            <div class="card-body bg-secondary">
                                                <div class="any-card">
                                                    <div class="c-con">
                                                        <h6 class="heading mb-0 text-white">Virtual <strong>Account 2</strong><img  src="#" alt=""></h6>
                                    <div class="card-body">
                                        <ul style="list-style-type:square">
                                            <li class='text-white'><h5 class='text-white'><b>{{$wallet1->account_name}}</b></h5></li>
                                            <li class='text-white'><h5 class='text-white'><b>Account No:{{$wallet1->account_number}}</b></h5></li>
                                            <li class='text-white'><h5 class='text-white' ><b>WEMA-BANK</b></h5></li>
                                      </ul>
                                    </div>
                            </div>
                            <img  src="{{asset("images/bn.jpeg")}}" class="harry-img" alt="">

                        </div>
                    </div>
                </div>
            </div>
                    @else
                        <a href="{{route('vertual')}}" class="btn btn-primary btn-sm">Generate account</a>

                    @endif
            @endforeach

        </div>



        {{--        <marquee width="100%" direction="left" height="100px" class="text-success"><h4 class="text-success">--}}
{{--                {{$me->message}}.</h4></marquee>--}}
        <br>


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


        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


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
                         t           <a class="carousel-control left carousel-control-prev" href="#testimonial_slider" data-slide="prev">
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
<script>
    fetch('/transaction')
        .then(response => response.json())
        .then(data => {
            var ctx = document.getElementById('transactionChart').getContext('2d');

            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.dates,
                    datasets: [{
                        label: 'Deposit Amount',
                        data: data.amounts,
                        backgroundColor: 'rgba(53, 169, 21, 0.5)',
                        borderColor: 'rgba(53, 169, 21, 1)',
                        borderWidth: 1,
                        fill: 'origin' // Fill the area below the line

                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
</script>
<script>
    fetch('/transaction1')
        .then(response => response.json())
        .then(data => {
            var ctx = document.getElementById('transactionChart1').getContext('2d');

            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.dates,
                    datasets: [{
                        label: 'Purchase Charts',
                        data: data.amounts,
                        backgroundColor: 'rgb(169,137,21)',
                        borderColor: 'rgb(169,137,21)',
                        borderWidth: 1,
                        fill: 'origin' // Fill the area below the line

                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
</script>

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

