@include('layouts.sidebar')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row justify-content-lg-center">
            <div class="col-lg-10">

                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h4 class="page-title">TV Subscription</h4>
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
                                    <form action="{{route('pick')}}" method="post">
                                        @csrf
                                        <div  class="form-group">
                                            <label  class="requiredField">
                                                Select Tv
                                                <span class="asteriskField">*</span>
                                            </label>
                                            <select name="id" class="text-success form-control" required>
                                                <option selected="">---------</option>
                                                    <option value="dstv">DSTV</option>
                                                    <option value="gotv">GOTV</option>
                                                    <option value="startimes">STARTIMES</option>
                                                    <option value="showmax">SHOWMAX</option>
                                            </select>
                                        </div>


                                        <button type="submit" class="btn process"
                                                style="color: white;background-color: #13b10d;margin-bottom:15px;"> Continue<span class="load loading"></span>
                                        </button>
                                        <script>
                                            const btns = document.querySelectorAll('button');
                                            btns.forEach((items)=>{
                                                items.addEventListener('click',(evt)=>{
                                                    evt.target.classList.add('activeLoading');
                                                })
                                            })
                                        </script>
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
