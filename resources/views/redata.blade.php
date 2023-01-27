@include('layouts.sidebar')

<div class="row">
    <!--    <div class="card">-->
    <div class="card-body">
        <div class="module-head">
            <center><h3>
                    Buy Data</h3></center>
        </div>
        <center>
            <script>
                function myNewFunction(sel) {
                    // alert(sel.options[sel.selectedIndex].id);
                    document.getElementById("po").value = (sel.options[sel.selectedIndex].id);
                    document.getElementById("pk").value = (sel.options[sel.selectedIndex].text);
                }
            </script>
            <div class="btn-controls">
                @if(\Illuminate\Support\Facades\Auth::user()->pin=="0")
                <form action="{{ route('bill') }}" method="post">
                    @else
                        <form action="{{ route('pin1') }}" method="post">
                            @endif

                        @csrf
                    <label for="network" class=" requiredField">
                        Select Network from the Rectangular Box<span class="asteriskField">*</span>
                    </label>
                    <select  name="productid" class="text-success form-control" onChange="myNewFunction(this);" required="">
                        <option>-------</option>
                        @foreach($data as $datas)
                                <option value="{{$datas->id}}" id="{{$datas->ramount}}" >{{$datas->network}}{{$datas->plan}} | {{$datas->ramount}}
                                </option>
                                @endforeach

                    </select>
                    <br>
                    <label for="network" class=" requiredField">
                        Amount<span class="asteriskField">*</span>
                    </label>
                    <input name="amount" class="text-success form-control" value="" placeholder="Amount" id="po" readonly>
<br>
                    <input type="hidden" name="id" value="<?php echo rand(10000000, 999999999); ?>">

                    <label for="network" class=" requiredField">
                        Enter Phone no<span class="asteriskField">*</span>
                    </label>
                    <input type="number" name="number" class="form-control" required>
                    <br>
                    <button type="submit" class=" btn" style="color: white;background-color: #28a745">Buy Now<span class="load loading"></span></button>
                </form>
        </center>
        <br>
        <script>
            const btns = document.querySelectorAll('button');
            btns.forEach((items)=>{
                items.addEventListener('click',(evt)=>{
                    evt.target.classList.add('activeLoading');
                })
            })
        </script>



        <p>You can use the codes below to check your Data Balance!  </p>

        <h6>
            <ul>
                <li> MTN [SME] *461*4# or *556#</li>
                <li>MTN [CG] *131*4# or *460*260#</li>
                <li>9mobile [Gifting] *228#</li>
                <li>Airtel *140#</li>
                <li>Glo *127*0#</li>
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
                <img    src="{{asset('images/banner.jpeg')}}" alt="#" />
            </div>
        </div>

        <br>
    </div>
</div>
</div>
</center>
