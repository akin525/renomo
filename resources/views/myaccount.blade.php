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
        <!-- row -->
        <div class="row column1">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <div class="heading1 margin_0">
                            <h2>User profile</h2>
                        </div>
                    </div>
                    <div class="full price_table padding_infor_info">
                        <div class="row">
                            <!-- user profile section -->
                            <!-- profile image -->
                            <div class="col-lg-12">
                                <div class="full dis_flex center_text">
                                    <a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i class="fa fa-pencil"></i></a>
                                    @if(Auth::user()->profile_photo_path==NULL)
                                    <div class="profile_img"><img width="180" class="rounded-circle" src="{{asset('images/layout_img/user_img.jpg')}}" alt="#" /></div>
                                    @elseif(\Illuminate\Support\Facades\Auth::user()->google_id!=NULL)
                                    <div class="profile_img"><img width="180" class="rounded-circle" src="{{Auth::user()->profile_photo_path}}" alt="#" /></div>
                                    @else
                                        <div class="profile_img"><img width="180" class="rounded-circle" src="{{url('/', Auth::user()->profile_photo_path)}}" alt="#" /></div>
                                    @endif
                                    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body pd-5">
                                                    <div class="img-container">
                                                        @if(Auth::user()->profile_photo_path==NULL)
                                                            <img id="image" width="200" src="{{asset('images/layout_img/user_img.jpg')}}" alt="Picture">
                                                        @elseif(\Illuminate\Support\Facades\Auth::user()->google_id!=NULL)
                                                        <img id="image" width="200" src="{{Auth::user()->profile_photo_path}}" alt="Picture">
                                                        @else
                                                            <img id="image" width="200" src="{{url('/', Auth::user()->profile_photo_path)}}" alt="Picture">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" value="Remove Picture" onclick="window.location='{{route('deletepic')}}'" class="btn btn-primary">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="profile_contant">
                                        <div class="contact_inner">
                                            <h3>{{$user['name']}}</h3>
                                            <p><strong>About: </strong>Member</p>
                                            <ul class="list-unstyled">
                                                <li><i class="fa fa-envelope-o"></i> : {{$user['email']}}</li>
                                                <li><i class="fa fa-phone"></i> : {{$user['number']}}</li>
                                            </ul>
                                        </div>
                                        <br>
                                        <br>
                                        <br>
                                        <h4 class="text-blue"><b>Change Profile Picture</b></h4>
                                        <form method="post" action="{{route('pic')}}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="file" name="pic" required><button type="submit" class="badge badge-success">Upload</button>
                                        </form>
                                        <br>
                                        <div class="user_progress_bar">
                                            <div class="progress_bar">
                                                <!-- Skill Bars -->

                                                <form method="post" action="{{route('update')}}">
                                                    @csrf
                                                    <ul class="profile-edit-list">
                                                        <li class="weight-500">
                                                            <br>
                                                            <h4 class="text-blue"><b>Edit Your Personal Setting</b></h4>
                                                            <div class="form-group">
                                                                <label>Full Name</label>
                                                                <input class="form-control form-control-lg" value="{{$user['name']}}" name="name" type="text" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input class="form-control form-control-lg" value="{{$user['email']}}" type="email" name="email" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Phone Number</label>
                                                                <input class="form-control form-control-lg" type="number"  value="{{$user['number']}}" name="number" required>
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <input type="submit" class="btn btn-primary" value="Update Information">
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- profile contant section -->
                                <!-- end user profile section -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
            <!-- end row -->
        </div>
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
