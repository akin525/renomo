
@include('layouts.sidebar')


<div style="padding:90px 15px 20px 15px">
    <form action="{{ route('datapan') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-sm-8">
                <br>
                <br>
                <div id="AirtimeNote" class="alert alert-danger" style="text-transform: uppercase;font-weight: bold;font-size: 23px;display: none;"></div>
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
                    <button type="submit" class=" btn" style="color: white;background-color: #28a745" id="warning"> Purchase Now<span class="load loading"></span></button>
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



