@include('admin.layouts.sidebar')
<livewire:scripts />
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
<script src="{{ asset('js/Chart.min.js') }}"></script>

<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Dashboard</h2>
                </div>
            </div>
        </div>
{{--        <div class='alert alert-info'>--}}
{{--            <button type='button' class='close' data-dismiss='alert'>&times;</button>--}}
{{--            <i class='fa fa-ban-circle'></i><strong>Notification: </br></strong>Welcome Back {{\App\Console\encription::decryptdata($user->username)}}--}}
{{--        </div>--}}
        <div class="card">
            <div class="card-body">
                <div class="alert alert-secondary">
                    <div class="card-body">
                        <center>
                            <!--                    <h4 class="w3-text-green"><b>&nbsp;&nbsp; &nbsp;&nbsp; <a class="w3-btn w3-green w3-border w3-round-large" href="with.php">Withdraw From MCD Wallet</a>-->
                            <a class="w3-btn w3-green w3-border w3-round-large" href="{{route('admin/credit')}}">Credit User</a>
                            <a class="w3-btn w3-green w3-border w3-round-large" href="{{route('admin/mcd')}}">Withdraw MCD Wallet</a>

                            <a class="w3-btn w3-green w3-border w3-round-large" href="{{route('admin/credit')}}">Refund User</a>
                            <a class="w3-btn w3-green w3-border w3-round-large" href="{{route('admin/charge')}}">Charge User</a>
                            <a class="w3-btn w3-green w3-border w3-round-large" href="#">Withdraw MCD Commission</a>

                            <!--                            <a class="w3-btn w3-green w3-border w3-round-large" href="method.php">All Payment Method</a>-->
                        </center>
                    </div>
                    </b></h4>  	</div>
            </div>
        </div>
        <br>
{{--        <canvas id="transactionChart" width="400" height="200"></canvas>--}}

        <div class="row">
            <div style="width: 80%; margin: 0 auto;">
                <canvas id="transactionChart" width="800" height="400"></canvas>
            </div>
            <div class="row column1">
                <div class="col-md-6 col-lg-3">
                    <div class="full counter_section margin_bottom_30">
                        <div class="couter_icon">
                            <div>
                                <i class="fa fa-bars yellow_color"></i>
                            </div>
                        </div>
                        <div class="counter_no">
                            <div>
                                <h5 class="total_no text-center">{{$data['bill']}}</h5>
                                <h6 class="head_couter">Number Of Today Bill</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="full counter_section margin_bottom_30">
                        <div class="couter_icon">
                            <div>
                                <i class="fa fa-bars blue1_color"></i>
                            </div>
                        </div>
                        <div class="counter_no">
                            <div>
                                <h5 class="total_no text-center">{{$data['deposit']}}</h5>
                                <h6 class="head_couter">Number Of Today Deposit</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="full counter_section margin_bottom_30">
                        <div class="couter_icon">
                            <div>
                                <i class="fa fa-users green_color"></i>
                            </div>
                        </div>
                        <div class="counter_no">
                            <div>
                                <h5 class="total_no text-center">{{$data['user']}}</h5>
                                <h6 class="head_couter">Today New Users</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="full counter_section margin_bottom_30">
                        <div class="couter_icon">
                            <div>
                                <i class="fa fa-users yellow_color"></i>
                            </div>
                        </div>
                        <div class="counter_no">
                            <div>
                                <h5 class="total_no text-center">{{$data['nou']}}</h5>
                                <h6 class="head_couter">Number of Today Visitors</h6>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </div>
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
                                <h5 class="total_no text-center">₦{{number_format(intval($data['sum_deposits'] *1),2)}}</h5>

                                <h6 class="head_couter">Today Total Deposits</h6>
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

                                <h5 class="total_no text-center">₦{{ number_format(intval($data['sum_bill'] *1),2)}}</h5>
                                <h6 class="head_couter">Today Total Purchase</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <div class="row">
            <div class="row column1">
                <div class="col-md-6 col-lg-3">
                    <div class="full counter_section margin_bottom_30">
                        <div class="couter_icon">
                            <div>
                                <i class="fa fa-google-wallet yellow_color"></i>
                            </div>
                        </div>
                        <div class="counter_no">
                            <div>
                                <h5 class="total_no text-center">₦{{ number_format(intval($totalwallet *1),2)}}</h5>
                                <h6 class="head_couter">All User Balance</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="full counter_section margin_bottom_30">
                        <div class="couter_icon">
                            <div>
                                <i class="fa fa-money blue1_color"></i>
                            </div>
                        </div>
                        <div class="counter_no">
                            <div>
                                <h5 class="total_no text-center">₦{{ number_format(intval($totaldeposite *1),2)}}</h5>
                                <h6 class="head_couter">All Total Deposit</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="full counter_section margin_bottom_30">
                        <div class="couter_icon">
                            <div>
                                <i class="fa fa-money green_color"></i>
                            </div>
                        </div>
                        <div class="counter_no">
                            <div>
                                <h5 class="total_no text-center">₦{{number_format(intval($bill *1),2)}}</h5>
                                <h6 class="head_couter">All Total Bills</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="full counter_section margin_bottom_30">
                        <div class="couter_icon">
                            <div>
                                <i class="fa fa-users yellow_color"></i>
                            </div>
                        </div>
                        <div class="counter_no">
                            <div>
                                <h5 class="total_no text-center">{{$alluser}}</h5>
                                <h6 class="head_couter">Total Users</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row column1">
                <div class="col-md-6 col-lg-3">
                    <div class="full counter_section margin_bottom_30">
                        <div class="couter_icon">
                            <div>
                                <i class="fa fa-money yellow_color"></i>
                            </div>
                        </div>
                        <div class="counter_no">
                            <div>
                                <h5 class="total_no text-center">₦{{number_format(intval($tran *1),2)}}</h5>

                                <h6 class="head_couter">MCD Balance</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="full counter_section margin_bottom_30">
                        <div class="couter_icon">
                            <div>
                                <i class="fa fa-money blue1_color"></i>
                            </div>
                        </div>
                        <div class="counter_no">
                            <div>

                                <h5 class="total_no text-center">₦{{ number_format(intval($lock *1),2)}}</h5>
                                <h6 class="head_couter">Airtime Discounts</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="full counter_section margin_bottom_30">
                        <div class="couter_icon">
                            <div>
                                <i class="fa fa-money yellow_color"></i>
                            </div>
                        </div>
                        <div class="counter_no">
                            <div>
                                <h5 class="total_no text-center">₦{{number_format(intval($profit1 *1),2)}}</h5>

                                <h6 class="head_couter">Honorword Profit</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="full counter_section margin_bottom_30">
                        <div class="couter_icon">
                            <div>
                                <i class="fa fa-money blue1_color"></i>
                            </div>
                        </div>
                        <div class="counter_no">
                            <div>

                                <h5 class="total_no text-center">₦{{ number_format(intval($mo *1),2)}}</h5>
                                <h6 class="head_couter">Total Savelock</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                <h5 class="total_no text-center">₦{{ number_format(intval($totalcharge *1),2)}}</h5>
                                <h6 class="head_couter">Total Charges</h6>
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
                                <h5 class="total_no text-center">₦{{number_format(intval($totalprofit *1),2)}}</h5>
                                <h6 class="head_couter">MCD Profit</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- /.row -->
        <br>
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Deposit History</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="data-table-buttons" class="table table-striped table-bordered align-middle">
                        <thead>
                        <th class="table-active"> Username </th>
                        <th> Transaction Id </th>
                        <th> Date</th>
                        <th>Amount</th>
                        </thead>
                        <tbody>
                        @foreach($deposite as $de)
                            <tr>
                                <td>{{\App\Console\encription::decryptdata($de->username)}}</td>
                                <td>{{$de->payment_ref}}</td>
                                <td>{{$de->date}}</td>
                                <td>{{$de->amount}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    fetch('/transactions')
        .then(response => response.json())
        .then(data => {
            var ctx = document.getElementById('transactionChart').getContext('2d');

            var chart = new Chart(ctx, {
                type: 'area',
                data: {
                    labels: data.dates,
                    datasets: [{
                        label: 'Transaction Amount',
                        backgroundColor: 'rgb(53,169,21)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        data: data.amounts,
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
            $(function () {
                "use strict";
                // Bar chart
                new Chart(document.getElementById("bar-chart"), {
                    type: 'bar',
                    data: {
                        labels: ["Total Users Wallet", "Total Bills", "Deposits"],
                        datasets: [
                            {
                                label: "Population (millions)",
                                backgroundColor: ["#03a9f4", "#e861ff","#08ccce"],
                                data: [200000,300000,400000]
                            }
                        ]
                    },
                    options: {
                        legend: { display: false },
                        title: {
                            display: true,
                            text: 'System Payment Chart'
                        }
                    }
                });


                // line second
            });
        </script>

        <script>
            // Horizental Bar Chart
            new Chart(document.getElementById("bar-chart-horizontal"), {
                type: 'horizontalBar',
                data: {
                    labels: ["All Users", "Active Users"],
                    datasets: [
                        {
                            label: "Total Users",
                            backgroundColor: ["#0000FF","#00FF00"],
                            data: [250,200]
                        }
                    ]
                },
                options: {
                    legend: { display: false },
                    title: {
                        display: true,
                        text: 'System Customers Chart'
                    }
                }
            });
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

