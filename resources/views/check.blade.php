@include('layouts.sidebar')
<div class="content">
    <div class="module">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Verify Bill</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="general-label">

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
                    <div class="alert alert-info alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        Kindly Provide the Refid of the transaction you purchase on our website
                    </div>
                <form class="form-horizontal" id="check">
                    @csrf
                    <div class="form-group row bg-white rounded text-center">
                        <div class="col-md-12">
                            <div class="input-group mt-2">
                                <div class="input-group-prepend"><span class="input-group-text">REF</span></div>
                                <input type="text" name="refid" placeholder="Enter server reference" class="form-control @error('ref') is-invalid @enderror" required>
                                <button class="btn btn-success" type="submit" style="align-self: center; align-content: center"><i class="fa fa-search"></i>Verify</button>
                            </div>
                            @error('ref')
                            <div class="alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <!--end row-->
                </form>
            </div>
        </div>
    </div>
</div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#dataForm2').submit(function(e) {
            e.preventDefault(); // Prevent the form from submitting traditionally
            // Get the form data
            var formData = $(this).serialize();
                    Swal.fire({
                        title: 'Processing',
                        text: 'Please wait...',
                        icon: 'info',
                        allowOutsideClick: false,
                        showConfirmButton: false
                    });
                    // The user clicked "Yes", proceed with the action
                    // Add your jQuery code here
                    // For example, perform an AJAX request or update the page content
                    $('#loadingSpinner').show();
                    $.ajax({
                        url: "{{ route('check') }}",
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            // Handle the success response here
                            $('#loadingSpinner').hide();

                            console.log(response);
                            // Update the page or perform any other actions based on the response

                            if (response.status == '1') {
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



            // Send the AJAX request
        });
    });

</script>

@if($result ?? '')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Search Result(s)</h4>
{{--                    <p class="text-muted mb-4 font-13">Total Result <code>{{$count}}</code></p>--}}
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>Username</th>
                                <th>Product</th>
                                <th>Phone Number</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$check->id}}</td>
                                    <td>{{\App\Console\encription::decryptdata($check->username) }}</td>
                                    <td>{{$check->product}}</td>
                                    <td>{{$check->number}}</td>
                                    <td>@if($check->status==1)
                                    <span class="badge badge-success">Successfully Delivered</span>
                                        @else
                                            <span class="badge badge-success">Pending Transaction</span>
                                        @endif
                                    </td>
                                    <td>{{$check->timestamp}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
@endif
