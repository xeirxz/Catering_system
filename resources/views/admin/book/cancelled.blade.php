
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">





@extends('admin.dashboard')


@section('admin')




<div class="modal fade" id="modalApprove" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Approve Booking</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
        </div>
        <div class="modal-body" style="text-align: center">
            <form action="{{ route('admin.book.update') }}" method="POST">
                @csrf
                <input type="number" id="book_id" name="book_id" hidden class="form-control">
                <input type="number" id="approve" name="approve" value="2" hidden class="form-control">
                <h4> Are you sure you want to approve? </h4>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <button type="submit" class="btn btn-primary">Yes</button>
        </form>
        </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalView" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label class="form-label">Customer Name:</label>
                <input type="text" class="form-control" id="cus_name" name="cus_name">
            </div>

            <div class="mb-3">
                <label class="form-label">Package:</label>
                <input type="text" class="form-control" id="pack_id" name="pack_id">
            </div>


            <div class="mb-3">
                <label class="form-label">Package:</label>
                <input type="text" class="form-control" id="price_id" name="price_id">
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>



<div class="page-content">

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Booking Table</h6>
                    {{-- <p class="text-muted mb-3">Add class <code>.table-bordered</code></p> --}}
                    <div class="table-responsive pt-3">
                        <table class="table table-bordered" id="data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer Name</th>
                                    <th>Package</th>
                                    <th>Price</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(($bookCustomer) as $index => $item)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$item->users->name}}</td>
                                    <td style="white-space: pre-wrap;"> {{ str_replace(['[', ']', '"'], '', $item->package_id) }} </td>
                                    <td>{{ $item->price->price }}</td>

                                    <td>{{ \Carbon\Carbon::parse($item->date)->format('M d, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->time)->format('h:i A') }}</td>
                                    <td><span class="badge rounded-pill bg-danger">Cancelled</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Add these lines to include jQuery and Axios -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>


<script>
        $(document).ready(function () {
            $('body').on('click', '#approve-button', function () {
            var userURL = $(this).data('url');
            $.get(userURL, function (data) {
                $('#modalApprove').modal('show');
                $('#book_id').val(data.id);
                })
            });
        });


        $(document).ready(function () {
            $('body').on('click', '.view-button', function () {
            var userURL = $(this).data('url');
            $.get(userURL, function (data) {
                console.log(data[0]);
                $('#modalView').modal('show');
                $('#cus_name').val(data[0].users.name);
                $('#pack_id').val(data[0].package_id);
                $('#price_id').val(data[0].price.price);
                })
            });
        });
</script>


