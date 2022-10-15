@include('layouts.sidebar')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Claim Giveaway</h2>
                </div>
            </div>
        </div>

        <div class="row column1">
            <div class="full counter_section margin_bottom_30">
                <div class="couter_icon">
                    <div>
                        <i class="fa fa-gift yellow_color"></i>
                    </div>
                </div>
                <div class="counter_no">
                    <div>
                        <h5 class="total_no text-center">{{\App\Console\encription::decryptdata($give->username)}}</h5>
                        <h6 class="head_couter">Giveaway</h6>
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
                                    <h1><i class="fa i-cl-4 fa-money"></i></h1>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <form action="{{route('claimn')}}" method="post">
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
                                                <label>Giveaway Product</label>
                                                <input type="text" class="form-control"  name="name" value="{{$give->type}}" readonly/>
                                                <input type="hidden" class="form-control"  name="id" value="{{$give->id}}" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Actual Amount </label>
                                                <input type="number" name="amount" class="form-control" value="{{$give->amount}}" readonly/>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Phone Number </label>
                                                <input type="number" name="number" class="form-control" placeholder="Enter your phone number" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Refid</label>
                                                <input type="number" name="refid" class="form-control" value="{{rand(1111111111, 999999999)}}" readonly/>
                                            </div>
                                        </div>
                                    </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <br>
                                    <button type="submit" class="btn btn-rounded btn-outline-success btn-block">claim now<span class="load loading"></span></button>
                                    </form>
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

            </div>
        </div>
    </div>

</div>
