@include('admin.layouts.sidebar')

    <div class="row">
        <div class="loading-overlay" id="loadingSpinner" style="display: none;">
            <div class="loading-spinner"></div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            {{ session('error') }}
                        </div>
                    @endif
                    <p class="text-muted mb-4 font-13">Product Controller</p>
                        <div class="table-responsive">
                            <table id="data-table-buttons" class="table table-striped table-bordered align-middle">
                                <thead>
                        <tr>
                            <th>Network</th>
                            <th>Plan</th>
                            <th>Actual Amount</th>
                            <th>Selling Amount</th>
                            <th>Reseller Amount</th>
                            <th>Status</th>
                            <th>Switch</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($product as $seller)
                            <tr>
                                <link rel="stylesheet" href="{{asset('style.css')}}">
                                <!--Only for demo purpose - no need to add.-->
                                <link rel="stylesheet" href="{{asset('demo.css')}}"/>
                                <td> {{$seller->network}} </td>
                                <td> {{$seller->plan}}</td>
                                <td> {{$seller->amount}}</td>
                                <td> {{$seller->tamount}}</td>
                                <td> {{$seller->ramount}}</td>
                                {{--                                <td><a href="{{route('editpayment', $pay->id)}}"--}}
                                {{--                                       {{$pay->value}}class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>--}}
                                {{--                                </td>--}}
                                <td>@if($seller->status=="1")<h6 class="btn-success">Active</h6>@else<h6
                                        class="btn-warning">
                                        Not-Active</h6> @endif</td>
                                <td>
                                    <label class="toggleSwitch nolabel">
                                        <input type="checkbox" name="status" value="0" id="myCheckBox"
                                               {{$seller->status =="1"?'checked':''}}
                                               {{--                                            @if($pay->status==1?'checked':'')--}}
                                               onclick="window.location='{{route('admin/pd1', $seller->id)}}'"/>
                                        <!--                                            <button  type="submit" class="btn-info col-lg">Update</button>-->
                                        <span>
                                                <span>off</span>
                                                <span>on</span>
                                             </span>

                                        <a></a>
                                    </label>
                                </td>
                                <td>
                                    <button  type="button" class="btn btn-primary" onclick="openModal(this)" data-user-id="{{$seller->id}}" data-user-name="{{$seller->plan}}" >
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$product->links()}}
                            <style>
                                /* Add your CSS styles here */
                                .modal {
                                    display: none;
                                    position: fixed;
                                    top: 0;
                                    left: 0;
                                    width: 100%;
                                    height: 100%;
                                    background-color: rgba(0, 0, 0, 0.5);
                                }
                                .modal-content {
                                    background-color: white;
                                    width: 60%;
                                    max-width: 400px;
                                    margin: 100px auto;
                                    padding: 20px;
                                    border-radius: 5px;
                                }
                            </style>
                            <div class="modal" id="editModal">
                                <div class="modal-content">
                                    <form id="dataForm" >
                                        @csrf
                                        <div class="card card-body">
                                            <p>EDIT PRODUCT</p>
                                            {{--                       <input placeholder="Your e-mail" class="subscribe-input" name="email" type="email">--}}
                                            <br/>
                                            <div class="form-group">
                                                <label>Product-Plan</label>
                                                <input type="text" class="form-control" id="plan"  name="name" value="" readonly />
                                                <input type="hidden" class="form-control" id="id" name="id" value="" required />
                                            </div>
                                            <br/>
                                            <div id="div_id_network" >
                                                <label for="network" class=" requiredField">
                                                    Enter selling Amount<span class="asteriskField">*</span>
                                                </label>
                                                <div class="">
                                                    <input type="number" id="amount" name="tamount"  class="text-success form-control" required>
                                                </div>
                                            </div>
                                            <br/>
                                            <div id="div_id_network" >
                                                <label for="network" class=" requiredField">
                                                    Enter Reseller Amount<span class="asteriskField">*</span>
                                                </label>
                                                <div class="">
                                                    <input type="number" id="amount" name="ramount"  class="text-success form-control" required>
                                                </div>
                                            </div>
                                            <br/>
                                            <button type="submit" class="btn btn-outline-success">Update</button>
                                        </div>
                                    </form>
                                    <button class="btn btn-outline-danger" onclick="closeModal()">Cancel</button>
                                </div>
                            </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
        <script>
            function openModal(element) {
                const modal = document.getElementById('editModal');
                const newNameInput = document.getElementById('id');
                const net = document.getElementById('plan');
                const userId =element.getAttribute('data-user-id');
                const userName = element.getAttribute('data-user-name');



                newNameInput.value = userId;
                net.value = userName;

                console.log(newNameInput);
                console.log(net);
                modal.style.display = 'block';
                // You can fetch user data using the userId and populate the input fields in the modal if needed
            }

            function closeModal() {
                const modal = document.getElementById('editModal');
                modal.style.display = 'none';
            }

            function saveChanges() {
                // Add code here to save the changes and update the table
                closeModal();
            }
        </script>

        <script>
            $(document).ready(function() {


                // Send the AJAX request
                $('#dataForm').submit(function(e) {
                    e.preventDefault(); // Prevent the form from submitting traditionally

                    // Get the form data
                    var formData = $(this).serialize();
                    // The user clicked "Yes", proceed with the action
                    // Add your jQuery code here
                    // For example, perform an AJAX request or update the page content
                    $('#loadingSpinner').show();

                    $.ajax({
                        url: "{{route('admin/do1')}}",
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
                });
            });

        </script>


        <!-- end row -->
@include('layouts.footer')
