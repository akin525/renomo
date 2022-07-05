@include('admin.layouts.sidebar')

<div class="row">

    @if (session('success'))
        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            {{ session('error') }}
        </div>
    @endif

    <div class="col-12">
        <div class="card">
            <div class="card-body met-pro-bg">
                <div class="met-profile" >
                    <div class="row" style='background-image: url("/images/pattern.png"); padding: 20px; color: white'>
                        <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                            <div class="met-profile-main">
                                <div class="met-profile-main-pic">
                                    @if($user->photo!=null)
                                        <img src="https://mcd.5starcompany.com.ng/app/avatar/{{$user->user_name }}.JPG" alt="img" class="img img-thumbnail">
                                    @else
                                        <img alt="image" class="img img-thumbnail" width="100" src="{{asset("images/bn.jpeg")}}">
                                    @endif
                                    <span class="fro-profile_main-pic-change"><i class="fa fa-camera"></i></span></div>
                                <div class="met-profile_user-detail">
                                    <h4 class="met-user-name" style="color: white">{{\App\Console\encription::decryptdata($user->username)}}</h4>
                                    <p class="mb-0 met-user-name-post">{{\App\Console\encription::decryptdata($user->name)}}</p>
                                    <p class="mb-0 met-user-name-post text-muted">({{$user->role}})</p>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-4 ml-auto">
                            <ul class="list-unstyled personal-detail">
                                <li class=""><i class="fa fa-user text-info "></i> <b>Full-Name</b> : {{\App\Console\encription::decryptdata($user->name)}}</li>
                                <br>
                                <li class=""><i class="fa fa-phone text-info "></i> <b>Phone </b> : {{\App\Console\encription::decryptdata($user->phone)}}</li>
                                <br>
                                <li class="mt-2"><i class="fa fa-envelope text-info "></i> <b>Email </b> : {{\App\Console\encription::decryptdata($user->email)}}</li>
                                <br>
                                <li class="mt-2"><i class="fa fa-calendar text-info"></i> <b>Reg. Date</b> : {{$user->date}}</li>
                                <br>
                                <li class="mt-2"><i class="fa fa-key text-info "></i> <b>Api</b> : {{$user->apikey}}</li>
                                @if($wallet->account_number != "1")
                                <br>
                                <li class="mt-2"><i class="fa fa-phone text-info "></i> <b>Account-No</b> : {{$wallet->account_number}}</li>
                                <br>
                                <li class="mt-2"><i class="fa fa-user text-info "></i> <b>Account-Name</b> : {{$wallet->account_name}}</li>
                                @endif
                            </ul>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
                <!--end f_profile-->
            </div>
            <!--end card-body-->
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card-body">
                <ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
                    <li class="nav-item"><a class="nav-link active" id="general_detail_tab" data-toggle="pill" href="#general_detail">General</a></li>
                    <li class="nav-item"><a class="nav-link" id="activity_detail_tab" data-toggle="pill" href="#activity_detail">Transactions</a></li>
                    <li class="nav-item"><a class="nav-link" id="portfolio_detail_tab" data-toggle="pill" href="#portfolio_detail">Bills</a></li>
                    <li class="nav-item"><a class="nav-link" id="settings_detail_tab" data-toggle="pill" href="#settings_detail">Charges</a></li>
                    <li class="nav-item"><a class="nav-link" id="sms_tab" data-toggle="pill" href="#sms_detail">Update User</a></li>
                    <li class="nav-item"><a class="nav-link" id="pass_tab" data-toggle="pill" href="#pass">Change Password</a></li>
                </ul>
            </div>
            <!--end card-body-->
        </div>
        <!--end card-->
    </div>
    <!--end col-->
</div>
<!--end row-->
<div class="card-body">
    <div class="w3-panel w3-yellow w3-round-xlarge">
        <div class="card-body">
            <center>
                <!--                    <h4 class="w3-text-green"><b>&nbsp;&nbsp; &nbsp;&nbsp; <a class="w3-btn w3-green w3-border w3-round-large" href="with.php">Withdraw From MCD Wallet</a>-->
                <a class="w3-btn w3-green w3-border w3-round-large" href="{{route('admin/credit')}}">Credit User</a>

                <a class="w3-btn w3-green w3-border w3-round-large" href="{{route('admin/credit')}}">Refund User</a>
                <a class="w3-btn w3-green w3-border w3-round-large" href="{{route('admin/charge')}}">Charge User</a>

                <!--                            <a class="w3-btn w3-green w3-border w3-round-large" href="method.php">All Payment Method</a>-->
            </center>
        </div>
        </b></h4>  	</div>
