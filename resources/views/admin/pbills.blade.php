@include('admin.layouts.sidebar')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Pending Transaction</h4>
                {{--                    <p class="text-muted mb-4 font-13">Use <code>pencil icon</code> to view user profile.</p>--}}
                <div class="table-responsive">
                    <table id="data-table-buttons" class="table table-striped table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Username</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Number</th>
                            <th>Plan</th>
                            <th>Ref</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $dat)
                            <tr>
                                <td>{{$dat->id}}</td>
                                <td>{{\App\Console\encription::decryptdata($dat->username)}}
                                </td>
                                <td>{{$dat->amount}}</td>
                                <td class="center">

                                    @if($dat->status=="1")
                                        <span class="badge badge-success">Delivered</span>
                                    @elseif($dat->status=="0")
                                        <span class="badge badge-warning" >Not-Delivered</span>
                                        <a href="rdone/{{$dat->id}}" class="badge-success text-white">Reverse</a>
                                    @else
                                        <span class="badge badge-info">{{$dat->status}}</span>
                                    @endif

                                </td>
                                <td>{{$dat->number}}</td>
                                <td>{{$dat->product}}</td>
                                <td>{{$dat->transactionid}}</td>
                                <td>{{$dat->timestamp}}</td>
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
<!-- end row -->
@include('layouts.footer')
