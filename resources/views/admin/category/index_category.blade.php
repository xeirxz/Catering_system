@extends('admin.dashboard')
@section('admin')



<style>
    .btn-icon {
        border: none;
        transition: color 0.3s ease;

    }

    .btn-icon .icon {
        transition: color 0.3s ease;
        color: inherit;
        /* Inherit the color from the parent .btn-icon */
        background-color: transparent;

    }

    .btn-icon:hover .icon {
        color: #007bff;
    }
</style>

<div class="container-fluid">
    <div class="row page-titles">
        <div class="custom-tab-1">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @foreach ($byCategory as $category)
                <li class="nav-item">
                    <a type="button" class="nav-link  @if ($loop->first) active @endif" id="{{ 'tab-' . $category->id }}" data-bs-toggle="tab" href="#{{ 'content-' . $category->id }}" role="tab" aria-controls="{{ 'content-' . $category->id }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ $category->name }}</a>
                </li>
                @endforeach
                <li class="nav-item ms-auto">

                    <a href="{{ route('category.add') }}" class="align-items-center py-2">
                        <button type="button" class="btn btn-icon btn-primary">
                            <i class="bi bi-plus-square-fill icon"></i> Add Package
                        </button>
                    </a>


                </li>
            </ul>
        </div>
    </div>

    <div class="row tab-content custom-tab-content" id="myTabContent">
        @foreach ($byCategory as $category)
        <div class="tab-pane fade card @if ($loop->first) show active @endif" id="{{ 'content-' . $category->id }}" role="tabpanel" aria-labelledby="{{ 'tab-' . $category->id }}" style="background-color: transparent; box-shadow: none;">
            <div class="row">
                @foreach ($byPrice as $price)
                @if ($price->category_id == $category->id)
                <div class="col-xl-3 col-lg-6 col-sm-6 mb-4">
                    <a href="{{ route('show.package', ['id' => $price->id]) }}" class="card-link">
                        <div class="card">
                            <div class="card-body">
                                <div class="new-arrival-product">
                                    <div class="new-arrivals-img-contnent">
                                        <img class="img-fluid" src="{{ asset('assets/images/product/pizz1.jpg') }}" alt="" style="border-radius: 10px;">

                                    </div>
                                    <div class="new-arrival-content text-center mt-3">
                                        <h4><a href="{{ route('show.package', ['id' => $price->id]) }}">{{ $price->price_name }}</a></h4>
                                        <span class="price">${{ $price->price }}</span>
                                        <p>{{ $price->price_description }}</p>
                                        <div class="mt-3">
                                            <a href="{{ route('show.package', ['id' => $price->id]) }}" class="btn btn-xs btn-primary rounded-pill px-3">View</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                @endforeach
            </div>
        </div>
        @endforeach
    </div>



</div>


<!-- ====================MODAL  PACKAGE View================================ -->
<!-- <div class="modal fade show" id="packageModalLong" style="display: display; padding-right: 17px;" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="package-title" id="package-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <div id="modal-body-content">
                    Package content will be appended here -->
<!-- </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> -->

<!-- ===============MODAL END===================== -->

