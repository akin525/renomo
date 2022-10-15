
@include('layouts.sidebar')


<div style="padding:90px 15px 20px 15px">
    <!--    <h4 class="align-content-center text-center">Data Subscription</h4>-->





    <!--            <div class="box w3-card-4">-->

    <form action="{{ route('buyairtime1') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-sm-8">
                <br>
                <br>
                <div id="AirtimeNote" class="alert alert-danger" style="text-transform: uppercase;font-weight: bold;font-size: 23px;display: none;"></div>
                <div id="AirtimePanel">
                    <div id="div_id_network" class="form-group">
                        <label for="network" class=" requiredField">
                            Network<span class="asteriskField">*</span>
                        </label>
                        <div class="">
                            <select name="id" class="text-success form-control" required="">
                                    <option value="" selected="">---------</option>

                                    <option value="MTN">MTN</option>
                                    <option value="GLO">GLO</option>
                                    <option value="AIRTEL">AIRTEL</option>
                                    <option value="9MOBILE">9MOBILE</option>

                            </select>
                        </div>
                    </div>
                    <div id="div_id_network" class="form-group">
                        <label for="network" class=" requiredField">
                            Enter Amount<span class="asteriskField">*</span>
                        </label>
                        <div class="">
                            <input type="number" name="amount" min="100" max="4000" class="text-success form-control" required>
                        </div>
                    </div>
                    <div id="div_id_network" class="form-group">
                        <label for="network" class=" requiredField">
                            Enter Phone Number<span class="asteriskField">*</span>
                        </label>
                        <div class="">
                            <input type="number" name="number" minlength="11" class="text-success form-control" required>
                        </div>
                    </div>
                    <input type="hidden" name="refid" value="<?php echo rand(10000000, 999999999); ?>">
                    <button type="submit" class=" btn" style="color: white;background-color: #28a745" id="btnsubmit"> Purchase Now <span class="load loading"></span></button>
                </div>
            </div>
            <div class="col-sm-4 ">
                <br>
                <script>
                    const btns = document.querySelectorAll('button');
                    btns.forEach((items)=>{
                        items.addEventListener('click',(evt)=>{
                            evt.target.classList.add('activeLoading');
                        })
                    })
                </script>
                <p>You can use the codes below to check your Airtime Balance!  </p>

                <h6>
                    <ul>
                        <li> MTN *556#</li>
                        <li>MTN [CG] *131*4# or *460*260#</li>
                        <li>9mobile  *223#</li>
                        <li>Airtel *123#</li>
                        <li>Glo *124*0#</li>
                    </ul>
                </h6>
                <br>
                <style>
                    img {
                        max-width: 100%;
                        height: auto;
                    }
                </style>
                <div class="card-body">
                    <div class="center">
                        <img    src="{{asset('images/tp.jpeg')}}" alt="#" />
                    </div>
                </div>

                <br>





            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

    </form>


</div>


</div>


