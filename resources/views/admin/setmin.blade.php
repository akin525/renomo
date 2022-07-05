@include('admin.layouts.sidebar')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Set Minimum Fund</h2>
                </div>
            </div>
        </div>

        <div class="row column1">
            <div class="full counter_section margin_bottom_30">
                <div class="couter_icon">
                    <div>
                        <i class="fa fa-bell yellow_color"></i>
                    </div>
                </div>

            </div>
        </div>
        <!-- Title & Breadcrumbs-->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="row">
                        <!-- col-md-6 -->
                        <div class="col-md-12 col-12">

                            <div class="form-group">
                                <div class="contact-thumb card-body">
                                    <h1><i class="fa i-cl-4 fa-mobile"></i></h1>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <form action="{{route('admin/min')}}" method="post">
                                    @csrf

                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    @if (session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-group mt-2">
{{--                                                <input type="hidden" name="id" value="{{$message->id}}" />--}}
                                                <input type="text" class="form-control" value="{{$min->len}}" name="body" required />
                                            </div>
                                            <div class="input-group mt-2">
                                                <button class="btn btn-primary waves-effect waves-light" type="submit" style="align-self: center; align-content: center"><i class="fa fa-paper-plane"></i> Set Minimum Fund</button>
                                            </div>
                                        </div>
                                    </div>

                            </div>


                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
@include('layouts.footer')