</div>
<div class="row">
    <div class="col-12">
        <div class="tab-content detail-list" id="pills-tabContent">
            <div class="tab-pane fade show active" id="general_detail">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                {{--                                    <div class="d-flex justify-content-between">--}}
                                {{--                                        <img src="../assets/images/widgets/monthly-re.png" alt="" height="75">--}}
                                {{--                                        <div class="align-self-center">--}}
                                {{--                                            <h2 class="mt-0 mb-2 font-weight-semibold">$955<span class="badge badge-soft-success font-11 ml-2"><i class="fas fa-arrow-up"></i> 8.6%</span></h2>--}}
                                {{--                                            <h4 class="title-text mb-0">Monthly Revenue</h4>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                <div class="d-flex justify-content-between bg-purple p-3 mt-3 rounded">
                                    <center>
                                    <div>
                                        <h4 class="font-weight-semibold ">&#8358;{{number_format($wallet->balance)}}</h4>
                                        <p class="mb-0 ">Wallet Balance</p>
                                    </div>
                                    </center>
                                    <div>
                                        <h4 class="mb-1 font-weight-semibold ">&#8358;{{$sumtt}}</h4>
                                        <p class="mb-0">Total Deposit</p>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between bg-purple p-3 mt-3 rounded">
                                    <div>
                                        <h4 class="mb-1 font-weight-semibold ">&#8358;{{number_format($sumbo)}}</h4>
                                        <p class=" mb-0">Total Bills</p>
                                    </div>
                                    <div>
                                        <h4 class="mb-1 font-weight-semibold ">&#8358;{{number_format($sumch)}}</h4>
                                        <p class="mb-0">Total Charges</p>
                                    </div>
                                </div>
                            </div>
                            <!--end card-body-->
                        </div>

                        <!--end card-->
                        <div class="card">
                            <div class="card-body dash-info-carousel">
                                {{--                                    <h4 class="mt-0 header-title mb-4">New Leads</h4>--}}
                                <div id="carousel_1" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="media">
{{--                                                <div class="media-body align-self-center">--}}
{{--                                                    <h4 class="mt-0 mb-1 title-text text-dark">{{$user->gnews}}</h4>--}}
{{--                                                    <p class="text-muted mb-0">General News</p>--}}
{{--                                                </div>--}}
                                            </div>
                                        </div>
{{--                                        <div class="carousel-item">--}}
{{--                                            <div class="media">--}}
{{--                                                <div class="media-body align-self-center">--}}
{{--                                                    <h4 class="mt-0 mb-1 title-text">{{$user->target}}</h4>--}}
{{--                                                    <p class="text-muted mb-0">Target</p>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>
                                    <a class="carousel-control-prev" href="#carousel_1" role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a><a class="carousel-control-next" href="#carousel_1" role="button" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span></a>
                                </div>
                            </div>
                        </div>
                        <!--end card-->

                        <div class="card">
                            <div class="card-body dash-info-carousel">

                                <div class="progress bg-warning mb-3" style="height:5px;">
                                    <div class="progress-bar bg-secondary" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <!--end card-->


                    </div>
                    <!--end col-->
                    <div class="col-lg-8">
                        <div class="card">
                            <div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="p-4 bg-light text-center align-item-center">
                                            <h1 class="font-weight-semibold">{{($tt)}}</h1>
                                            <h4 class="header-title">Overall Performance</h4>
                                        </div>
                                        <ul class="list-unstyled mt-3">
                                            <li class="mb-2">
                                                <span class="text-dark">All Bill</span> <small class="float-right text-muted ml-3 font-14">{{$tat}}</small>
                                                <div class="progress mt-2" style="height:5px;">
                                                    <div class="progress-bar bg-secondary" role="progressbar" style="width: {{($tat/100)}}%; border-radius:5px;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <!--end card-body-->
                                </div>
                                <!--end card-->
                            </div>
                            <!--end col-->
                        </div>

                        <div class="button-list btn-social-icon">
                            <b>Referrals</b> :

                            @foreach($referrals as $referral)
                                @if($referral->photo!=null)
                                    <a href="{{$referral->username}}" class="btn btn-pink btn-circle ml-2">
                                        <img alt="image" class="card-img img" width="50" src="{{asset("images/bn.jpeg")}}">
                                        {{$referral->username}}
                                    </a>
                                @else
                                    <a href="{{$referral->username}}" class="btn btn-pink btn-circle ml-2">{{$referral->username}}</a>
                                @endif

                            @endforeach
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <!--end general detail-->
            <div class="tab-pane fade" id="activity_detail">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Transactions</h4>
                                {{--                    <p class="text-muted mb-4 font-13">Use <code>pencil icon</code> to view user profile.</p>--}}
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Username</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>I. Wallet</th>
                                            <th>F. Wallet</th>
                                            <th>Ref</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($td as $dat)
                                            <tr>
                                                <td>{{$dat->id}}</td>
                                                <td>{{\App\Console\encription::decryptdata($dat->username)}}
                                                </td>
                                                <td>{{$dat->amount}}</td>
                                                <td class="center">

                                                    @if($dat->status=="1")
                                                        <span class="badge badge-success">Delivered</span>
                                                    @elseif($dat->status=="0" || $dat->status=="Not Delivered" || $dat->status=="Error" || $dat->status=="ORDER_CANCELLED" || $dat->status=="Invalid Number" || $dat->status=="Unsuccessful")
                                                        <span class="badge badge-warning">{{$dat->status}}</span>
                                                    @else
                                                        <span class="badge badge-info">{{$dat->status}}</span>
                                                    @endif

                                                </td>
                                                <td>{{$dat->iwallet}}</td>
                                                <td>{{$dat->fwallet}}</td>
                                                <td>{{$dat->payment_ref}}</td>
                                                <td>{{$dat->date}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{ $td->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!--end row-->
            </div>

            <div class="tab-pane fade" id="portfolio_detail">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Bills Table</h4>
                                {{--                    <p class="text-muted mb-4 font-13">Use <code>pencil icon</code> to view user profile.</p>--}}
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Username</th>
                                            <th>Amount</th>
                                            <th>Product</th>
                                            <th>Number</th>
                                            <th>Token</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($version as $dat)
                                            <tr>
                                                <td>{{$dat->id}}</td>
                                                <td>{{\App\Console\encription::decryptdata($dat->username)}}</td>
                                                <td>&#8358;{{$dat->amount}}</td>
                                                <td>{{$dat->product}}</td>
                                                <td>{{$dat->number}}</td>
                                                <td>{{$dat->token}}</td>
                                                <td> @if($dat->status=="1")
                                                        <span class="badge badge-success">Delivered</span>
                                                    @elseif($dat->status=="0")
                                                        <span class="badge badge-warning">Not-Delivered</span>
                                                    @else
                                                        <span class="badge badge-info">Not-Delivered</span>
                                                    @endif</td>
                                                <td>{{$dat->created_at}}</td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{ $version->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!--end row-->
            </div>

            <div class="tab-pane fade" id="settings_detail">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Charges Table</h4>
                                {{--                    <p class="text-muted mb-4 font-13">Use <code>pencil icon</code> to view user profile.</p>--}}
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Username</th>
                                            <th>Amount</th>
                                            <th>Refid</th>
                                            <th>I-Wallet</th>
                                            <th>F-Wallet</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($charge as $dat)
                                            <tr>
                                                <td>{{$dat->id}}</td>
                                                <td>{{\App\Console\encription::decryptdata($dat->username)}}</td>
                                                <td>&#8358;{{$dat->amount}}</td>
                                                <td>{{$dat->payment_ref}}</td>
                                                <td>{{$dat->iwallet}}</td>
                                                <td>{{$dat->fwallet}}</td>
                                                <td>{{$dat->date}}</td>

                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{ $charge->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!--end row-->
            </div>

            <div class="tab-pane fade" id="sms_detail">
                <div class="row">
                    <div class="">
                        <div class="card">
                            <div class="card-body">
                                <div class="general-label">
                                    <form class="form-horizontal" method="POST" action="{{ route('admin/update') }}">
                                        @csrf
                                            <div class="">
                                                <div class="field">
                                                    <label class="label_field">Phone No</label>
                                                    <input type="number" class="form-control" name="number" value="{{\App\Console\encription::decryptdata($user->phone)}}" required />
                                                </div>
                                                <br>
                                                <div class="field">
                                                    <label class="label_field">Name</label>
                                                    <input type="text" name="name" class="form-control" value="{{\App\Console\encription::decryptdata($user->name)}}" required />
                                                    <input type="hidden" name="username" class="form-control" value="{{$user->username}}" required />
                                                </div>
                                                <br>
                                                <div class="field">
                                                    <label class="label_field">Email</label>
                                                    <input type="email" name="email" class="form-control" value="{{\App\Console\encription::decryptdata($user->email)}}" required />
                                                </div>
                                                <br>
                                                <div class="field">
                                                    <label class="label_field">Role</label>
                                                    <select  name="role" class="form-control"  required >
                                                        <option value="{{$user->role}}">{{$user->role}}</option>
                                                        <option value="user">User</option>
                                                        <option value="admin">admin</option>
                                                    </select>
                                                </div>
                                                <br>
                                                    <button class="btn btn-primary " type="submit"><i class="fa fa-user"></i> Update User</button>
                                                </div>

                                        <!--end row-->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>

            <div class="tab-pane fade" id="pass">
                <div class="row">
                    <div class="">
                        <div class="card">
                            <div class="card-body">
                                <div class="general-label">
                                    <form class="form-horizontal" method="POST" action="{{ route('admin/pass') }}">
                                        @csrf
                                            <div class="">

                                                <div class="field">
                                                    <input type="hidden" name="username" class="form-control" value="{{$user->username}}" required />
                                                </div>
                                                <br>
                                                    <button class="btn btn-primary " type="submit"><i class="fa fa-user"></i>Generate password</button>
                                                </div>

                                        <!--end row-->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>

        </div>
        <!--end tab-content-->
    </div>
    <!--end col-->
</div>
<!--end row-->
@include('layouts.footer')
