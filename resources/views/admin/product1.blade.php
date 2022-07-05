@include('admin.layouts.sidebar')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
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
                    <p class="text-muted mb-4 font-13">Product Controller</p>
                        <div class="table-responsive">
                            <table id="data-table-buttons" class="table table-striped table-bordered align-middle">
                                <thead>
                        <tr>
                            <th>Network</th>
                            <th>Plan</th>
                            <th>Actual Amount</th>
                            <th>Selling Amount</th>
                            <th>Reseller Amount</th>
                            <th>Status</th>
                            <th>Switch</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($product as $seller)
                            <tr>
                                <link rel="stylesheet" href="{{asset('style.css')}}">
                                <!--Only for demo purpose - no need to add.-->
                                <link rel="stylesheet" href="{{asset('demo.css')}}"/>
                                <td> {{$seller->network}} </td>
                                <td> {{$seller->plan}}</td>
                                <td> {{$seller->amount}}</td>
                                <td> {{$seller->tamount}}</td>
                                <td> {{$seller->ramount}}</td>
                                {{--                                <td><a href="{{route('editpayment', $pay->id)}}"--}}
                                {{--                                       {{$pay->value}}class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>--}}
                                {{--                                </td>--}}
                                <td>@if($seller->status=="1")<h6 class="btn-success">Active</h6>@else<h6
                                        class="btn-warning">
                                        Not-Active</h6> @endif</td>
                                <td>
                                    <label class="toggleSwitch nolabel">
                                        <input type="checkbox" name="status" value="0" id="myCheckBox"
                                               {{$seller->status =="1"?'checked':''}}
                                               {{--                                            @if($pay->status==1?'checked':'')--}}
                                               onclick="window.location='{{route('admin/pd1', $seller->id)}}'"/>
                                        <!--                                            <button  type="submit" class="btn-info col-lg">Update</button>-->
                                        <span>
                                                <span>off</span>
                                                <span>on</span>
                                             </span>

                                        <a></a>
                                    </label>
                                </td>
                                <td>
                                    <a href="{{route('admin/editproduct1', $seller->id)}}" class="btn btn-outline-primary"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$product->links()}}

                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@include('layouts.footer')
