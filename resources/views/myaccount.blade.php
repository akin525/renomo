@include('layouts.sidebar')

<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Profile</h2>
                </div>
            </div>
        </div>

        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <!-- row -->
                <div class="row">
                    <div class="col-xl-3 col-lg-4">
                        <div class="clearfix">
                            <div class="card card-bx profile-card author-profile m-b30">
                                <div class="card-body">
                                    <div class="p-5">
                                        <div class="author-profile">
                                            <div class="author-media">
                                                @if(Auth::user()->profile_photo_path==NULL)
                                                    <img width="180" class="rounded-circle" src="{{asset('images/layout_img/user_img.jpg')}}" alt="#" />
                                                @elseif(\Illuminate\Support\Facades\Auth::user()->google_id!=NULL)
                                                   <img width="180" class="rounded-circle" src="{{Auth::user()->profile_photo_path}}" alt="#" />
                                                @else
                                                  <img width="180" class="rounded-circle" src="{{url('/', Auth::user()->profile_photo_path)}}" alt="#" />
                                                @endif
                                                <div class="upload-link" title="" data-toggle="tooltip" data-placement="right" data-original-title="update">
{{--                                                    <input type="file" class="update-flie">--}}
                                                    <form method="post" action="{{route('pic')}}" enctype="multipart/form-data">
                                                        @csrf
{{--                                                        <i class="fa fa-camera"></i>--}}
                                                        <input type="file" class="text-center" name="pic" required/>
                                                        <button type="submit" class="badge badge-success text-center">Upload</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <h6 class="title">{{$user['name']}}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        @if(Auth::user()->apikey !=NULL)
                                    <button type="button" class="badge badge-success">Reseller</button>
                                    <button type="button" class="badge badge-success">Upgraded</button>
                                        @else
                                    <a href="{{route('reseller')}}" class="badge badge-success">Upgrade Now</a>
                                    <button type="button" class="badge badge-success">Customer</button>
                                        @endif
                                    </div>
{{--                                    <div class="info-list">--}}
{{--                                        <ul>--}}
{{--                                            <li><a href="page-error-404.html">Models</a><span>36</span></li>--}}
{{--                                            <li><a href="uc-lightgallery.html">Gallery</a><span>3</span></li>--}}
{{--                                            <li><a href="page-error-404.html">Lessons</a><span>1</span></li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}


                                </div>
                                @if($wallet->account_number1 != '1')
                                <div class="card alert alert-success">
                                    <ul style="list-style-type:square">
                                        <li class="text-white"><h6 class="text-white"><b>Personal Virtual Account Number 2</b></h6></li>
                                        <br>
                                        <li class='text-white'><h5 class="text-white"><b>{{$wallet->account_name1}}</b></h5></li>
                                        <li class='text-white'><h5 class="text-white"><b>Account No:{{$wallet->account_number1}}</b></h5></li>
                                        <li class='text-white'><h5 class="text-white"><b>{{$wallet->bank}}</b></h5></li>
                                        <br>
                                        <li class='text-white'><h5 class="text-white"><b>Note: All virtual funding are being set automatically</b></h5></li>
                                    </ul>
                                </div>
                                @endif
                                @if($wallet->account_number=="!")
                                    <a href="{{route('vertual')}}" class="btn btn-danger text-center">Generate Account 2</a>
                                @endif
                                <div class="card-footer text-center">

                                    <div class="input-group">
                                        <a href="{{route('dashboard')}}" class="form-control text-primary text-start bg-white text-center">Dashboard</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8">
                        <div class="card profile-card card-bx m-b30">
                            <div class="card-header">
                                <h6 class="title">Account setup</h6>
                            </div>

                            <form class="profile-form" method="post" action="{{route('update')}}">
                                @csrf
                                <div class="card-body">
                                    <x-jet-validation-errors class="alert alert-danger" />

                                    <div class="row">
                                        <div class="col-sm-6 m-b30">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name" value="{{$user['name']}}"/>
                                        </div>
                                        <div class="col-sm-6 m-b30">
                                            <label class="form-label">Username</label>
                                            <input type="text" class="form-control" name="username" value="{{$user['username']}}" readonly/>
                                        </div>

                                        <div class="col-sm-6 m-b30">
                                            <label class="form-label">Gender</label>
                                            <select class="default-select form-control" id="validationCustom05" name="gender" required>
                                                <option  data-display="Select">Please select</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6 m-b30">
                                            <label class="form-label">Birth</label>
                                            <input type="date" class="form-control" name="dob" value="{{$user['dob']}}"/>
                                        </div>
                                        <div class="col-sm-6 m-b30">
                                            <label class="form-label">Phone</label>
                                            <input type="number" class="form-control" name="number" value="{{$user['number']}}"/>
                                        </div>
                                        <div class="col-sm-6 m-b30">
                                            <label class="form-label">Email address</label>
                                            <input type="email" class="form-control" name="email" value="{{$user['email']}}"/>
                                        </div>
                                        <div class="col-sm-6 m-b30">
                                            <label class="form-label">Bvn</label>
                                            <input type="number" class="form-control" name="bvn"  value="{{$all['bvn']}}" maxlength="11" minlength="11"/>
                                        </div>
                                        <div class="col-sm-6 m-b30">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control" name="address" value="{{$all['address']}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-outline-primary">UPDATE NOW</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- row -->
{{--        <div class="row column1">--}}
{{--            <div class="col-md-2"></div>--}}
{{--            <div class="col-md-8">--}}
{{--                <div class="white_shd full margin_bottom_30">--}}
{{--                    <div class="full graph_head">--}}
{{--                        <div class="heading1 margin_0">--}}
{{--                            <h2>User profile</h2>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    --}}
{{--                    --}}
{{--                    <div class="full price_table padding_infor_info">--}}
{{--                        <div class="row">--}}
{{--                            <!-- user profile section -->--}}
{{--                            <!-- profile image -->--}}
{{--                            <div class="col-lg-12">--}}
{{--                                <div class="full dis_flex center_text">--}}
{{--                                    <a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i class="fa fa-pencil"></i></a>--}}
{{--                                    @if(Auth::user()->profile_photo_path==NULL)--}}
{{--                                    <div class="profile_img"><img width="180" class="rounded-circle" src="{{asset('images/layout_img/user_img.jpg')}}" alt="#" /></div>--}}
{{--                                    @elseif(\Illuminate\Support\Facades\Auth::user()->google_id!=NULL)--}}
{{--                                    <div class="profile_img"><img width="180" class="rounded-circle" src="{{Auth::user()->profile_photo_path}}" alt="#" /></div>--}}
{{--                                    @else--}}
{{--                                        <div class="profile_img"><img width="180" class="rounded-circle" src="{{url('/', Auth::user()->profile_photo_path)}}" alt="#" /></div>--}}
{{--                                    @endif--}}
{{--                                    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">--}}
{{--                                        <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--                                            <div class="modal-content">--}}
{{--                                                <div class="modal-body pd-5">--}}
{{--                                                    <div class="img-container">--}}
{{--                                                        @if(Auth::user()->profile_photo_path==NULL)--}}
{{--                                                            <img id="image" width="200" src="{{asset('images/layout_img/user_img.jpg')}}" alt="Picture">--}}
{{--                                                        @elseif(\Illuminate\Support\Facades\Auth::user()->google_id!=NULL)--}}
{{--                                                        <img id="image" width="200" src="{{Auth::user()->profile_photo_path}}" alt="Picture">--}}
{{--                                                        @else--}}
{{--                                                            <img id="image" width="200" src="{{url('/', Auth::user()->profile_photo_path)}}" alt="Picture">--}}
{{--                                                        @endif--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="modal-footer">--}}
{{--                                                    <input type="submit" value="Remove Picture" onclick="window.location='{{route('deletepic')}}'" class="btn btn-primary">--}}
{{--                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="profile_contant">--}}
{{--                                        <div class="contact_inner">--}}
{{--                                            <h3>{{$user['name']}}</h3>--}}
{{--                                            <p><strong>About: </strong>Member</p>--}}
{{--                                            <ul class="list-unstyled">--}}
{{--                                                <li><i class="fa fa-envelope-o"></i> : {{$user['email']}}</li>--}}
{{--                                                <li><i class="fa fa-phone"></i> : {{$user['number']}}</li>--}}
{{--                                            </ul>--}}
{{--                                        </div>--}}
{{--                                        <br>--}}
{{--                                        <br>--}}
{{--                                        <br>--}}
{{--                                        <h4 class="text-blue"><b>Change Profile Picture</b></h4>--}}
{{--                                        <form method="post" action="{{route('pic')}}" enctype="multipart/form-data">--}}
{{--                                            @csrf--}}
{{--                                            <input type="file" name="pic" required><button type="submit" class="badge badge-success">Upload</button>--}}
{{--                                        </form>--}}
{{--                                        <br>--}}
{{--                                        <div class="user_progress_bar">--}}
{{--                                            <div class="progress_bar">--}}
{{--                                                <!-- Skill Bars -->--}}

{{--                                                <form method="post" action="{{route('update')}}">--}}
{{--                                                    @csrf--}}
{{--                                                    <ul class="profile-edit-list">--}}
{{--                                                        <li class="weight-500">--}}
{{--                                                            <br>--}}
{{--                                                            <h4 class="text-blue"><b>Edit Your Personal Setting</b></h4>--}}
{{--                                                            <div class="form-group">--}}
{{--                                                                <label>Full Name</label>--}}
{{--                                                                <input class="form-control form-control-lg" value="{{$user['name']}}" name="name" type="text" required>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="form-group">--}}
{{--                                                                <label>Email</label>--}}
{{--                                                                <input class="form-control form-control-lg" value="{{$user['email']}}" type="email" name="email" required>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="form-group">--}}
{{--                                                                <label>Phone Number</label>--}}
{{--                                                                <input class="form-control form-control-lg" type="number"  value="{{$user['number']}}" name="number" required>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="form-group mb-0">--}}
{{--                                                                <input type="submit" class="btn btn-primary" value="Update Information">--}}
{{--                                                            </div>--}}
{{--                                                        </li>--}}
{{--                                                    </ul>--}}
{{--                                                </form>--}}

{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <!-- profile contant section -->--}}
{{--                                <!-- end user profile section -->--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-2"></div>--}}
{{--            </div>--}}
{{--            <!-- end row -->--}}
{{--        </div>--}}
        <!-- footer -->
        <div class="container-fluid">
            <div class="footer">
                <p>Copyright © 2022. All rights reserved.<br><br>
{{--                    <a href="https://themewagon.com/">ThemeWagon</a>--}}
                </p>
            </div>
        </div>
    </div>
    <!-- end dashboard inner -->
</div>
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            var image = document.getElementById('image');
            var cropBoxData;
            var canvasData;
            var cropper;

            $('#modal').on('shown.bs.modal', function () {
                cropper = new Cropper(image, {
                    autoCropArea: 0.5,
                    dragMode: 'move',
                    aspectRatio: 3 / 3,
                    restore: false,
                    guides: false,
                    center: false,
                    highlight: false,
                    cropBoxMovable: false,
                    cropBoxResizable: false,
                    toggleDragModeOnDblclick: false,
                    ready: function () {
                        cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
                    }
                });
            }).on('hidden.bs.modal', function () {
                cropBoxData = cropper.getCropBoxData();
                canvasData = cropper.getCanvasData();
                cropper.destroy();
            });
        });
    </script>
