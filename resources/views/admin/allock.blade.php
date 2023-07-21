@include('admin.layouts.sidebar')
<div class="content">
    <div class="module">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>All Safelock</h2>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="module">
                <div class="module-head">
                    <div class="card">
                        <div class="card-body">
                            <h3>All Safe-lock</h3>

                            <div class="full price_table padding_infor_info">
                                <div class="row">
                                    <!-- column contact -->
                                    @foreach($lock as $re)
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 profile_details margin_bottom_30">
                                        <div class="contact_blog">
                                            <h2 class="badge badge-success"><b>SAFE-LOCK</b></h2>
                                            <div class="contact_inner">
                                                <div class="left">
                                                    <h3>{{$re->tittle}}</h3>
                                                    <p><b>Username: </b>{{\App\Console\encription::decryptdata($re->username)}}</p>
                                                   <p><b>Starting-Date</b>: {{$re->Start_date}}</p>
                                                    <ul class="list-unstyled">
                                                        <li><i class="fa fa-money"></i>: ₦{{ number_format(intval($re->balance *1),2)}}</li>
                                                        <li><i class="fa fa-calendar">Withdraw-Date</i> : {{$re->date}}</li>
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
                                                        <button type="button" onclick="{{route('profile.show')}}" class="btn btn-success btn-xs"> <i class="fa fa-user">
                                                            </i> <i class="fa fa-comments-o"></i>
                                                        </button>
                                                        @if($re->status=="1")
                                                        <button type="button" class="btn btn-info btn-xs">
                                                        Running
                                                        </button>
                                                        @elseif($re->status=="0")
                                                            <button type="button" class="btn btn-primary btn-xs">
                                                                Completed
                                                            </button>
                                                        @endif
                                                        @if($re->status=="1")
                                                            <a href="{{route('admin/cron', $re->id)}}" class="btn btn-danger">Terminate</a>
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    {{$lock->links()}}
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>
</div>
