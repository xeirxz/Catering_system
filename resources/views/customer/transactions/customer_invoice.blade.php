@extends('customer.dashboard')
@section('customer')
<div class="container-fluid">
    <!-- ... Other content ... -->

    <div class="row mb-5">
        <!-- Sender's Information -->
        <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-12">
            <h6>To:</h6>
            <div><strong>Name</strong></div>
            <div>{{ $booking->users->name }}</div>
            <div><strong>Address</strong></div>
            <div>{{ $booking->users->address}}</div>
            <div><strong>Phone</strong></div>
            <div>{{ $booking->users->phone}}</div>
            <!-- Add more sender's information if needed -->
        </div>

        <!-- Receiver's Information -->
        <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-12">
            <h6>Payment Method:</h6>
            <div>{{ $booking->payment_method }}</div>
        </div>
        <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-12">
            <h6>Payment Method:</h6>
            <div>{{ $booking->payment_type }}</div>
        </div>

        <!-- Payment Details -->
        <div class="mt-4 col-xl-6 col-lg-6 col-md-12 col-sm-12 d-flex justify-content-lg-end justify-content-md-center justify-content-xs-start">
            <!-- Payment instructions and QR code -->
        </div>
    </div>

    <!-- Table of Items -->
    <!-- Table of Items -->
    <!-- Table of Items -->

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="center">#</th>
                    <th>Item</th>
                    <th>Variant</th>
                    <th>Description</th>

                </tr>
            </thead>
            <tbody>
                <!-- Loop through the package items -->
                @foreach($packages as $index => $package)
                <tr>
                    <td class="center">{{ $index + 1 }}</td>
                    <td class="left strong">{{ $package->menu }}</td>
                    <td class="left">{{ $package->variant }}</td>
                    <td class="left">{{ $package->variant_description }}</td>

                    <!-- Get the price from the JSON data -->
                    @php
                    $packageData = json_decode($package->price, true);
                    $price = $packageData['price'] ?? 0;
                    @endphp


                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <!-- Summary Section -->
    <div class="row">
        <div class="col-lg-4 col-sm-5"></div>
        <div class="col-lg-4 col-sm-5 ms-auto">
            <table class="table table-clear">
                <tbody>
                    <tr>
                        <td class="left"><strong>Package Price</strong></td>
                        <td class="right">${{ $booking->price->price }}</td>
                    </tr>

                    <tr>
                        <td class="left"><strong>Number of Packs</strong></td>
                        <td class="right">{{ $booking->number_of_packs }}</td>
                    </tr>
                    <tr>
                        <td class="left"><strong>Subtotal</strong></td>
                        <td class="right">${{ $booking->price->price * $booking->number_of_packs }}</td>
                    </tr>
                    <!-- Add more summary rows if needed -->
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4 col-xl-4 col-lg-4 col-md-12 col-sm-12 d-flex justify-content-end">
        <a href="{{ route('payment', ['booking' => $booking]) }}" class="btn btn-primary">Proceed to Payment</a>
    </div>
</div>
@endsection