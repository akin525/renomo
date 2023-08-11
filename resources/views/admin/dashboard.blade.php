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
                <div class="bg bg-secondary">
                    <div class="card-body">
                        <center>
                            <!--                    <h4 class="w3-text-green"><b>&nbsp;&nbsp; &nbsp;&nbsp; <a class="w3-btn w3-green w3-border w3-round-large" href="with.php">Withdraw From MCD Wallet</a>-->
                            <button class="btn btn-success m-2"  data-bs-toggle="modal" data-bs-target="#creditModalCenter">Credit User</button>
                            <a class="btn btn-success m-2" href="{{route('admin/mcd')}}">Withdraw MCD Wallet</a>

                            <button class="btn btn-success m-2" data-bs-toggle="modal" data-bs-target="#fundModalCenter" >Refund User</button>
                            <button class="btn btn-success m-2" data-bs-toggle="modal" data-bs-target="#chargeModalCenter">Charge User</button>
{{--                            <a class="btn btn-success" href="#">Withdraw MCD Commission</a>--}}

                            <!--                            <a class="w3-btn w3-green w3-border w3-round-large" href="method.php">All Payment Method</a>-->
                        </center>
                    </div>
                    </b></h4>  	</div>
            </div>
        </div>
        <div class="modal fade" id="creditModalCenter">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="loading-overlay" id="loadingSpinner" style="display: none;">
                    <div class="loading-spinner"></div>
                </div>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Credit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <form id="dataForm">
                        @csrf
                        <div class="card card-body">

                            {{--                       <input placeholder="Your e-mail" class="subscribe-input" name="email" type="email">--}}
                            <div id="div_id_network" class="form-group">
                                <label for="network" class=" requiredField">
                                    Username<span class="asteriskField">*</span>
                                </label>
                                <div class="">
                                    <input type="text" id="username" name="username"  class="text-success form-control" required >
                                </div>
                            </div>
                            <br/>
                            <div id="div_id_network" >
                                <label for="network" class=" requiredField">
                                    Enter Amount<span class="asteriskField">*</span>
                                </label>
                                <div class="">
                                    <input type="number" id="amount" name="amount"  class="text-success form-control" required>
                                </div>
                            </div>
                            <br/>

                            <input type="hidden" name="refid" value="<?php echo rand(10000000, 999999999); ?>">
                            <button type="submit" class="btn btn-primary">Fund</button>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        {{--                        <button type="button" class="btn btn-primary">Save changes</button>--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="fundModalCenter">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="loading-overlay" id="loadingSpinner" style="display: none;">
                    <div class="loading-spinner"></div>
                </div>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Refund User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>

                    <form id="dataForm2">
                        @csrf
                        <div class="card card-body">

                            {{--                       <input placeholder="Your e-mail" class="subscribe-input" name="email" type="email">--}}
                            <div id="div_id_network" class="form-group">
                                <label for="network" class=" requiredField">
                                    Username<span class="asteriskField">*</span>
                                </label>
                                <div class="">
                                    <input type="text" id="username2" name="username"  class="text-success form-control" required >
                                </div>
                            </div>
                            <br/>
                            <div id="div_id_network" >
                                <label for="network" class=" requiredField">
                                    Enter Amount<span class="asteriskField">*</span>
                                </label>
                                <div class="">
                                    <input type="number" id="amount2" name="amount"  class="text-success form-control" required>
                                </div>
                            </div>
                            <br/>

                            <button type="submit" class="btn btn-primary">Refund</button>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        {{--                        <button type="button" class="btn btn-primary">Save changes</button>--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="chargeModalCenter">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Charge User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <form id="chargeForm">
                        @csrf
                        <div class="card card-body">

                            {{--                       <input placeholder="Your e-mail" class="subscribe-input" name="email" type="email">--}}
                            <div id="div_id_network" class="form-group">
                                <label for="network" class=" requiredField">
                                    Username<span class="asteriskField">*</span>
                                </label>
                                <div class="">
                                    <input type="text" id="username1" name="username"  class="text-success form-control" required >
                                </div>
                            </div>
                            <br/>
                            <div id="div_id_network" >
                                <label for="network" class=" requiredField">
                                    Enter Amount<span class="asteriskField">*</span>
                                </label>
                                <div class="">
                                    <input type="number" id="amount1" name="amount"  class="text-success form-control" required>
                                </div>
                            </div>
                            <br/>

                            <input type="hidden" name="refid" value="<?php echo rand(10000000, 999999999); ?>">
                            <button type="submit" class="btn btn-primary">Charge</button>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        {{--                        <button type="button" class="btn btn-primary">Save changes</button>--}}
                    </div>
                </div>
            </div>
        </div>


        <br>
{{--        <canvas id="transactionChart" width="400" height="200"></canvas>--}}

        <div class="row">
            <div class="row column1">
                <div class="col-md-7 col-lg-6">
                    <div class="card">
                <canvas id="transactionChart" width="800" height="600"></canvas>
                </div>
                </div>
                <div class="col-md-7 col-lg-6">
                    <div class="card">
                        <canvas id="transactionChart1" width="800" height="600"></canvas>
                    </div>
                </div>
                </div>
        </div>
            <br/>
        <div class="row">
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
        <div class="row">
            <div class="row column1">
                <div class="col-md-7 col-lg-6">
                    <div class="card">
                        <canvas id="myPieChart"></canvas>
                    </div>
                </div>
                <div class="col-md-7 col-lg-6">
                    <div class="card">
                        <canvas id="myPieChart1"></canvas>
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
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#dataForm').submit(function(e) {
            e.preventDefault(); // Prevent the form from submitting traditionally
            // Get the form data
            var formData = $(this).serialize();
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to fund ' + document.getElementById("username").value + ' ₦' + document.getElementById("amount").value + '?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // The user clicked "Yes", proceed with the action
                    // Add your jQuery code here
                    // For example, perform an AJAX request or update the page content
                    $('#loadingSpinner').show();
                    $.ajax({
                        url: "{{ route('admin/cr') }}",
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            // Handle the success response here
                            $('#loadingSpinner').hide();

                            console.log(response);
                            // Update the page or perform any other actions based on the response

                            if (response.status == 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: response.message
                                }).then(() => {
                                    location.reload(); // Reload the page
                                });
                            } else {
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Pending',
                                    text: response.message
                                });
                                // Handle any other response status
                            }

                        },
                        error: function(xhr) {
                            $('#loadingSpinner').hide();
                            Swal.fire({
                                icon: 'error',
                                title: 'fail',
                                text: xhr.responseText
                            });
                            // Handle any errors
                            console.log(xhr.responseText);

                        }
                    });


                }
            });


            // Send the AJAX request
        });
    });

