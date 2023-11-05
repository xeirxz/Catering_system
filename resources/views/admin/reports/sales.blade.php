@extends('admin.dashboard')



@section('admin')
    <div class="page-content">

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Sales Report</h6>
                        @php
                            $totalPrice = 0;
                        @endphp
                        {{-- <p class="text-muted mb-3">Add class <code>.table-bordered</code></p> --}}
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered" id="data-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer Name</th>
                                        <th>Package</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sales_data as $index => $item)

                                    {{-- @php
                                        $jsonData = explode(', ', $item->package_id);
                                    @endphp --}}
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->users->name }}</td>
                                            <td style="white-space: pre-wrap;">{{ str_replace(['[', ']', '"'], '', $item->package_id) }}</td>
                                            <td>₱ {{ $item->price->price }}.00</td>
                                        </tr>
                                        @php
                                            $totalPrice += $item->price->price;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table> <br> <br>
                            <div style="text-align: right">
                                <h3>Total Sales: ₱ {{ $totalPrice }}.00</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
