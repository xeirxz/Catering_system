<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\User;
use App\Models\Category;
use App\Models\Packages;

class AdminController extends Controller
{
    public function AdminDashboard(){
        return view('admin.index');
    }

    public function AdminLogout(Request $request){

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function salesReport() {

        $sales_data = Booking::select('*')
        ->where('status', '=', '5')
        ->with([
            'users' => function ($q) {
                $q->select('*');
            }
        ])
        ->with([
            'price' => function($q) {
                $q->select('*');
            }
        ])
        ->get();


        return view('admin.reports.sales', compact('sales_data'));

    }

    public function ShowUsers()
    {
        $usersData = User::latest();
        $usersData = $usersData->paginate(5);
        return view('admin.users', compact('usersData'));
    }

    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_profile', compact('profileData'));
    }

    public function dataTables ()
    {

        $data = Category::select('*')
        ->with([
            'prices' => function($q) {
                $q->select('*');
            }
        ])->get();

        $packages = Packages::selectRaw('MAX(id) as id, menu')->groupBy('menu')->get();
        return view('admin.tables', compact('data', 'packages'));
    }

    
    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->name = $request->name;
        $data->lastname = $request->lastname;
        $data->address = $request->address;
        $data->phone = $request->phone;
        $data->email = $request->email;

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['image'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    
}
