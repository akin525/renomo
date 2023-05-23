
@include('layouts.sidebar')
<style>
    .subscribe {
        position: relative;
        padding: 20px;
        background-color: #FFF;
        border-radius: 4px;
        color: #333;
        box-shadow: 0px 0px 60px 5px rgba(0, 0, 0, 0.4);
    }

    .subscribe:after {
        position: absolute;
        content: "";
        right: -10px;
        bottom: 18px;
        width: 0;
        height: 0;
        border-left: 0px solid transparent;
        border-right: 10px solid transparent;
        border-bottom: 10px solid #208b37;
    }

    .subscribe p {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        letter-spacing: 4px;
        line-height: 28px;
    }



    .subscribe .submit-btn {
        position: absolute;
        border-radius: 30px;
        border-bottom-right-radius: 0;
        border-top-right-radius: 0;
        background-color: #208b37;
        color: #FFF;
        padding: 12px 25px;
        display: inline-block;
        font-size: 12px;
        font-weight: bold;
        letter-spacing: 5px;
        right: -10px;
        bottom: -20px;
        cursor: pointer;
        transition: all .25s ease;
        box-shadow: -5px 6px 20px 0px rgba(26, 26, 26, 0.4);
    }

    .subscribe .submit-btn:hover {
        background-color: #208b37;
        box-shadow: -5px 6px 20px 0px rgba(88, 88, 88, 0.569);
    }
</style>


<div style="padding:90px 15px 20px 15px">
    <form action="{{ route('datapan') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-sm-8">
                <br>
                <br>
                <div class="subscribe">
                <div id="AirtimePanel">

                    <x-jet-validation-errors class="alert alert-danger" />

                    <div id="div_id_network" class="form-group">
                        <label for="network" class=" requiredField">
                            Network<span class="asteriskField">*</span>
                        </label>
                        <div class="">
                            <select name="id" class="text-success form-control" required="">

                                <option value="m">MTN</option>

                            </select>
                        </div>
                    </div>

                    <select  name="productid" class="text-success form-control" onChange="myNewFunction(this);" required="">

                            <option value="data_pin" >[mtn] 1.5GB (DATAPIN) ₦{{$product->tamount}}
                            </option>

                    </select>
                    <input type="hidden" name="refid" value="<?php echo rand(10000000, 999999999); ?>">
                    <button type="submit" class="submit-btn">PURCHASE<span class="load loading"></span></button>
                    {{--                    <button type="submit" class=" btn" style="color: white;background-color: #28a745" id="warning"> Purchase Now<span class="load loading"></span></button>--}}
                    <script>
                        const btns = document.querySelectorAll('button');
                        btns.forEach((items)=>{
                            items.addEventListener('click',(evt)=>{
                                evt.target.classList.add('activeLoading');
                            })
                        })
                    </script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.js"></script>
                    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script src="sweetalert2.all.min.js"></script>
                    <script>
                            //Warning Message
                            $('#warning').click(function () {
                            swal({
                                title: 'Are you sure?',
                                text: "You won't be able to revert this!",
                                type: 'warning',
                                showCancelButton: true,
                                cancelButtonClass: 'btn btn-danger',
                                // cancelButtonUrl: window.location = "#";
                                confirmButtonText: 'Yes, delete it!'
                            }).then(function (result) {
                                if (result.value) {
                                    console.log(window.url);
                                    window.location.href = "#";
                                }
                            });
                        });

                    </script>


                </div>
                </div>
            </div>
            <div class="col-sm-4 ">
                <br>
                <ul class="list-group">
                    <li class="list-group-item list-group-item-primary"><b>Please follow these steps:</b></li>
                    <li class="list-group-item list-group-item-success"> <b>Dial *460*6*1#</b></li>
                    <li class="list-group-item list-group-item-action"> <b>Enter the Pin given to you in the box</b></li>
                    <li class="list-group-item list-group-item-info">Click on Send </li>
                </ul>
                <br>
                <style>
                    img {
                        max-width: 100%;
                        height: auto;
                    }
                </style>

                <br>

            </div>
        </div>

    </form>
</div>



