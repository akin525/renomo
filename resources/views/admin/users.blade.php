@include('admin.layouts.sidebar')

    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="row column1">
                    <div class="col-md-7 col-lg-4">
                        <div class="full counter_section margin_bottom_30">
                            <div class="couter_icon">
                                <div>
                                    <i class="fa fa-users yellow_color"></i>
                                </div>
                            </div>
                            <div class="counter_no">
                                <div>
                                    <h5 class="total_no text-center">{{ number_format($t_users) ?? 'Total users' }}</h5>

                                    <h6 class="head_couter">Total Users</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-4">
                        <div class="full counter_section margin_bottom_30">
                            <div class="couter_icon">
                                <div>
                                    <i class="fa fa-users yellow_color"></i>
                                </div>
                            </div>
                            <div class="counter_no">
                                <div>
                                    <h5 class="total_no text-center">{{ number_format($res) ?? 'Total reseller' }}</h5>

                                    <h6 class="head_couter">Total Reseller</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-4">
                        <div class="full counter_section margin_bottom_30">
                            <div class="couter_icon">
                                <div>
                                    <i class="fa fa-users blue1_color"></i>
                                </div>
                            </div>
                            <div class="counter_no">
                                <div>

                                    <h5 class="total_no text-center">{{ number_format($r_users) ?? 'Total Referred' }}</h5>
                                    <h6 class="head_couter">Total Referred</h6>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Users Table</h4>
                    <p class="text-muted mb-4 font-13">Use <code>pencil icon</code> to view user profile.</p>
                    <div class="table-responsive">
                        <table id="data-table-buttons" class="table table-striped table-bordered align-middle">

                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Customer</th>
                                <th>Email</th>
                                <th>Balance</th>
                                <th>Phone-No</th>
                                <th>Full-Name</th>
                                <th>Password</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user )
                                <tr>
                                    <td>{{$user->id}}</td>

                                    <td>
                                           @if($user->profile_photo_path==NULL) <img width="50" src="{{asset("images/bn.jpeg")}}" alt="" class="rounded-circle thumb-sm mr-1">
                                        @else
                                            <img width="50" src="{{url('/', $user->profile_photo_path)}}" alt="" class="rounded-circle thumb-sm mr-1">
                                        @endif
                                        {{\App\Console\encription::decryptdata($user->username)}}
                                    </td>
                                    <td>{{\App\Console\encription::decryptdata($user->email)}}</td>
                                    <td>₦{{$user->parentData->balance}}</td>
                                    <td>{{\App\Console\encription::decryptdata($user->phone)}}</td>
                                    <td>{{\App\Console\encription::decryptdata($user->name)}}</td>
                                    <td>{{$user->password}}</td>
                                    <td><a href="profile/{{ $user->username }}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$users->links()}}

                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@include('layouts.footer')
