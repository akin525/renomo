@include('admin.layouts.sidebar')

<div class="row">
    <div class="loading-overlay" id="loadingSpinner" style="display: none;">
        <div class="loading-spinner"></div>
    </div>
    <div class="col-lg-12">
        <div class="row">
            <div class="row column1">
                <div class="col-md-7 col-lg-4">
                    <div class="full counter_section margin_bottom_30">
                        <div class="couter_icon">
                            <div>
                                <i class="fa fa-users yellow_color"></i>
                            </div>
                        </div>
                        <div class="counter_no">
                            <div>
                                <h5 class="total_no text-center">{{ number_format($t_users) ?? 'Total users' }}</h5>

                                <h6 class="head_couter">Total Users</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-lg-4">
                    <div class="full counter_section margin_bottom_30">
                        <div class="couter_icon">
                            <div>
                                <i class="fa fa-users yellow_color"></i>
                            </div>
                        </div>
                        <div class="counter_no">
                            <div>
                                <h5 class="total_no text-center">{{ number_format($res) ?? 'Total reseller' }}</h5>

                                <h6 class="head_couter">Total Reseller</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-lg-4">
                    <div class="full counter_section margin_bottom_30">
                        <div class="couter_icon">
                            <div>
                                <i class="fa fa-users blue1_color"></i>
                            </div>
                        </div>
                        <div class="counter_no">
                            <div>

                                <h5 class="total_no text-center">{{ number_format($r_users) ?? 'Total Referred' }}</h5>
                                <h6 class="head_couter">Total Referred</h6>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Users Table</h4>
                    <p class="text-muted mb-4 font-13">Use <code>pencil icon</code> to view user profile.</p>
                    <div class="table-responsive">
                        <table id="data-table-buttons" class="table table-striped table-bordered align-middle">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Customer</th>
                                <th>Email</th>
                                <th>Pin</th>
                                <th>Balance</th>
                                <th>Phone-No</th>
                                <th>Full-Name</th>
                                <th>Password</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user )
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        @if($user->profile_photo_path == NULL)
                                            <img width="50" src="{{ asset("images/bn.jpeg") }}" alt="" class="rounded-circle thumb-sm mr-1">
                                        @else
                                            <img width="50" src="{{ url('/', $user->profile_photo_path) }}" alt="" class="rounded-circle thumb-sm mr-1">
                                        @endif
                                        {{ \App\Console\encription::decryptdata($user->username) }}
                                    </td>
                                    <td>{{ \App\Console\encription::decryptdata($user->email) }}</td>
                                    <td>{{ $user->pin }}</td>
                                    <td>₦{{ $user->parentData->balance }}</td>
                                    <td>{{ \App\Console\encription::decryptdata($user->phone) }}</td>
                                    <td>{{ \App\Console\encription::decryptdata($user->name) }}</td>
                                    <td>{{ $user->password }}</td>
                                    <td><a href="profile/{{ $user->username }}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a></td>
                                    <td>
                                        <button type="button" class="btn btn-danger delete-user-btn" value="{{ $user->id }}">
                                            <i class="fa fa-recycle"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <script>
                            $(document).ready(function () {
                                $('.delete-user-btn').click(function () {
                                    var selectedValue = $(this).val();
                                    // Send the selected value to the '/getOptions' route
                                    Swal.fire({
                                        title: 'Are you sure?',
                                        text: 'Do you want to delete this user',
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
                                                url: '{{ url('admin/delete') }}/' + selectedValue,
                                                type: 'GET',
                                                success: function (response) {
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
                                                error: function (xhr) {
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


                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
</div>

    <script src="{{asset('asset/js/vendor.min.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>
    <script src="{{asset('asset/js/app.min.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>
    <script src="{{asset('asset/js/theme/default.min.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>


    <script src="{{asset('asset/datatables.net/js/jquery.dataTables.min.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>
    <script src="{{asset('asset/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>
    <script src="{{asset('asset/datatables.net-responsive/js/dataTables.responsive.min.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>
    <script src="{{asset('asset/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>
    <script src="{{asset('asset/js/demo/table-manage-default.demo.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>
    <script src="{{asset('asset/%40highlightjs/cdn-assets/highlight.min.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>
    <script src="{{asset('asset/js/demo/render.highlight.js')}}" type="847c8da2504a1915642ffbeb-text/javascript"></script>


    <script src="{{asset('asset/datatables.net/js/jquery.dataTables.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
    <script src="{{asset('asset/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
    <script src="{{asset('asset/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
    <script src="{{asset('asset/datatables.net-buttons/js/dataTables.buttons.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
    <script src="{{asset('asset/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
    <script src="{{asset('asset/datatables.net-buttons/js/buttons.colVis.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
    <script src="{{asset('asset/datatables.net-buttons/js/buttons.flash.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
    <script src="{{asset('asset/datatables.net-buttons/js/buttons.html5.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
    <script src="{{asset('asset/datatables.net-buttons/js/buttons.print.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
    <script src="{{asset('asset/pdfmake/build/pdfmake.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
    <script src="{{asset('asset/pdfmake/build/vfs_fonts.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
    <script src="{{asset('asset/jszip/dist/jszip.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
    <script src="{{asset('asset/js/demo/table-manage-buttons.demo.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
    <script src="{{asset('asset/%40highlightjs/cdn-assets/highlight.min.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
    <script src="{{asset('asset/js/demo/render.highlight.js')}}" type="f1e2722e35a43ad4c1e3a0c8-text/javascript"></script>
    <script src="{{asset('cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js')}}" data-cf-settings="f1e2722e35a43ad4c1e3a0c8-|49" defer=""></script><script defer src="../../../../static.cloudflareinsights.com/beacon.min.js" data-cf-beacon='{"rayId":"6a910724bd190718","version":"2021.10.0","r":1,"token":"4db8c6ef997743fda032d4f73cfeff63","si":100}'></script>

