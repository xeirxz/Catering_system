@extends('customer.dashboard')
@section('customer')

<form action="{{route('submitPayment')}}" method="post" enctype="multipart/form-data">

    @csrf

    <!-- Hidden fields to carry data forward -->
    <input type="hidden" name="booking_id" value="{{ $booking->id }}">
    <input type="hidden" name="total_price" value="{{ $booking->price->price * $booking->number_of_packs }}">

    <!-- Display booking details (sender, receiver, items, total, etc.) -->

    <!-- Number of Packs (muted text, non-editable) -->
    <div class="mb-3">
        <label for="number_of_packs" class="form-label">Number of Packs</label>
        <span class="text-muted">{{ $booking->number_of_packs }}</span>
    </div>

    <!-- Total Amount to Pay (muted text, non-editable) -->
    <div class="mb-3">
        <label for="total_amount" class="form-label">Total Amount to Pay</label>
        <span class="text-muted">${{ $booking->price->price * $booking->number_of_packs }}</span>
    </div>

    <!-- Payment Method (muted text, non-editable) -->
    <div class="mb-3">
        <label for="payment_method" class="form-label">Payment Method:</label>
        <span class="text-muted">{{ $booking->payment_method }}</span>
    </div>

    <!-- Payment Image Upload -->
    <div class="mb-3">
        <label for="payment_image" class="form-label">Upload Payment Image</label>
        <input type="file" class="form-control" id="payment_image" name="payment_image" required>
    </div>

    <button type="submit" class="btn btn-primary">Submit Payment</button>
</form>


@endsection