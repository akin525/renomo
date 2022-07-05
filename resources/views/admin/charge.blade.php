@include('admin.layouts.sidebar')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Charge User</h2>
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
                                    <h1><i class="fa i-cl-4 fa-money"></i></h1>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <form action="{{route('admin/ch')}}" method="post">
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
                                            <div class="form-group">
                                                <label>Enter Username To Charge</label>
                                                <input type="text" class="form-control" id="email" name="username" placeholder="Enter Reveiver's Username" required />
                                                <input type="hidden" class="form-control" value="{{rand(111111111, 999999999)}}" name="refid" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Enter Amount </label>
                                                <input type="number" name="amount" class="form-control" placeholder="Amount to fund" required/>
                                            </div>
                                        </div>
                                    </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <br>
                                    <button type="submit" class="btn btn-rounded btn-outline-success btn-block">Charge Wallet</button>
                                    </form>
                                </div>
                            </div>


                        </div>


                    </div>

                </div>

            </div>
        </div>
    </div>

</div>
