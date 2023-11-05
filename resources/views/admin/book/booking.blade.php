<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">





@extends('admin.dashboard')


@section('admin')

<style>
    .payment-image-container {
        width: 80px;
        height: 50px;
        overflow: hidden;
    }

    .payment-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* This property ensures the image covers the entire container */
        max-width: 100%;
        /* Limits the width to the container size */
        max-height: 100%;
        /* Limits the height to the container size */
    }

    /* Add this CSS to your stylesheets to style the table */
    .table th {
        font-size: 12px;
        /* Font size for table headers */
    }

    .table td {
        font-size: 12px;
        /* Font size for table data */
    }
</style>
<!-- Add these links in the <head> section of your HTML file -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>


<div class="container-fluid">
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
                        <h4> Are you certain you wish to give your approval? </h4>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Recent Payments Queue</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th style="width:80px;"><strong>#</strong></th>

                                    <th><strong>Customer Name</strong></th>
                                    <th><strong>Package</strong></th>
                                    <th> <strong>Prices</strong></th>
                                    <th> <strong>Date</strong></th>
                                    <th> <strong>Time</strong></th>
                                    <th> <strong>Payment Image</strong></th>
                                    <th style="text-align: center"><strong>Action</strong> </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(($bookCustomer) as $index => $item)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$item->users->name}}</td>
                                    <td>{{ str_replace(['[', ']', '"'], '', $item->package_names ) }}</td>
                                    <td>{{ $item->total_price}}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->date)->format('M d, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->time)->format('h:i A') }}</td>
                                    <td>
                                        <div class="payment-image-container">
                                            <a href="{{ $item->image }}" data-lightbox="payment-images" data-title="Payment Image">
                                                <img id="paymentImage" class="payment-image" src="{{ $item->image }}" alt="Payment Image">
                                            </a>
                                        </div>

                                    </td>
                                    <td style="text-align: center">
                                        <!-- <button type="button" class="btn btn-primary view-button" data-url="{{ route('admin.book.view', $item->id) }}">View</button> -->
                                        <button type="button" class="btn btn-success" data-url="{{ route('admin.show.approve', $item->id) }}" id="approve-button">Approve</button>
                                    </td>
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
    $(document).ready(function() {
        $('body').on('click', '#approve-button', function() {
            var userURL = $(this).data('url');
            $.get(userURL, function(data) {
                $('#modalApprove').modal('show');
                $('#book_id').val(data.id);
            })
        });
    });

    $(document).ready(function() {
        $('body').on('click', '.view-button', function() {
            var userURL = $(this).data('url');
            $.get(userURL, function(data) {
                // Preload the payment image
                var paymentImage = new Image();
                paymentImage.src = '/upload/payment_images/' + data[0].image;

                // Show the modal after the image is preloaded
                paymentImage.onload = function() {
                    $('#modalView').modal('show');
                    $('#cus_name').val(data[0].users.name);
                    $('#paymentImage').attr('src', paymentImage.src);
                    $('#price_id').val(data[0].price.price);
                };

                // Handle image loading errors (display placeholder image)
                paymentImage.onerror = function() {
                    $('#modalView').modal('show');
                    $('#cus_name').val(data[0].users.name);
                    $('#paymentImage').attr('src', data[0].image ? '/upload/payment_images/' + data[0].image : '/upload/no_image.jpg');
                    $('#price_id').val(data[0].price.price);
                };
                console.log(data[0].image);

            });
        });
    });
</script>