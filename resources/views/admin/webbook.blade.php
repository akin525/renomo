@include('admin.layouts.sidebar')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">All Webbook</h4>
                {{--                    <p class="text-muted mb-4 font-13">Use <code>pencil icon</code> to view user profile.</p>--}}
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                        <tr>
                            <th>Code</th>
                            <th>Message</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($book as $dat)
                            <tr>
                                <td>{{$dat->code}}</td>
                                <td>{{$dat->message}}</td>
                                <td>{{$dat->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $book->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>
<!-- end row -->
@include('layouts.footer')
