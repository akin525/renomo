@include('layouts.sidebar')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Create Giveaway</h2>
                </div>
            </div>
        </div>

        <div class="row column1">
            <div class="full counter_section margin_bottom_30">
                <div class="couter_icon">
                    <div>
                        <i class="fa fa-folder-open-o purple_color"></i>
                    </div>
                </div>
                <div class="counter_no">
                    <div>
                        <h5 class="total_no text-center">Create Give Away</h5>
{{--                        <h6 class="head_couter">Total Deposit</h6>--}}
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <x-jet-validation-errors class="alert alert-danger" />
                <div class="row column1">
                    <div class="col-md-7 col-lg-6">
                        <div class="full counter_section margin_bottom_30">
                            <div class="counter_no">
                                <div class="card-body">
                                    <center>
                                    <a href="#">
                                        <img  width="300" src="{{asset('img/airtime.jpg')}}" alt="">
                                    </a>
                                    {{--                            <h5 class="total_no text-center">₦{{number_format(intval($lock *1),2)}}</h5>--}}
                                    <h4 class="text-center">Create Airtime Giveaway</h4>
                                    <button type="button" class="btn btn-success text-center" onclick="window.location='{{route('airtimegiveaway')}}'">Create</button>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-6">
                        <div class="full counter_section margin_bottom_30">
                            <div class="counter_no">
                                <div class="card-body">
                                    <center>
                                    <a href="#">
                                        <img height="300" src="{{asset('img/data.jpg')}}"  alt="">
                                    </a>
                                    <h4 class="text-center">Create Data Giveaway</h4>
                                    <button type="button" class="btn btn-success" onclick="window.location='{{route('giveaway')}}'">Create</button>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
