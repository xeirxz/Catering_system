@extends('admin.dashboard')

@section('admin')

<style>
    .menu-items-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .menu-item-container {
        margin: 0 10px 20px;
        /* Add margins for spacing */
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Add shadow */
        background-color: #FFF;
        transition: transform 0.3s ease;
        /* Add transition effect */
    }


    .menu-image {
        margin-bottom: 10px;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Add shadow to the menu image */
    }

    .menu-title {
        font-size: 14px;
        margin-bottom: 5px;
    }

    .action-icons {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .edit-icon,
    .delete-icon {
        font-size: 18px;
        cursor: pointer;
        margin-right: 10px;
    }

    .edit-icon:hover,
    .delete-icon:hover {
        color: #FF8C00;
    }


    .center-text {
        text-align: center;
    }
</style>
<div class="container position-relative mt-5">
    <div class="row">
        <!-- Package Details -->
        <div class="col-md-3 mb-4">
            <div class="package-container p-4 rounded shadow-lg">
                <div class="package-header bg-orange text-white rounded-top text-center py-3">
                    {{ $packages->first()->price_name }}
                </div>
                <table class="table table-borderless mt-2">
                    <tbody>
                        <tr>
                            <th style="width: 30%; text-align: right;">Price:</th>
                            <td style="width: 70%; font-weight: bold; color: #FF5733;">${{ $packages->first()->price }}</td>
                        </tr>
                        <tr>
                            <th style="width: 30%; text-align: right;">Description:</th>
                            <td style="width: 70%; color: #FFA500;">{{ $packages->first()->price_description }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Variants and Menus -->
        <div class="col-md-8">
            <div class="row">
                @foreach($groupedPackages as $variant => $items)
                <div class="col-md-12 mb-4">
                    <div class="variant-container p-4 rounded shadow-lg">
                        <h4 class="variant-label text-center mb-3">{{ $variant }}</h4>
                        <p class="center-text">Max Options: {{ $items[0]->max_options }}</p>
                        <div class="menu-items-grid">
                            @foreach($items as $menuItem)
                            <div class="menu-item-container text-center mb-3" data-menu-id="{{ $menuItem->id }}">
                                <div class="menu-image mb-2">
                                    <img src="{{ asset('../upload/admin_images/' . $menuItem->menu_image) }}" alt="{{ $menuItem->menu }}" style="width: 130px; height: 130px; object-fit: cover; border-radius: 50%;">
                                </div>
                                <h6 class="menu-title text-orange font-weight-bold mb-2">{{ $menuItem->menu }}</h6>
                                <div class="action-icons">
                                    <span class="edit-icon" title="Edit" style="cursor: pointer;"><i class="far fa-edit"></i></span>
                                    <span class="delete-icon text-orange" title="Delete" style="cursor: pointer;"><i class="far fa-trash-alt"></i></span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

<script src="{{asset('../assets/jquery/jquery.js')}}"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<!-- Add these lines to include jQuery and Axios -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<!-- Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.edit-icon', function() {
            var menuText = $(this).closest('.menu-item-container').find('.menu-title').text();
            var menuId = $(this).closest('.menu-item-container').data('menu-id');
            var inputField = '<input type="text" class="edit-menu-input" data-menu-id="' + menuId + '" value="' + menuText + '">';
            $(this).closest('.menu-item-container').find('.menu-title').replaceWith(inputField);
            $(this).closest('.menu-item-container').find('.edit-menu-input').focus();
        });

        // Save changes when the user finishes editing
        $(document).on('blur', '.edit-menu-input', function() {
            var editedText = $(this).val();
            var menuId = $(this).data('menu-id');
            console.log('Edited Text:', editedText); // Check if editedText and menuId are correct
            console.log('Menu ID:', menuId);

            if (editedText.trim() === '') {
                Swal.fire(
                    'Error!',
                    'Menu item cannot be empty.',
                    'error'
                );
                return;
            }

            // Send the updated text and menu ID to the server using an AJAX request (PUT method)
            $.ajax({
                url: '/package/update/' + menuId,
                type: 'PUT',
                data: {
                    menu: editedText,
                },
                success: function(response) {
                    // Handle success response
                    console.log('Menu item updated successfully:', response);
                    Swal.fire(
                        'Success!',
                        'Menu item updated successfully.',
                        'success'
                    );
                },
                error: function(error) {
                    // Handle error response
                    console.error('Error updating menu item:', error);
                    Swal.fire(
                        'Error!',
                        'Failed to update menu item. Please try again.',
                        'error'
                    );
                }
            });

            // Replace the input field with the updated text
            $(this).replaceWith('<span class="menu-title">' + editedText + '</span>');
        });

        $('body').on('click', '.delete-icon', function() {
            var menuId = $(this).closest('.menu-item-container').data('menu-id');

            // Ask for confirmation before deleting the menu item
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send a DELETE request to the server using AJAX
                    $.ajax({
                        url: '/package/delete/' + menuId, // Use the correct URL based on your route configuration
                        type: 'DELETE',
                        success: function(response) {
                            console.log('Menu item deleted successfully:', response);

                            // Handle success response if necessary
                            Swal.fire(
                                'Deleted!',
                                'Menu item has been deleted.',
                                'success'
                            );

                            // Remove the deleted menu item from the modal
                            $(this).closest('.menu-item-container').remove();
                        },
                        error: function(error) {
                            console.error('Error deleting menu item:', error);

                            // Handle error response if necessary
                            Swal.fire(
                                'Error!',
                                'Failed to delete menu item. Please try again.',
                                'error'
                            );
                        }
                    });
                }
            });
        });


    });
</script>