<!-- ===============MODAL PACKAGES================== -->
<!-- <div class="modal fade" id="modalAddPack" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddCatMenu">Add Package</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="package">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">On what category:</label>
                        <select name="category-select" class="form-control" id="category-select">
                            @foreach($byCategory as $option)
                            <option value="{{ $option->id }}">{{ $option->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Price:</label>
                        <input type="number" class="form-control" id="pack_price" name="pack_price">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Name:</label>
                        <input type="text" class="form-control" id="price_name" name="price_name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description:</label>
                        <input type="text" class="form-control" id="price_description" name="price_description">
                    </div>
                    <label class="form-label">Add Another Variant:</label>
                    <button type="button" class="badge badge-square badge-outline-primary" id="add-variant">+</button>
                    <button type="button" class="badge badge-square badge-outline-primary" id="remove-variant">-</button>
                    <hr>
                    <div id="variant-container">
                        <div id="menu-container" class="mb-3">
                            <div class="mb-3">
                                <label class="form-label">variant:</label>
                                <input type="text" class="form-control" id="variant" name="variant">
                            </div>
                            <label class="form-label">Menu:</label>
                            <button type="button" class="badge badge-square badge-outline-primary" id="add-menu">+</button>
                            <button type="button" class="badge badge-square badge-outline-primary" id="remove-menu">-</button>
                            <input type="text" class="form-control menu" name="menus[]">
                        </div>
                    </div>
                    <hr>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="savePackage" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div> -->

<!-- =================MODAL PACKAGES END=================== -->


@endsection


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<!-- Add these lines to include jQuery and Axios -->
<script src="{{asset('../assets/jquery/jquery.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<!-- Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


<script>
    $(document).ready(function() {
        // Show all items initially
        $('.tab-pane .card').show();

        // Handle tab click event
        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
            // Get the target tab pane id
            var targetPaneId = $(e.target).attr('href');

            // Hide all items except the ones in the shown tab
            $('.tab-pane:not(' + targetPaneId + ') .card').hide();

            // Show items in the active tab 
            $(targetPaneId + ' .card').show();
        });

        // Trigger a click event on the first tab (index 0)
        $('.nav-link').eq(0).click();
    });


    $(document).ready(function() {
        // Set CSRF token for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '#show-package', function() {
            var priceId = $(this).data('price-id');
            $.get('/package/' + priceId, function(data) {
                // Populate the modal with package data
                $('#package-title').text(data.price_name);
                var price = data[0].price;

                // Group packages by variant
                var groupedPackages = groupBy(data, 'variant');
                var modalBodyHtml = '';

                // Display the price above the grouped packages' titles
                modalBodyHtml += '<h3>Price: $' + price + '</h3>'; // Price display

                // Loop through the grouped packages and create content for each variant
                Object.keys(groupedPackages).forEach(function(variant) {
                    modalBodyHtml += '<h4>' + variant + '</h4>'; // Variant title
                    groupedPackages[variant].forEach(function(menuItem) {
                        var menuText = menuItem.menu;
                        var menuId = menuItem.id;
                        modalBodyHtml += '<div class="package-content" data-variant="' + variant + '" data-menu-id="' + menuId + '" style="margin-bottom: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">';
                        modalBodyHtml += '<span class="menu-text">' + menuText + '</span>';
                        modalBodyHtml += '<span class="edit-icon" style="margin-left: 10px; cursor: pointer;"><i class="fas fa-edit" style="color: #007bff;"></i></span>';
                        modalBodyHtml += '<span class="delete-icon" style="margin-left: 10px; cursor: pointer;"><i class="fas fa-trash-alt" style="color: #dc3545;"></i></span>';
                        modalBodyHtml += '</div>';
                    });
                });

                // Populate modal content
                $('#modal-body-content').html(modalBodyHtml);

                $('body').on('click', '.edit-icon', function() {
                    var menuTextElement = $(this).siblings('.menu-text');
                    var originalText = menuTextElement.text();
                    var inputField = '<input type="text" class="edit-menu-input form-control" value="' + originalText + '">';
                    menuTextElement.replaceWith(inputField);
                    var editInput = $(this).siblings('.edit-menu-input');
                    editInput.focus();

                    editInput.keydown(function(event) {
                        if (event.keyCode === 13) { // 13 is the key code for "Enter"
                            var editedText = $(this).val();
                            var originalText = menuTextElement.data('original-text');
                            var menuId = $(this).closest('.package-content').data('menu-id');

                            if (editedText.trim() === '') {
                                Swal.fire('Error!', 'Menu item cannot be empty.', 'error');
                                return;
                            }
                            if (editedText !== originalText) {

                                $.ajax({
                                    url: '/package/update/' + menuId,
                                    type: 'PUT',
                                    data: {
                                        menu: editedText
                                    },
                                    success: function(response) {
                                        console.log('Menu item updated successfully:', response);
                                        // Handle success response if necessary
                                        menuTextElement.text(editedText); // Update displayed text
                                        editInput.replaceWith(menuTextElement); // Replace input field with text
                                    },
                                    error: function(error) {
                                        console.error('Error updating menu item:', error);
                                        // Handle error response if necessary
                                        Swal.fire('Error!', 'Failed to update menu item. Please try again.', 'error');
                                    }
                                });

                            }
                            $('body').on('blur', '.edit-menu-input', function() {
                                // Previous edit logic remains unchanged
                            });
                        };
                    });

                });


                // Save changes when the user finishes editing

                // Delete menu item when the delete icon is clicked
                $('body').on('click', '.delete-icon', function() {
                    var menuId = $(this).closest('.package-content').data('menu-id');
                    var variant = $(this).closest('.package-content').data('variant');
                    var deletedItem = $(this).closest('.package-content');

                    // Send a DELETE request to the server using AJAX
                    $.ajax({
                        url: '/package/delete/' + menuId,
                        type: 'DELETE',
                        success: function(response) {
                            console.log('Menu item deleted successfully:', response);
                            // Handle success response if necessary
                            Swal.fire('Success!', 'Menu item deleted successfully.', 'success');

                            // Remove the deleted menu item from the modal
                            deletedItem.remove();

                            // Check if the variant is empty after deleting a menu item
                            var variantContainers = $('.package-content[data-variant="' + variant + '"]');
                            if (variantContainers.length === 0) {
                                // Variant is empty, remove the variant title as well
                                $('h4:contains(' + variant + ')').remove();

                                // Send a DELETE request to delete the empty variant
                                $.ajax({
                                    url: '/package/delete-variant/' + variant,
                                    type: 'DELETE',
                                    success: function(response) {
                                        console.log('Variant deleted successfully:', response);
                                        // Handle success response if necessary
                                    },
                                    error: function(error) {
                                        console.error('Error deleting variant:', error);
                                        // Handle error response if necessary
                                        Swal.fire('Error!', 'Failed to delete variant. Please try again.', 'error');
                                    }
                                });
                            }

                            // Check if there are no more items in the modal, then close it
                            if ($('#modal-body-content').children().length === 0) {
                                $('#packageModalLong').modal('hide');
                            }
                        },
                        error: function(error) {
                            console.error('Error deleting menu item:', error);
                            // Handle error response if necessary
                            Swal.fire('Error!', 'Failed to delete menu item. Please try again.', 'error');
                        }
                    });
                });

                // Show the modal with the populated content
                $('#packageModalLong').modal('show');
            });

            // Helper function to group data by a specific key
            function groupBy(data, key) {
                return data.reduce(function(acc, item) {
                    var groupKey = item[key];
                    acc[groupKey] = acc[groupKey] || [];
                    acc[groupKey].push(item);
                    return acc;
                }, {});
            }
        });
    });




















    // $(document).ready(function() {
    //     $('#cat_save').click(function() {
    //         var catData = $('#category-form').serialize();

    //         $.ajax({
    //             type: 'POST',
    //             url: '/saveCat',
    //             data: catData,
    //             success: function(response) {
    //                 Swal.fire(
    //                     'Good job!',
    //                     'You Successfully added the' + response.message + ' a category!',
    //                     'success'
    //                 );

    //                 $('#modalAddCat').modal('hide');
    //             },
    //             error: function() {
    //                 Swal.fire(
    //                     'Error!',
    //                     'Something went wrong',
    //                     'error'
    //                 );
    //             }
    //         });
    //     });
    // });


    $(document).ready(function() {
        axios.get('/get-categories')
            .then(function(response) {
                var responseData = response.data.categories;

                responseData.forEach(function(item) {

                    $('#category-select').append($('<option>', {
                        value: item.id,
                        text: item.name
                    }));

                });

                $('#category-select').prepend($('<option>', {
                    value: '',
                    text: 'Select Category'
                }));
            })
            .catch(function(error) {
                console.error(error);
            });
    });




    $(document).ready(function() {
        var y = 0;
        var i = 0;
        $('#add-variant').click(function() {
            y++;
            $('#variant-container').append(`
            <div class="mb-3">
                            <label class="form-label">variant:</label>  
                            <input type="text" class="form-control" id="variant" name="variant">
                        </div>
                        <div id="menu-container" class="mb-3">
                            <label class="form-label">Menu:</label>
                            <button type="button" class="badge badge-square badge-outline-primary" id="add-menu">+</button>
                            <button type="button" class="badge badge-square badge-outline-primary" id="remove-menu">-</button>
                            <input type="text" class="form-control menu" name="menus[]">
                </div>
            `);

            console.log('#variant-container')

            $('#add-menu').click(function() {
                i++;
                $('#menu-container').append(`
                    <input type="text" class="form-control menu" name="menus[]">
            `);
            });
        });


        $('#remove-menu').click(function() {
            // Check if there is more than one input field before removing
            var inputFields = $('#menu-container input.menu');
            if (inputFields.length > 1) {
                inputFields.last().remove();
            }
        });

    });


    $(document).ready(function() {
        $('#savePackage').one('click', function(event) {
            event.preventDefault();

            var catData = $('#package').serialize();

            $.ajax({
                    type: 'POST',
                    url: '/savePackage',
                    data: catData
                })
                .done(function(response) {
                    if (response && response.results && Array.isArray(response.results)) {
                        Swal.fire(
                            'Good job!',
                            'You successfully added a package',
                            'success'
                        );
                        console.log(response.results);
                        $('#modalAddPack').modal('hide');

                        // Update the DOM with the saved package items
                        var packageItems = response.results;
                        var packageList = $('#packageList'); // Assuming you have an element with id 'packageList' to display the package items

                        // Clear existing items in the list
                        packageList.empty();

                        // Append the saved package items to the list
                        packageItems.forEach(function(item) {
                            var listItem = $('<li>').text(item.menu); // Adjust this based on the actual structure of your package items
                            packageList.append(listItem);
                        });
                    } else {
                        Swal.fire(
                            'Error!',
                            'Invalid response format from the server',
                            'error'
                        );
                    }
                })
                .fail(function() {
                    Swal.fire(
                        'Error!',
                        'Something went wrong',
                        'error'
                    );
                });
        });
    });
</script>