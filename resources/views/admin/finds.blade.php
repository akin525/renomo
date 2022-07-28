@include('admin.layouts.sidebar')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Find User</h2>
                </div>
            </div>
        </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="general-label">

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

                    <form class="form-horizontal" method="POST" action="{{ route('admin/finduser') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="input-group mt-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input style="margin-right: 20px" type="text" name="user_name" placeholder="Search for username" class="form-control @error('user_name') is-invalid @enderror">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-mobile"></i> </span>
                                    </div>
                                    <input type="tel" name="phoneno" placeholder="Search for phone number" class="form-control @error('phoneno') is-invalid @enderror">
                                </div>

                                <div class="input-group mt-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-users"></i> </span>
                                    </div>
                                    <input style="margin-right: 20px" type="text" name="status" placeholder="Search User group e.g agent, client, reseller" class="form-control @error('status') is-invalid @enderror">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-money"></i></span>
                                    </div>
                                    <input type="number" name="wallet" placeholder="Search for wallet value" class="form-control @error('wallet') is-invalid @enderror">
                                </div>

                                <div class="input-group mt-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-envelope"></i> </span>
                                    </div>
                                    <input style="margin-right: 20px" type="email" name="email" placeholder="Search for email address" class="form-control @error('email') is-invalid @enderror">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i> </span>
                                    </div>
                                    <input type="date" name="regdate" placeholder="Search for registration date e.g 2020-09-01" class="form-control @error('regdate') is-invalid @enderror">
                                </div>

                                <div class="input-group mt-2" style="align-content: center">
                                    <button class="btn btn-primary btn-large" type="submit" style="align-self: center; align-content: center"><i class="fa fa-search"></i> Search</button>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if($result ?? '')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Search Result(s)</h4>
                        <p class="text-muted mb-4 font-13">Total Result <code>{{$count}}</code></p>
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Role</th>
                                    <th>Reg Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>
                                            @if($user->photo)
                                                <img src="https://mcd.5starcompany.com.ng/app/avatar/{{$user->photo}}" alt="" class="rounded-circle thumb-sm mr-1"> {{\App\Console\encription::decryptdata($user->username)}}
                                            @else
                                                <img width="50" src="{{asset("images/bn.jpeg")}}" alt="" class="rounded-circle thumb-sm mr-1"> {{\App\Console\encription::decryptdata($user->username)}}
                                            @endif
                                        </td>
                                        <td>{{\App\Console\encription::decryptdata($user->email) }}</td>
                                        <td>{{\App\Console\encription::decryptdata($user->phone)}}</td>
                                        <td>{{$user->role}}</td>
                                        <td>{{$user->created_at}}</td>
                                        <td><a href="profile/{{ $user->username }}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
    @endif
    <!-- end row -->
@include('layouts.footer')