</script>
<script>
    $(document).ready(function() {
        $('#dataForm2').submit(function(e) {
            e.preventDefault(); // Prevent the form from submitting traditionally
            // Get the form data
            var formData = $(this).serialize();
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to refund ' + document.getElementById("username2").value + ' ₦' + document.getElementById("amount2").value + '?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Processing',
                        text: 'Please wait...',
                        icon: 'info',
                        allowOutsideClick: false,
                        showConfirmButton: false
                    });
                    // The user clicked "Yes", proceed with the action
                    // Add your jQuery code here
                    // For example, perform an AJAX request or update the page content
                    $('#loadingSpinner').show();
                    $.ajax({
                        url: "{{ route('admin/refund') }}",
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            // Handle the success response here
                            $('#loadingSpinner').hide();

                            console.log(response);
                            // Update the page or perform any other actions based on the response

                            if (response.status == 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: response.message
                                }).then(() => {
                                    location.reload(); // Reload the page
                                });
                            } else {
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Pending',
                                    text: response.message
                                });
                                // Handle any other response status
                            }

                        },
                        error: function(xhr) {
                            $('#loadingSpinner').hide();
                            Swal.fire({
                                icon: 'error',
                                title: 'fail',
                                text: xhr.responseText
                            });
                            // Handle any errors
                            console.log(xhr.responseText);

                        }
                    });


                }
            });


            // Send the AJAX request
        });
    });

</script>
<script>
    $(document).ready(function() {
        $('#chargeForm').submit(function(e) {
            e.preventDefault(); // Prevent the form from submitting traditionally
            // Get the form data
            var formData = $(this).serialize();
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to Charge ' + document.getElementById("username1").value + ' ₦' + document.getElementById("amount1").value + '?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Processing',
                        text: 'Please wait...',
                        icon: 'info',
                        allowOutsideClick: false,
                        showConfirmButton: false
                    });
                    // The user clicked "Yes", proceed with the action
                    // Add your jQuery code here
                    // For example, perform an AJAX request or update the page content
                    $('#loadingSpinner').show();
                    $.ajax({
                        url: "{{ route('admin/ch') }}",
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            // Handle the success response here
                            $('#loadingSpinner').hide();

                            console.log(response);
                            // Update the page or perform any other actions based on the response

                            if (response.status == 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: response.message
                                }).then(() => {
                                    location.reload(); // Reload the page
                                });
                            } else {
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Pending',
                                    text: response.message
                                });
                                // Handle any other response status
                            }

                        },
                        error: function(xhr) {
                            $('#loadingSpinner').hide();
                            Swal.fire({
                                icon: 'error',
                                title: 'fail',
                                text: xhr.responseText
                            });
                            // Handle any errors
                            console.log(xhr.responseText);

                        }
                    });


                }
            });


            // Send the AJAX request
        });
    });

</script>


<script>
    fetch('/transactions')
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
    fetch('/transactions1')
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
<script>
    fetch('/checkusers')
        .then(response => response.json())
        .then(data => {
            var ctx = document.getElementById('myPieChart').getContext('2d');
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Total Users '+ data.tusers, 'New Users '+ data.nusers],
                    datasets: [{
                        data: [data.tusers, data.nusers],
                        backgroundColor: ['#20b016', '#d7b612'],
                    }]
                },
                options: {
                    responsive: true,
                }
            });
        });
</script>
<script>
    fetch('/checklock')
        .then(response => response.json())
        .then(data => {
            var ctx = document.getElementById('myPieChart1').getContext('2d');
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Total Lock '+ data.tlock, 'Active Lock '+ data.alock],
                    datasets: [{
                        data: [data.tlock, data.alock],
                        backgroundColor: ['#1630b0', '#d7b612'],
                    }]
                },
                options: {
                    responsive: true,
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

