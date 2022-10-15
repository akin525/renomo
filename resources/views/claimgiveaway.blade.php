@include('layouts.sidebar')
@foreach($givew as $away)
    <script>
        $(document).ready(function() {
            toastr.options.timeOut = 60000;
            toastr.info('{{\App\Console\encription::decryptdata( $away->username) }} just create giveaway👊  of {{$away->product}} claim it now <button type="button" class="btn btn-success" onclick="window.location={{route('claim')}}">Claim Now</button>');
        });
    </script>
@endforeach
<div class="content">
    <div class="module">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>All Giveaway</h2>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="module">
                <div class="module-head">
                    <div class="card">
                        <div class="card-body">
                            <h3>All Giveaway</h3>

                            <div class="full price_table padding_infor_info">
                                <div class="row">
                                    <!-- column contact -->
                                    @foreach($give as $re)
                                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 profile_details margin_bottom_30">
                                            <div class="contact_blog">
                                                <h2 class="badge badge-success"><b>{{$re->product}} Giveaway</b></h2>
                                                <div class="contact_inner">
                                                    <div class="left">
                                                        <h3>{{$re->name}}</h3>
                                                        <p><b>Created By: </b>{{\App\Console\encription::decryptdata($re->username)}}</p>
                                                        <p><b>Available For</b>: {{$re->limit}} users</p>
                                                        <ul class="list-unstyled">
                                                            <li><i class="fa fa-eye"></i> Seen: {{($re->click)}}</li>
                                                        </ul>
                                                    </div>
                                                    <div class="right">
                                                        <div class="profile_contacts">
                                                            <img class="img-responsive" src="{{asset("images/bn.jpeg")}}" alt="#" />
                                                        </div>
                                                    </div>
                                                    <div class="bottom_list">
                                                        <div class="left_rating">
                                                            <p class="ratings">
                                                                <a href="#"><span class="fa fa-star"></span></a>
                                                                <a href="#"><span class="fa fa-star"></span></a>
                                                                <a href="#"><span class="fa fa-star"></span></a>
                                                                <a href="#"><span class="fa fa-star"></span></a>
                                                                <a href="#"><span class="fa fa-star-o"></span></a>
                                                            </p>
                                                        </div>
                                                        <div class="right_button">
                                                                <button type="button"  class="btn btn-success btn-xs"> <i class="fa fa-eye">
                                                                    </i>{{$re->claim}}/{{$re->limits}}
                                                                </button>
                                                            @if($re->claim==$re->limits)
                                                                <button type="button" class="btn btn-primary btn-xs">
                                                                    Completed
                                                                </button>
                                                            @else
                                                                <button type="button" class="btn btn-outline-primary btn-xs" onclick="window.location='{{route('claimnow', $re->id)}}'">
                                                                    Claim Now<span class="load loading"></span>
                                                                </button>
                                                            @endif
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
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    {{$give->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
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

