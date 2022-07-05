@include('layouts.sidebar')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row justify-content-lg-center">
            <div class="col-lg-10">

                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title text-white">Create Safe-lock</h3>
                            <ul class="breadcrumb">
                                <li class=""><a href="{{route('dashboard')}}">Home</a></li>
                                {{--                                <li class="breadcrumb-item active">Profile</li>--}}
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                {{--                                <h4 class="card-title">Basic Info</h4>--}}
                                <x-jet-validation-errors class="mb-4 alert-danger alert-dismissible alert"/>

                                <script src=
                                        "https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js">
                                </script>
                                @if (session('status'))
                                   <script>
                                       Swal.fire({
                                           toast: true,
                                           icon: 'success',
                                           title: '{{ session('status') }}',
                                           confirmButtonText: "ok",
                                           confirmButtonColor: "#28a745",
                                       })
                                   </script>
                                @endif

                                @if (session('error'))
                                    <div class="mb-4 font-medium text-sm alert-danger alert-dismissible alert">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                @if (session('success'))
                                    <script>
                                        Swal.fire({
                                            toast: true,
                                            icon: 'success',
                                            title: '{{ session('success') }}',
                                            confirmButtonText: "ok",
                                            confirmButtonColor: "#28a745",
                                        })
                                    </script>
                                @endif

                                <form action="{{route('safe')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tittle</label>
                                                <input type="text" class="form-control" name="tittle" required/>
                                            </div>
                                            <div class="form-group">
                                                <label>Full-Name</label>
                                                <input name="name" type="text" class="form-control"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input name="username" type="text" class="form-control" value="{{\App\Console\encription::decryptdata(Auth::user()->username)}}" readonly
                                                       required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="amount">Amount</label>
                                                <input type="text" name="amount" id="amount" class="form-control"
                                                       placeholder="Enter amount" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="amount">Withdraw Date</label>
                                                <input type="date" name="date" class="form-control"
                                                          placeholder="Enter tranfer note" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end mt-4">
                                        <button type="submit" class="btn btn-primary">Create</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
