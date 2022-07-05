@include('layouts.sidebar')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Withdraw Bonus</h2>
                </div>
            </div>
        </div>

        <div class="row column1">
            <div class="full counter_section margin_bottom_30">
                <div class="couter_icon">
                    <div>
                        <i class="fa fa-google-wallet yellow_color"></i>
                    </div>
                </div>
                <div class="counter_no">
                    <div>
                        <h5 class="total_no text-center">₦<?php echo number_format(intval($refer *1),2);?></h5>
                        <h6 class="head_couter">Bonus  Balance</h6>
                    </div>
                </div>
            </div>
        </div>
        <!-- Title & Breadcrumbs-->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="row">
                        <!-- col-md-6 -->
                        <div class="col-md-12 col-12">

                            <div class="form-group">
                                <div class="contact-thumb card-body">
                                    <h1><i class="fa i-cl-4 fa-money"></i></h1>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <form action="{{route('referwith1')}}" method="post">
                                    @csrf

                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    @if (session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control" id="email" name="username" value="{{Auth::user()->username}}" readonly />
{{--                                                <input type="hidden" class="form-control" value="{{rand(111111111, 999999999)}}" name="refid" />--}}
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Enter Amount </label>
                                                <input type="number" name="amount" class="form-control" value="{{$refer}}" placeholder="Amount to fund" readonly/>
                                            </div>
                                        </div>
                                    </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <br>
                                    <button type="submit" class="btn btn-rounded btn-outline-success btn-block">Withdraw Bonus</button>
                                    </form>
                                </div>
                            </div>


                        </div>


                    </div>

                </div>

            </div>
        </div>
    </div>

</div>
@include('layouts.footer')
