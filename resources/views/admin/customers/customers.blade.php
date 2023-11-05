@extends('admin.dashboard')


@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Customer List</h6>
                        {{-- <p class="text-muted mb-3">Add class <code>.table-bordered</code></p> --}}
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered" id="data-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th style="text-align: center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $index => $item)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->address}}</td>
                                        <td style="text-align: center">
                                            <button type="button" class="btn btn-primary view-button" >View</button>

                                            {{-- <button type="button" class="btn btn-danger delete-button">Delete</button> --}}
                                        </td>
                                        {{-- <td>{{$item->name}}</td>
                                        <td>{{$item->description}}</td> --}}
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
