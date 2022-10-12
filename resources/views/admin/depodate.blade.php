@include('admin.layouts.sidebar')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Daily Report Deposit</h2>
                </div>
            </div>
        </div>

        <div class="row column1">
            <div class="full counter_section margin_bottom_30">
                <div class="couter_icon">
                    <div>
                        <i class="fa fa-money purple_color"></i>
                    </div>
                </div>
                <div class="counter_no">
                    <div>
                        <h5 class="total_no text-center">₦{{number_format(intval($sum *1),2)}}</h5>
                        <h6 class="head_couter">Total Deposit</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
{{--                <form method="POST">--}}
{{--                    <label class="text-success">From: </label> <input type="date" class="text-success"  name="from">--}}
{{--                    <label class="text-success" >To: </label> <input type="date" class="text-success" name="to">--}}
{{--                    <input type="submit" class="text-success" value="Get Data" name="submit">--}}
{{--                </form>--}}

                <form class="form-horizontal" method="POST" action="{{ route('admin/date') }}">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="input-group mt-2">
                                <div class="input-group-prepend">
                                    <h3 class="text-success">From: </h3>
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input style="margin-right: 20px" type="date" name="from"  class="form-control @error('from') is-invalid @enderror">

                                <div class="input-group-prepend">
                                    <h3 class="text-success">To: </h3>
                                    <span class="input-group-text"><i class="fa fa-calendar"></i> </span>
                                </div>
                                <input type="date" name="to"  class="form-control @error('to') is-invalid @enderror">
                            </div>

                            <div class="input-group mt-2" style="align-content: center">
                                <button class="btn btn-primary btn-large" type="submit" style="align-self: center; align-content: center"><i class="fa fa-search"></i> Search</button>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </form>

                <h6 class="text-success">Data Between Selected Dates</h6>
                @if($result ?? '')
                <div>
                    <div class="table-responsive">
                        <table id="data-table-buttons" class="table table-striped table-bordered align-middle">
                            <thead>
                            <th class="table-active"> Username </th>
                            <th> Transaction Id </th>
                            <th> Date</th>
                            <th>Amount</th>
                            </thead>
                            <tbody>
                           @foreach($deposit as $row)
                            <tr>
                                <td>{{\App\Console\encription::decryptdata($row->username)}}</td>
                                <td>{{$row->payment_ref}}</td>
                                <td>{{$row->date}}</td>
                                <td>{{$row->amount}}</td>
                            </tr>
                           @endforeach
                           <br>
                            <center>
                                <button type="button" class="align-content-center btn btn-outline-success text-center">Total =₦{{number_format(intval($sumdate *1),2)}}</button>
                            </center>
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<script src="{{asset('asset/js/vendor.min.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>
<script src="{{asset('asset/js/app.min.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>
<script src="{{asset('asset/js/theme/default.min.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>


<script src="{{asset('asset/datatables.net/js/jquery.dataTables.min.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>
<script src="{{asset('asset/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>
<script src="{{asset('asset/datatables.net-responsive/js/dataTables.responsive.min.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>
<script src="{{asset('asset/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>
<script src="{{asset('asset/js/demo/table-manage-default.demo.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>
<script src="{{asset('asset/%40highlightjs/cdn-assets/highlight.min.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>
<script src="{{asset('asset/js/demo/render.highlight.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>


<script src="{{asset('asset/datatables.net/js/jquery.dataTables.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
<script src="{{asset('asset/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
<script src={{asset('"asset/datatables.net-responsive/js/dataTables.responsive.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
<script src="{{asset('asset/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
<script src="{{asset('asset/datatables.net-buttons/js/dataTables.buttons.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
<script src="{{asset('asset/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
<script src="{{asset('asset/datatables.net-buttons/js/buttons.colVis.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
<script src="{{asset('asset/datatables.net-buttons/js/buttons.flash.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
<script src="{{asset('asset/datatables.net-buttons/js/buttons.html5.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
<script src="{{asset('asset/datatables.net-buttons/js/buttons.print.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
<script src="{{asset('asset/pdfmake/build/pdfmake.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
<script src="{{asset('asset/pdfmake/build/vfs_fonts.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
<script src="{{asset('asset/jszip/dist/jszip.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
<script src="{{asset('asset/js/demo/table-manage-buttons.demo.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
<script src="{{asset('asset/%40highlightjs/cdn-assets/highlight.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
<script src="{{asset('asset/js/demo/render.highlight.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
<script src="{{asset('cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js')}}" data-cf-settings="f1e2722e35a43ad4c1e3a0c8-|49" defer=""></script><script defer src="../../../../static.cloudflareinsights.com/beacon.min.js" data-cf-beacon='{"rayId":"6a910724bd190718","version":"2021.10.0","r":1,"token":"4db8c6ef997743fda032d4f73cfeff63","si":100}'></script>

