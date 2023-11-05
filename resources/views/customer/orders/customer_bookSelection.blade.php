@extends('admin.dashboard')
@section('admin')

<style>
    .package-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
    }

    .row {
        display: flex;
        align-items: flex-start;
        width: 100%;
    }

    .package-details {
        margin-right: 20px;
    }

    .variant-container {
        margin-bottom: 20px;
    }

    .package-content {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .picture-frame {
        width: 50px;
        height: 50px;
        margin-right: 10px;
    }

    .form-details {
        width: 100%;
    }

    .input-group {
        margin-bottom: 15px;
    }

    .vertical-line {
        width: 1px;
        height: 100px;
        background-color: #ccc;
        margin: 20px 0;
    }

    .submit-button {
        margin-top: 20px;
    }

    .back-button {
        margin-top: 20px;
    }
</style>

<form action="{{ route('bookStore') }}" method="post">
    @csrf

    <!-- User ID and Price ID (Assuming you have inputs for these) -->
    <input type="hidden" name="user_id" value="{{ $user_id }}">
    <input type="hidden" name="price_id" value="{{ $price_id }}">

    <!-- Package IDs (Assuming you have inputs for package selection) -->
    @foreach($selected_packages as $packageId)
    <input type="hidden" name="menu_items[]" value="{{ $packageId }}">
    @endforeach

    <!-- Number of Packs Input -->
    <div class="form-group">
        <label for="number_of_packs">Number of Packs:</label>
        <input type="number" class="form-control" name="number_of_packs" required>
    </div>

    <!-- Render package options -->
    @foreach($groupedPackages as $variant => $items)
    <div class="variant-container mt-3">
        <h4>{{ $variant }}</h4>
        <p>{{ $items[0]->variant_description }}</p>
        @foreach($items as $menuItem)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="menu_items[]" value="{{ $menuItem->id }}" id="menu-{{ $menuItem->id }}">
            <label class="form-check-label" for="menu-{{ $menuItem->id }}">
                {{ $menuItem->menu }}
                <p class="description">{{ $menuItem->description }}</p>
            </label>
        </div>
        @endforeach
    </div>
    @endforeach

    <!-- Date Input -->
    <div class="form-group mt-3">
        <label for="date">Select Date:</label>
        <input type="date" name="date" class="form-control" required>
    </div>

    <!-- Time Input -->
    <div class="form-group">
        <label for="time">Select Time:</label>
        <input type="time" name="time" class="form-control" required>
    </div>

    <!-- Payment Method Selection -->
    <div class="form-group">
        <label for="payment_method">Payment Method:</label>
        <select class="form-control" name="payment_method" required>
            <option value="Gcash">Gcash</option>
            <option value="Cash on Deliver">Cash on Deliver</option>
        </select>
    </div>

    <!-- Payment Type Selection -->
    <div class="form-group">
        <label for="payment_type">Payment Type:</label>
        <select class="form-control" name="payment_type" required>
            <option value="Full Payment">Full Payment</option>
            <option value="Down Payment">Down Payment</option>
        </select>
    </div>

    <!-- Other form fields can be added here as needed -->

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<a href="{{ route('category.index') }}" class="back-button"><i class="fas fa-arrow-left"></i> Back</a>
</div>



@endsection