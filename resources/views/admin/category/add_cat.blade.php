@extends('admin.dashboard')
@section('admin')

<style>
    /* Add specific styles for the remove menu button */
    .remove-menu {
        background-color: #dc3545;
        /* Set the background color */
        border-color: #dc3545;
        /* Set the border color */
        color: #fff;
        /* Set the text color */
        /* Add any other styles you want */
    }

    .remove-menu:hover {
        background-color: #c82333;
        /* Change the background color on hover if desired */
        /* Add any other hover styles you want */
    }
</style>
<div class="container-fluid">
    <h1 class="mb-4">Add Package</h1>
    <form action="{{ route('save.Package') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="mb-3 col-md-6">
                <div class="form-group">
                    <label for="category-select" class="form-label">Select Category:</label>
                    <select name="category_id" class="form-select" id="category-select">
                        @foreach($byCategory as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3 col-md-6">
                <div class="form-group">
                    <label for="pack-price" class="form-label">Price:</label>
                    <div class="input-group">
                        <span class="input-group-text">₱</span>
                        <input type="number" class="form-control" id="price" name="price" placeholder="Enter price" required>
                    </div>
                </div>
            </div>

            <div class="mb-3 col-md-6">
                <div class="form-group">
                    <label for="price-name" class="form-label">Package Name:</label>
                    <input type="text" class="form-control" id="price_name" name="price_name" placeholder="Enter package name" required>
                </div>
            </div>

            <div class="mb-3 col-md-6">
                <div class="form-group">
                    <label for="price-description" class="form-label">Description:</label>
                    <textarea class="form-control" id="price_description" name="price_description" placeholder="Enter package description" required></textarea>
                </div>
            </div>
        </div>

        <table class="table primary-table-bordered">
            <thead class="thead-primary">
                <tr>
                    <th>Variant</th>
                    <th>Variant Options</th>
                    <th>Menu</th>
                    <th>Menu Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="variant-container">
                <tr class="menu-input variant-row-template">
                    <td>
                        <select name="variants[]" class="form-select variant-select" id="variant" aria-label="Default select example">
                            <option value="" selected disabled>Select a variant <span class=" caret"></span></option>
                            @foreach($variants as $variant)
                            <option value="{{ $variant->id }}">{{ $variant->variant_name }}</option>
                            @endforeach
                        </select>

                    </td>
                    <td class="options-column">
                        <input type="number" class="form-control" id="options" name="options[]" placeholder="Enter how many options" required>
                    </td>
                    <td class="menu-column">
                        <input type="text" class="form-control" name="menus[]" placeholder="Enter menu" required>
                    </td>

                    <td class="image-column">
                        <div class="d-flex align-items-center">
                            <img class="img-fluid me-2 menu-image-preview" style="width: 100px; height: 70px; object-fit: cover;" id="showImage" src="{{ url('upload/no_image.jpg') }}" alt="menu">
                            <input type="file" class="form-control" name="menu_images[]" accept="image/*">
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <button type="button" class="btn btn-primary btn-sm" id="addVariantButton">+ Add Variant</button>
    <button type="button" class="btn btn-primary btn-sm" id="add-menu">+ Add Menu</button>
</div>

<hr class="mt-3 mb-2">
<div class="d-flex justify-content-end">
    <button type="submit" class="btn btn-primary btn-custom" style="margin-right: 10px;">Save</button>
    <a href="{{ route('category.index') }}" class="btn btn-secondary btn-custom">Cancel</a>
</div>
</form>

@endsection
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<script src="{{asset('../assets/jquery/jquery.js')}}"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#menu_image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });


    $(document).ready(function() {
        var selectedCategoryValue = ''; // Variable to store the selected category value
        var numberOfOptions = $('#options').val();

        // Event listener for Category selection change
        $('.variant-select').change(function() {
            selectedCategoryValue = $(this).val();
            console.log('Selected Category: ' + selectedCategoryValue);
        });

        // Event listener for Add Variant button
        $('#addVariantButton').click(function() {
            console.log('Add Variant Button clicked');

            // Clone the template variant row without content
            var clonedVariantRow = $('.variant-row-template').first().clone();

            // Clear menu input and menu image input values in the cloned row
            clonedVariantRow.find('input[name="menus[]"]').val('');
            clonedVariantRow.find('input[name="menu_images[]"]').val('');
            clonedVariantRow.find('input[name="options[]"]').val('');

            // Set the default value as the value of the first option in the original variant select dropdown
            var firstOptionValue = $('.variant-select option:first').val();
            clonedVariantRow.find('select[name="variants[]"]').val(firstOptionValue);

            // Event listener for Variant selection change using event delegation
            clonedVariantRow.find('select[name="variants[]"]').on('change', function() {
                selectedCategoryValue = $(this).val();
                console.log('Selected Variant: ' + selectedCategoryValue);
            });

            // Append the modified row to the tbody
            $('.variant-container').append(clonedVariantRow);
        });


        var selectedCategoryValue = ''; // Variable to store the selected category value
        var numberOfOptions = '';

        $(document).on('change', '.variant-select', function() {
            selectedCategoryValue = $(this).val();
            console.log('Selected Variant: ' + selectedCategoryValue);
        });

        $(document).on('change', '#options', function() {
            numberOfOptions = $(this).val();
            console.log('Selected Variant: ' + numberOfOptions);
        });




        // Event listener for Add Menu button (cloned and original elements)
        $(document).on('click', '#add-menu', function() {
            // Get the selected variant value
            // var selectedVariantValue = $('.variant-select').val();

            // var numberOfOptions = $('#options').val();

            console.log('Add Menu Button clicked');

            // Clone the template menu row (only the first one if there are multiple)
            var clonedMenuRow = $('.menu-input.variant-row-template').first().clone();

            // Hide the variant selection in the cloned row
            clonedMenuRow.find('select[name="variants[]"]').css('display', 'none');
            clonedMenuRow.find('input[name="options[]"]').css('display', 'none');

            // Clear menu input and menu image input values in the cloned row
            clonedMenuRow.find('input[name="menus[]"]').val('');
            clonedMenuRow.find('input[name="menu_images[]"]').val('');

            // Set the variant value in the cloned row
            clonedMenuRow.find('select[name="variants[]"]').val(selectedCategoryValue);
            clonedMenuRow.find('input[name="options[]"]').val(numberOfOptions);
            // Append the modified row to the tbody
            $('.variant-container').append(clonedMenuRow);
        });


    });

















    // Handle file input change for dynamically added menu rows
    $(".variant-container").on("change", ".menu-image", function() {
        var reader = new FileReader();
        var previewImage = $(this).closest("tr").find(".menu-image-preview")[0];
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            $(previewImage).addClass("clickable"); // Add a class to make the image clickable
        };
        reader.readAsDataURL(this.files[0]);
    });

    // Remove row on button click (event delegation)
    $(".variant-container").on("click", ".remove-row", function() {
        $(this).closest("tr").remove(); // Remove the row
    });
</script>