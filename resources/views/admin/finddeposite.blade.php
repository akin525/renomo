@include('admin.layouts.sidebar')
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

                <form class="form-horizontal" method="POST" action="{{ route('admin/depo') }}">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="input-group mt-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <input style="margin-right: 20px" type="text" name="user_name"
                                       placeholder="Search for username"
                                       class="form-control @error('user_name') is-invalid @enderror">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-mobile"></i> </span>
                                </div>
                                <input type="tel" name="phoneno" placeholder="Search for phone number"
                                       class="form-control @error('phoneno') is-invalid @enderror">
                            </div>

                            <div class="input-group mt-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-briefcase"></i> </span>
                                </div>
                                <input style="margin-right: 20px" type="text" name="reference"
                                       placeholder="Search Transaction Reference"
                                       class="form-control @error('reference') is-invalid @enderror">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-money"></i></span>
                                </div>
                                <input type="number" name="amount" placeholder="Search for amount"
                                       class="form-control @error('amount') is-invalid @enderror">
                            </div>

                            <div class="input-group mt-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-file"></i> </span>
                                </div>
                                <input style="margin-right: 20px" type="text" name="transaction_type"
                                       placeholder="Search for transaction type"
                                       class="form-control @error('transaction_type') is-invalid @enderror">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i> </span>
                                </div>
                                <input type="date" name="date"
                                       placeholder="Search for transaction date e.g 2020-09-01"
                                       class="form-control @error('date') is-invalid @enderror">
                            </div>

                            <div class="input-group mt-2" style="align-content: center">
                                <button class="btn btn-primary btn-large" type="submit"
                                        style="align-self: center; align-content: center"><i
                                        class="fa fa-search"></i> Search
                                </button>
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
                                <th>Username</th>
                                <th>Status</th>
                                <th>Reference</th>
                                <th>Initial Wallet</th>
                                <th>New Wallet</th>
                                <th>Date</th>
                                {{--                                    <th>Action</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($datas as $data)
                                <tr>
                                    <td>
                                        <img width="50" src="{{asset("images/bn.jpeg")}} "alt=""
                                             class="rounded-circle thumb-sm mr-1"/> {{$data->username}}
                                    </td>
                                    <td>{{$data->status }}</td>
                                    <td>{{$data->payment_ref}}</td>
                                    <td>{{$data->iwallet}}</td>
                                    <td>{{$data->fwallet}}</td>
                                    <td>{{$data->created_at}}</td>
                                    {{--                                        <td><a href="profile/{{ $user->user_name }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a></td>--}}
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
