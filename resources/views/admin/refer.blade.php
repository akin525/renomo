@include('admin.layouts.sidebar')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Track Referral</h2>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div>
                    <div class="table-responsive">
                        <table id="data-table-buttons" class="table table-striped table-bordered align-middle">
                            <thead>
                            <th class="table-active"> Username </th>
                            <th> Referral</th>
                            <th>Amount</th>
                            </thead>
                            <tbody>
                            @foreach($refer as $row)
                            <tr>
                                <td>{{$row['username']}}</td>
                                <td> {{$row['newuserid'] }}</td>
                                <td> {{$row ['amount']}}</td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                        <!--                                --><?php //echo $from; ?>
                    <!--                                --><?php //echo $to; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
@include('layouts.footer')
