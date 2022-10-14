@include('layouts.sidebar')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Create Giveaway</h2>
                </div>
            </div>
        </div>

        <div class="row column1">
            <div class="full counter_section margin_bottom_30">
                <div class="couter_icon">
                    <div>
                        <i class="fa fa-folder-open-o purple_color"></i>
                    </div>
                </div>
                <div class="counter_no">
                    <div>
                        <h5 class="total_no text-center">Create Airtime Give Away</h5>
{{--                        <h6 class="head_couter">Total Deposit</h6>--}}
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <x-jet-validation-errors class="alert alert-danger" />
                <form class="form-horizontal" method="POST" action="{{route('airaway')}}">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="input-group mt-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-book"></i></span>
                                </div>
                                <input style="margin-right: 20px" type="text" name="name" placeholder="Enter Your Giveaway Name"  class="form-control @error('name') is-invalid @enderror">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-database"></i> </span>
                                </div>
                                <script>
                                    function myNewFunction(sel) {
                                        // alert(sel.options[sel.selectedIndex].id);
                                        document.getElementById("po").value = (sel.options[sel.selectedIndex].id);
                                        document.getElementById("pk").value = (sel.options[sel.selectedIndex].text);
                                    }
                                </script>
                                <select  name="product" onChange="myNewFunction(this);"  class="form-control @error('to') is-invalid @enderror" required>
                                    <option>Select Your Airtime</option>
                                    <option value="m" id="MTN">MTN</option>
                                    <option value="g" id="GLO">Glo</option>
                                    <option value="a" id="AIRTEL">AIRTEL</option>
                                    <option value="9" id="9MOBILE">9MOBILE</option>
                                </select>
                            </div>
                            <input type="hidden" name="body" value=""  id="po" class="form-control">

                            <div class="input-group mt-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-money"></i> </span>
                                </div>
                                <input style="margin-right: 20px" type="number" name="amount" placeholder="Enter the amount" class="form-control @error('status') is-invalid @enderror">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-couch"></i></span>
                                </div>
                                <input type="number" name="limit" placeholder="Enter Your number of user" class="form-control @error('wallet') is-invalid @enderror">
                            </div>

                            <div class="input-group mt-2" style="align-content: center">
                                <button class="btn btn-primary btn-large" type="submit" style="align-self: center; align-content: center"><i class="fa fa-folder"></i> Create</button>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </form>
            </div>
        </div>
