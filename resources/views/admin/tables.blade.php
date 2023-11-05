@extends('admin.dashboard')



@section('admin')

<div class="page-content">


    <div class="modal fade" id="modalView" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Category Name:</label>
                    <input type="text" class="form-control" readonly id="cat_name" >

                    <input hidden type="text" class="form-control" id="cat_id" >
                </div>

                <div class="mb-3">
                    <label class="form-label">Description:</label>
                    <input type="text" class="form-control" readonly id="desc" >
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('category.udpate') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Category Name:</label>
                        <input type="text" class="form-control"  id="cat_name2" name="cat_name2">

                        <input type="text" hidden class="form-control" id="cat_id2" name="cat_id2">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description:</label>
                        <input type="text" class="form-control"  id="desc2" name="desc2">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalViewPack" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View / Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.update.pack')}}" method="POST">
                    @csrf
                <div class="mb-3">
                    <label class="form-label">Package Name:</label>
                    <input type="text" class="form-control" id="pack_name" name="pack_name" >

                    <input type="text" hidden class="form-control" id="pack_id"  name="pack_id">
                    <input type="text" class="form-control" id="pack_name2" hidden  name="pack_name2">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
            </div>
        </div>
    </div>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Category Table</h6>
                        {{-- <p class="text-muted mb-3">Add class <code>.table-bordered</code></p> --}}
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered" id="data-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category Name</th>
                                        <th>Description</th>
                                        <th style="text-align: center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(($data) as $index => $item)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->description}}</td>
                                        <td style="text-align: center">
                                            <button type="button" data-url="{{ route('category.view', $item->id) }}" class="btn btn-primary view-button" >View</button>
                                            <button type="button" data-url="{{ route('category.edit.cat', $item->id) }}" class="btn btn-success edit-button" >Edit</button>
                                            <button type="button" class="btn btn-danger delete-button">Delete</button>
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



        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Package Table</h6>
                        {{-- <p class="text-muted mb-3">Add class <code>.table-bordered</code></p> --}}
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered" id="data-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Menu</th>
                                        <th style="text-align: center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(($packages) as $index => $pack)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$pack->menu}}</td>
                                        {{-- <td>{{$item->description}}</td> --}}
                                        <td style="text-align: center">
                                            <button type="button" data-url="{{ route('admin.show.pack', $pack->id) }}" class="btn btn-primary view-button-package" >View</button>
                                            {{-- <button type="button" class="btn btn-success edit-button-package">Edit</button> --}}
                                            <button type="button" class="btn btn-danger delete-button">Delete</button>
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

    // $(document).ready(function() {
    //     axios.get('/priceTable')
    //         .then(function(response) {
    //             var responseData = response.data.result;

    //             console.log(responseData);

    //             $('#data-table tbody').empty();
    //             // Iterate through the data and append rows to the table
    //             responseData.forEach(function(item, index) {
    //                 $('#data-table tbody').append(
    //                     '<tr>' +
    //                         '<td>' + (index + 1) + '</td>' +
    //                         '<td>' + item.name + '</td>' +
    //                         '<td>' + item.description + '</td>' +
    //                         '<td style="text-align: center" >' +
    //                             '<button type="button" class="btn btn-primary view-button" data-id="' + item.id + '" style="margin-right: 5px" data-bs-toggle="modal" data-bs-target="#exampleModal">View</button>' +
    //                             '<button type="button" class="btn btn-success"  style="margin-right: 5px">Edit</button>' +
    //                             '<button type="button" class="btn btn-danger"  style="margin-right: 5px">Delete</button>' +
    //                         '</td>' +
    //                     '</tr>'
    //                 );
    //             });
    //         })
    //         .catch(function(error) {
    //             console.error(error);
    //         });

    // });


    $(document).ready(function () {

    $('body').on('click', '.view-button', function () {
    var userURL = $(this).data('url');
    $.get(userURL, function (data) {
        $('#modalView').modal('show');
        $('#cat_id').val(data.id);
        $('#cat_name').val(data.name);
        $('#desc').val(data.description);
        })
    });
});


$(document).ready(function () {
$('body').on('click', '.view-button-package', function () {
    var userURL = $(this).data('url');
    $.get(userURL, function (data) {
        $('#modalViewPack').modal('show');
        $('#pack_id').val(data.id);
        $('#pack_name').val(data.menu);
        $('#pack_name2').val(data.menu);
        // $('#desc').val(data.description);
        })
    });
});


$(document).ready(function () {

$('body').on('click', '.edit-button', function () {
var userURL = $(this).data('url');
$.get(userURL, function (data) {
    $('#modalEdit').modal('show');
    $('#cat_id2').val(data.id);
    $('#cat_name2').val(data.name);
    $('#desc2').val(data.description);
    })
});
});




</script>
