@include('layouts.sidebar') <div class="page-wrapper"
    <div class="content container-fluid">
        <div class="row justify-content-lg-center">
            <div class="col-lg-10">
                <div class="page-header">
                    <DIV CLASS="ROW">
                        <div class="col">
                            <h4 class="page-title">Electricity Bills</h4>
                            <ul class="breadcrumb">
                                {{--                                <li class=""><a href="{{route('dashboard')}}">Dashboard</a></li>--}}
                                {{--                                <li class="breadcrumb-item active">Profile</li>--}}
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <!--                    <div class="box w3-card-4">-->
                        <div class="row">
                            <div class="col-sm-8">
                                <br>
                                <br>
                                <div class="alert alert-danger" id="ElectNote" style="text-transform: uppercase;font-weight: bold;font-size: 18px;display: none;">
                                </div>
                                <div id="electPanel">
                                    <div class="alert alert-danger">0.1% discount apply.</div>
                                    <form action="{{route('velect')}}" method="post">
                                        @csrf
                                        <div  class="form-group">
                                            <label  class="requiredField">
                                                Select  Electricity Company
                                                <span class="asteriskField">*</span>
                                            </label>
                                            <select name="id" class="text-success form-control" required>
                                                <option selected="">---------</option>
                                                @foreach($tv as $tv1)
                                                    <option value="{{$tv1['id']}}">{{$tv1['plan']}}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div id="metertypeID" class="form-group">
                                            <label for="metertypeID" class=" requiredField">
                                               Meter Number
                                                <span class="asteriskField">*</span>
                                            </label>
                                            <div class="">
                                                <input type="number" name="number" class="form-control" minlength="11" maxlength="11" required>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn process"
                                                style="color: white;background-color: #13b10d;margin-bottom:15px;"> Continue
                                        </button>
                                        <!--                        <button type="button" id="verify" class=" btn" style="margin-bottom:15px;">  <span id="process"><i class="fa fa-circle-o-notch fa-spin " style="font-size: 30px;animation-duration: 1s;"></i> Validating Please wait </span>  <span id="displaytext">Validate Meter Number </span></button>-->
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-4 ">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
