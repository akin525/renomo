@include('admin.layouts.sidebar')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Withdraw Request</h2>
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
                        <h5 class="total_no text-center">₦<?php echo number_format(intval($total *1),2);?></h5>
                        <h6 class="head_couter">All Request Withdraw</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">All Request</h4>
                        {{--                    <p class="text-muted mb-4 font-13">Use <code>pencil icon</code> to view user profile.</p>--}}
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Amount</th>
                                    <th>Account-Number</th>
                                    <th>Account-Name</th>
                                    <th>Bank</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($all as $dat)
                                    <tr>
                                        <td>{{\App\Console\encription::decryptdata($dat->username)}}
                                        </td>
                                        <td>{{$dat->amount}}</td>
                                        <td>{{$dat->account_no}}</td>
                                        <td>{{$dat->name}}</td>
                                        <td>{{$dat->bank}}</td>
                                        <td>{{$dat->date}}</td>
                                        <td class="center">

                                            @if($dat->status=="1")
                                                <span class="badge badge-success">Delivered</span>
                                                @elseif($dat->status=="2")
                                                    <span class="badge badge-danger">Disapproved</span>
                                                @elseif($dat->status=="0")
                                                <button type="button" onclick="window.location='{{route('admin/approved', $dat->id)}}'" class="badge badge-info">Click to Approved</button>
                                                <button type="button" onclick="window.location='{{route('admin/disapproved', $dat->id)}}'" class="badge badge-info">Click to Disapproved</button>
                                            @endif

                                        </td>
                                        </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $all->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
