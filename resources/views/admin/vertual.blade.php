@include('admin.layouts.sidebar')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>All Virtual Account</h2>
                </div>
            </div>
        </div>
        <center>
            <div class="row column1">
                <!--            <div class="col-md-6 col-lg-3">-->
                <div class="full counter_section margin_bottom_30">
                    <div class="couter_icon">
                        <div>
                            <i class="fa fa-users yellow_color"></i>
                        </div>
                    </div>
                    <div class="counter_no">
                        <div>
                            <h2 class="total_no text-center">{{$alluser}}</h2>
                            <h6 class="head_couter">All Users</h6>
                        </div>
                    </div>
                </div>
                <!--            </div>-->
            </div>
        </center>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="data-table-buttons" class="table table-striped table-bordered align-middle">
                                <thead>
                                <th>Username</th>
                                <th>Account Name</th>
                                <th>Account No</th>
                                </thead>
                                <tbody>
                                @foreach($vertual as $row)
                                <tr>
                                    <td>{{$row['username']}}</td>
                                    @if ("$row[account_name]"==1 )
                                    <td>No Virtual Account Yet</td>
                                    @else
                                    <td>{{$row['account_name']}}</td>
                                    @endif
                                    @if ($row['account_number']==1)
                                    <td>No Virtual Account Yet</td>
                                    @else
                                    <td>{{$row['account_number']}}</td>
                                @endif

                                <!--                                            <td><div class="label cl---><?php // print $color ?><!-- bg---><?php //print $color; ?><!---light">--><?php //print $sta; ?><!--</div></td>-->

                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
