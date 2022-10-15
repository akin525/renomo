@include('layouts.sidebar')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row justify-content-lg-center">
            <div class="col-lg-10">

                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title text-white">Waec Result Checker</h3>
                            <ul class="breadcrumb">
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-white rounded text-center">


                    <script>
                        $(document).ready(function() {
                            toastr.options.timeOut = 60000;
                            @if (Session::has('error'))
                            toastr.error('{{ Session::get('error') }}');
                            @elseif(Session::has('success'))
                            toastr.success('{{ Session::get('success') }}');
                            @endif
                        });

                    </script>


                    <form method="post" action="{{route('wac')}}" id="form_submit">
                        @csrf
                        <div class="row text-left">
                            <x-jet-validation-errors class="alert alert-success" />

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="small mb-1" for="numofpins" style="color: #000000">No of Pins</label>
                                    <select id="numofpins" name="value" class="form-control rounded-right" style="border-radius: 0px; height: 50px;" required="">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="10"> 10</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row text-left">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="small mb-1" for="numofpins" style="color: #000000">Amount per Unit (₦)</label>
                                    <input id="amount" name="amount" class="form-control rounded-right py-4" value="{{$waec['tamount']}}" style="border-radius: 0px;" readonly="">
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{rand(111111111, 999999999)}}">
                        </div>
                        <button class="btn-danger rounded btn-block font-weight-bold py-2 my-4" type="submit">Generate<span class="load loading"></span></button>
                    </form>
                    <a class="btn-success btn-block rounded text-center font-weight-bold py-2 my-4" href="{{route('dashboard')}}" style="text-decoration: none;">
                        Back to Dashboard
                    </a>
                </div>
                <script>
                    const btns = document.querySelectorAll('button');
                    btns.forEach((items)=>{
                        items.addEventListener('click',(evt)=>{
                            evt.target.classList.add('activeLoading');
                        })
                    })
                </script>
            </div>

        </div>
        <br>
        <br>
        <br>
        <div class="content">
            <div class="module">
                <div class="module-head">
                    <div class="card">
                        <div class="card-body">
                            <h3>Waec Pins</h3>

                            <div class="table-responsive">
                                <table id="data-table-buttons" class="table table-striped table-bordered align-middle">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Username</th>
                                        <th>Seria-Number</th>
                                        <th>Pin</th>
                                        <th>Ref</th>
                                        <!--                                                    <th>Action</th>-->
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($wa as $re)
                                        <tr>
                                            <td>{{$re->created_at}}</td>
                                            <td>{{\App\Console\encription::decryptdata($re->username)}}</td>
                                            <td>{{$re->seria}}</td>
                                            <td>{{$re->pin}}</td>
                                            <td>{{$re->ref}}</td>
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

