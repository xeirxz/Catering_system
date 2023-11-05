<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Packages;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Price;

class BookingController extends Controller
{
    public function index()
    {
        $bookCustomer = Booking::select('*')
            ->where('status', '=', 2)
            ->with([
                'users' => function ($q) {
                    $q->select('*');
                }
            ])
            ->with([
                'price' => function ($q) {
                    $q->select('*');
                }
            ])
            ->get();

        foreach ($bookCustomer as $booking) {
            $packageIds = json_decode($booking->package_id); // Decode JSON array to get package IDs
            $packageNames = Packages::whereIn('id', $packageIds)->pluck('menu')->toArray(); // Retrieve package names based on IDs
            $booking->package_names = implode(', ', $packageNames); // Store package names as a comma-separated string in the booking object
        }

        // Define $booking here or loop through $bookCustomer to find the specific booking you want to use
        // Example:
        // $booking = $bookCustomer->first(); // Assuming you want to use the first booking in your view

        return view('admin.book.booking', compact('bookCustomer', 'booking'));
    }

    public function approvedBook()
    {

        $bookCustomer = Booking::select('*')
            ->where('status', '=', '2')
            ->with([
                'users' => function ($q) {
                    $q->select('*');
                }
            ])
            ->with([
                'price' => function ($q) {
                    $q->select('*');
                }
            ])
            ->get();

        return view('admin.book.approved', compact('bookCustomer'));
    }

    public function updateBook(Request $request)
    {
        $data = Booking::findOrFail($request->input('book_id'));
        $data->status = $request->input('approve');

        // dd($request->input('approve'));

        $data->save();
        return redirect()->back();
    }

    public function incomingPackages()
    {

        $bookCustomer = Booking::select('*')
            ->where('status', '=', '3')
            ->with([
                'users' => function ($q) {
                    $q->select('*');
                }
            ])
            ->with([
                'price' => function ($q) {
                    $q->select('*');
                }
            ])

            ->get();

        return view('admin.book.incoming', compact('bookCustomer'));
    }

    public function cancelledBook()
    {

        $bookCustomer = Booking::select('*')
            ->where('status', '=', 'canceled')
            ->with([
                'users' => function ($q) {
                    $q->select('*');
                }
            ])
            ->with([
                'price' => function ($q) {
                    $q->select('*');
                }
            ])
            ->get();

        return view('admin.book.cancelled', compact('bookCustomer'));
    }

    public function customerList()
    {
        $users = User::where('role', '=', 'customer')->get();
        return view('admin.customers.customers', compact('users'));
    }


    public function show4($id)
    {
        $data = Booking::findOrFail($id);
        return response()->json($data);
    }


    public function show5($id)
    {
        $data = Booking::where('id', '=', $id)
            ->with([
                'users' => function ($q) {
                    $q->select('*');
                }
            ])
            ->with([
                'price' => function ($q) {
                    $q->select('*');
                }
            ])
            ->get();



        return response()->json($data);
    }
    public function Bookstore(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'price_id' => 'required|exists:prices,id',
            'date' => 'required|date',
            'time' => 'required',
            'payment_method' => 'required|in:Gcash,Cash on Deliver',
            'payment_type' => 'required|in:Full Payment,Down Payment',
            'number_of_packs' => 'required|integer|min:1', // Validate number of packs
            'menu_items' => 'required|array', // Assuming 'menu_items' is an array of selected menu items
            'menu_items.*' => 'exists:packages,id', // Validate each package ID
            // Add other validation rules as needed for your form fields
        ]);

        // Calculate total quantity based on the number of packs and menu items
        // Calculate total quantity based on the number of packs and menu items
        $quantity = $validatedData['number_of_packs'] * count($validatedData['menu_items']);

        // Fetch the price of a single pack based on the price_id
        $packPrice = Price::where('id', $validatedData['price_id'])->value('price');

        // Calculate the total price based on the quantity of packs and menu items
        $totalPrice = $packPrice * $validatedData['number_of_packs'];


        // Create a new booking instance with number_of_packs and total price
        $booking = new Booking();
        $booking->user_id = $validatedData['user_id'];
        $booking->price_id = $validatedData['price_id'];
        $booking->package_id = json_encode($validatedData['menu_items']);
        $booking->number_of_packs = $validatedData['number_of_packs']; // Store the number of packs
        $booking->total_price = $totalPrice; // Store the total price as integer
        $booking->date = $validatedData['date'];
        $booking->time = $validatedData['time'];
        $booking->payment_method = $validatedData['payment_method']; // Set the payment method
        $booking->payment_type = $validatedData['payment_type']; // Set the payment method
        $booking->status = '1'; // Assuming '1' represents a certain status, adjust accordingly
        $booking->save();

        // Load the associated package information
        $packages = Packages::whereIn('id', $request->input('menu_items'))->get();

        // Pass booking and package data to the customer_invoice view
        return view('customer.transactions.customer_invoice', ['booking' => $booking, 'packages' => $packages]);
    }

    public function showPaymentPage(Request $request)
    {
        // Retrieve the booking ID from the request
        $bookingId = $request->input('booking');

        // Use the booking ID to fetch the booking data from the database
        $booking = Booking::find($bookingId);

        // Check if the booking exists
        if (!$booking) {
            // Handle the case where the booking does not exist, e.g., redirect to an error page
            return redirect()->route('error')->with('error', 'Invalid booking ID');
        }

        // Fetch additional data if needed, e.g., payment methods, user details, etc.

        // Pass the booking data to the payment page view
        return view('customer.transactions.customer_payment', ['booking' => $booking]);
    }

    public function submitPayment(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'payment_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming max size is 2MB
        ]);

        // Get the booking ID from the request
        $bookingId = $request->input('booking_id');

        // Find the booking record in the database
        $booking = Booking::find($bookingId);

        // Check if the booking exists
        if (!$booking) {
            return redirect()->route('error')->with('error', 'Invalid booking ID');
        }

        // Handle the uploaded image
        if ($request->hasFile('payment_image')) {
            $image = $request->file('payment_image');
            // Generate a unique file name based on the current timestamp
              $imageName = time() . '_' . $image->getClientOriginalName();
            // Move the uploaded file to the desired destination (upload/payment_images folder)
            $image->move(public_path('upload/payment_images'), $imageName);

            // Update the booking record with the image path and status
            $booking->image = 'upload/payment_images/' . $imageName; // Update the 'image' column with the correct path
            $booking->status = 2; // Assuming '2' represents a paid status, adjust accordingly
            $booking->save();

            // Redirect to the waiting page with a success message
            return redirect()->route('waitingPage', ['id' => $bookingId])->with('success', 'Payment submitted successfully.');
        } else {
            // Handle the case when no image is uploaded
            return redirect()->route('error')->with('error', 'No image uploaded');
        }
    }
}
