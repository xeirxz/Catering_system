<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;
use App\Models\User;
use App\Models\Category;
use App\Models\Price;
use App\Models\Packages;

class CustomerController extends Controller
{
    public function CustomerDashboard()
    {
        return view('customer.index');
    }

    public function invoice()
    {
        return view('customer.transaction.customer_invoice');
    }

    public function CustomerLogOut(Request $request)
    {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function CustomerProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('customer.customer_profile', compact('profileData'));
    }

    public function customerBooking()
    {



        $byCategory = DB::table('categories')
            ->select('id', 'name')
            ->get();

        $byPrice = DB::table('prices')
            ->select('id', 'price', 'price_name', 'price_description', 'category_id')
            ->get();


        $dataPack = DB::table('packages')
            ->select('id', 'menu', 'variant', 'price_id')
            ->groupBy('variant', 'id') // Include price_id in the GROUP BY clause
            ->get();



        return view('customer.orders.customer_book', compact('byCategory', 'byPrice', 'dataPack'));
    }

    // $categories = Category::with('prices.packages')->get();
    // $prices = Price::all();

    // return view('customer.orders.customer_book', compact('categories', 'prices')

    public function OrderSave(Request $request)
    {

        $pack = $request->all();

        $radioLineValues = [];
        foreach ($pack as $key => $value) {
            if (strpos($key, 'radioLine_') === 0) {
                $radioLineValues[] = $value;
            }
        }

        $book = new Booking();

        $book->user_id = $request->input('customer_id');
        $book->price_id = $request->input('price_id');
        $book->package_id = json_encode($radioLineValues);
        $book->date = $request->input('date');
        $book->time = $request->input('time');
        $book->status = '1';

        $book->save();

        return redirect()->back();
    }

    public function transactions()
    {
        $user = auth()->user()->id;
        $booking = Booking::where('status', '=', '1')
            ->where('user_id', '=', $user)
            ->get();


        $approved = Booking::where('status', '=', '2')
            ->where('user_id', '=', $user)
            ->get();


        $incoming = Booking::where('status', '=', '3')
            ->where('user_id', '=', $user)
            ->get();

        $history = Booking::where('status', '=', '5')
            ->where('user_id', '=', $user)
            ->get();

        $cancel = Booking::where('status', '=', '4')
            ->where('user_id', '=', $user)
            ->get();

        return view('customer.transactions.customer_transac', compact('booking', 'approved', 'incoming', 'history', 'cancel'));
    }

    public function bookCancelUpdate(Request $request)
    {
        $data = Booking::findOrFail($request->input('book_id'));

        $data->status = $request->input('canc');
        $data->save();

        return redirect()->back();
    }

    public function testPosted(Request $request)
    {

        $pack = $request->all();

        $radioLineValues = [];
        foreach ($pack as $key => $value) {
            if (strpos($key, 'radioLine_') === 0) {
                $radioLineValues[] = $value;
            }
        }

        $book = new Booking();

        $book->user_id = $request->input('customer_id');
        $book->price_id = $request->input('price_id');
        $book->package_id = json_encode($radioLineValues);
        $book->date = $request->input('date');
        $book->time = $request->input('time');
        $book->status = '1';

        $book->save();

        return redirect()->back();
    }

    public function bookCancelView($id)
    {
        $pack = Booking::findOrFail($id);
        return response()->json($pack);
    }


    public function showPackageCustomer($id)
    {
        // Assuming you retrieve user_id and price_id based on your application logic
        $user_id = auth()->user()->id; // Example way to get user ID, adjust as per your authentication logic
        $price_id = $id;

        // Assuming you have logic to determine $selected_packages based on user input or other criteria
        $selected_packages = []; // Define or retrieve the selected packages here

        $packages = Packages::where('price_id', $id)
            ->select('packages.*', 'prices.id as price_id', 'prices.price', 'prices.price_name', 'prices.price_description', 'packages.variant_description')
            ->join('prices', 'prices.id', '=', 'packages.price_id')
            ->get();

        // You should create an array to store the grouped packages
        $groupedPackages = [];

        foreach ($packages as $package) {
            // Assuming you have a 'variant' field in the $package object
            $variant = $package->variant;

            if (!isset($groupedPackages[$variant])) {
                $groupedPackages[$variant] = [];
            }

            $groupedPackages[$variant][] = $package;
        }

        return view('customer.orders.customer_bookSelection', compact('user_id', 'price_id', 'selected_packages', 'packages', 'groupedPackages'));
    }

    public function showWaitingPage($id)
    {
        // Find the booking by its ID
        $booking = Booking::find($id);

        // Check if the booking exists
        if (!$booking) {
            return redirect()->route('error')->with('error', 'Invalid booking ID');
        }

        // Load associated package information
        $packages = Packages::whereIn('id', json_decode($booking->package_id))->get();

        // Pass the booking and package data to the waiting page view
        return view('customer.transactions.customer_status', compact('booking', 'packages'));
    }

    public function cancelBooking($booking_id)
    {
        // Find the booking record in the database
        $booking = Booking::find($booking_id);

        // Check if the booking exists
        if (!$booking) {
            return redirect()->route('error')->with('error', 'Invalid booking ID');
        }

        // Handle cancellation logic here
        // For example, update the booking status to canceled
        $booking->status = 'canceled';
        $booking->save();

        // Redirect to a confirmation page or any other appropriate page
        return redirect()->route('customer.book')->with('success', 'Booking canceled successfully.');
    }
}
