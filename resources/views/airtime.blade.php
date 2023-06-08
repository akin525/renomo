
@include('layouts.sidebar')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.min.css">
<!-- SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">

<!-- SweetAlert JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.js"></script>


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
    <!--    <h4 class="align-content-center text-center">Data Subscription</h4>-->

    <div class="loading-overlay" id="loadingSpinner" style="display: none;">
        <div class="loading-spinner"></div>
    </div>



    <form id="dataForm" >
        @csrf
        <div class="row">
            <div class="col-sm-8">
                <br>
                <br>
               <div id="AirtimePanel">
                   <div class="subscribe">
                       <p>AIRTIME PURCHASE</p>
{{--                       <input placeholder="Your e-mail" class="subscribe-input" name="email" type="email">--}}
                       <br/>
                       <div id="div_id_network" class="form-group">
                           <label for="network" class=" requiredField">
                               Network<span class="asteriskField">*</span>
                           </label>
                           <div class="">
                               <select name="id" class="text-success form-control" required="">

                                   <option value="m">MTN</option>
                                   <option value="g">GLO</option>
                                   <option value="a">AIRTEL</option>
                                   <option value="9">9MOBILE</option>

                               </select>
                           </div>
                       </div>
                       <br/>
                       <div id="div_id_network" >
                           <label for="network" class=" requiredField">
                               Enter Amount<span class="asteriskField">*</span>
                           </label>
                           <div class="">
                               <input type="number" id="amount" name="amount" min="100" max="4000" class="text-success form-control" required>
                           </div>
                       </div>
                       <br/>
                       <div id="div_id_network" class="form-group">
                           <label for="network" class=" requiredField">
                               Enter Phone Number<span class="asteriskField">*</span>
                           </label>
                           <div class="">
                               <input type="number" id="number" name="number" minlength="11" class="text-success form-control" required>
                           </div>
                       </div>
                       <input type="hidden" name="refid" value="<?php echo rand(10000000, 999999999); ?>">
                       <button type="submit" class="submit-btn">PURCHASE<span class="load loading"></span></button>
                   </div>
                </div>

            </div>
            <div class="col-sm-4 ">
                <br>

                <p><b>You can use the codes below to check your Airtime Balance!  </b> </p>


                <h6>
                    <ul class="list-group">
                        <b><li class="list-group-item list-group-item-primary bold"> MTN *556#</li></b>
                        <b><li class="list-group-item list-group-item-success">MTN [CG] *131*4# or *460*260#</li></b>
                        <b><li class="list-group-item list-group-item-action">9mobile  *223#</li></b>
                        <b><li class="list-group-item list-group-item-info">Airtel *123#</li></b>
                        <b><li class="list-group-item list-group-item-secondary">Glo *124*0#</li></b>
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

    </form>


</div>
<script>
    $(document).ready(function() {


            // Send the AJAX request
        $('#dataForm').submit(function(e) {
            e.preventDefault(); // Prevent the form from submitting traditionally

            // Get the form data
            var formData = $(this).serialize();
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you want to buy airtime of ₦' + document.getElementById("amount").value + ' on ' + document.getElementById("number").value +' ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // The user clicked "Yes", proceed with the action
                        // Add your jQuery code here
                        // For example, perform an AJAX request or update the page content
                        $('#loadingSpinner').show();

                        $.ajax({
                            url: "{{ route('buyairtime') }}",
                            type: 'POST',
                            data: formData,
                            success: function(response) {
                                // Handle the success response here
                                $('#loadingSpinner').hide();

                                console.log(response);
                                // Update the page or perform any other actions based on the response

                                if (response.status == 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: response.message
                                    }).then(() => {
                                        location.reload(); // Reload the page
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'info',
                                        title: 'Pending',
                                        text: response.message
                                    });
                                    // Handle any other response status
                                }

                            },
                            error: function(xhr) {
                                $('#loadingSpinner').hide();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'fail',
                                    text: xhr.responseText
                                });
                                // Handle any errors
                                console.log(xhr.responseText);

                            }
                        });

                    }
                });
            });
    });

</script>



