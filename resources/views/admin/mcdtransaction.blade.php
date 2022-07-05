@include('admin.layouts.sidebar')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>MCD Transaction</h2>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="data-table-buttons" class="table table-striped table-bordered align-middle">
                        <thead>
                        <th class="table-active">Name</th>
                        <th>Reference Number</th>
                        <th> Date</th>
                        <th>Username</th>
                        <th>Amount</th>
                        <th>Device Details</th>
                        <th>Amount Before</th>
                        <th>Amount After</th>
                        <th>Description</th>
                        </thead>
                        <tbody>
                       @foreach ($success as $plan)
                        <tr>
                            <td>{{$plan['name'] }}</td>
                            <td>{{ $plan['ref'] }}</td>
                            <td>{{ $plan['date'] }}</td>
                            <td>{{ $plan['user_name']}}</td>
                            <td>{{ $plan['amount'] }}</td>
                            <td>{{ $plan['device_details'] }}</td>
                            <td>{{$plan['i_wallet'] }}</td>
                            <td>{{ $plan['f_wallet'] }}</td>
                            <td>{{$plan['description'] }}</td>
                        </tr>
                       @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')
