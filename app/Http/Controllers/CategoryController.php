<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Price;
use App\Models\Packages;
use App\Models\Variants;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        // $packages = DB::table('packages')
        // ->join('categories','packages.category_id', '=' ,'categories.id')
        // ->join('prices','packages.price_id','prices.id')
        // ->join('menu_lines','packages.line_id','menu_lines.id')
        // ->select('categories.name','prices.price','packages.menu','menu_lines.menu_line')
        // ->get();

        // return view('admin.category.index_category',compact('packages'));


        $byCategory = DB::table('categories')
            ->select('id', 'name')
            ->get();

        $byPrice = DB::table('prices')
            ->select('id', 'price', 'price_name', 'price_description', 'category_id')
            ->get();


        $dataPack = DB::table('packages')
            ->select('packages.id', 'packages.menu', 'packages.price_id')
            ->groupBy('packages.id')
            ->get();

        return view('admin.category.index_category', compact('byCategory', 'byPrice', 'dataPack'));
    }

    //     $byCategory = DB::table('categories')
    //     ->select('categories.id', 'categories.name')
    //     ->get();

    //     $byPrice = DB::table('prices')
    //     ->join('categories','categories.id','=','prices.category_id')
    //     ->select('prices.id', 'prices.price', 'prices.category_id')
    //     ->get();

    //     $dataPack = DB::table('packages')
    //     ->select('packages.menu','packages.line', 'packages.price_id')
    //     ->get();


    //     $lines = DB::table('packages')
    //     ->select('line')
    //     ->get()->groupBy('line');

    //     return view('admin.category.index_category',compact('byCategory', 'byPrice', 'dataPack'));
    // }

    public function storePrice(Request $request)

    {

        $data = new Price;

        $data->category_id = $request->input('category-select');
        $data->price =  $request->input('pack_price');
        $data->price_description = 'Hello WOrld';
        $data->save();

        return response()->json([
            'success' => true,
            // 'data'  => $data,
        ]);
    }

    public function sample()
    {

        $response = DB::table('packages')
            ->select(
                'packages.menu',
                'packages.line',
                'prices.price',
                'categories.name as category_name'
            )
            ->join('prices', 'packages.price_id', '=', 'prices.id')
            ->join('categories', 'prices.category_id', '=', 'categories.id')
            ->get();

        dd($response);
        // return response()->json($response);


    }



    public function savePackage(Request $request)
    {

        // tinood 
        // dd($request->all());
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'price_name' => 'required|string',
            'price_description' => 'nullable|string',
            'variants.*' => 'required|exists:variants,id',
            'menus.*' => 'required|string',
            'options.*' => 'required|string',
            'menu_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::beginTransaction();

        $price = new Price();
        $price->category_id = $request->input('category_id');
        $price->price = $request->input('price');
        $price->price_name = $request->input('price_name');
        $price->price_description = $request->input('price_description');
        $price->save();

        $variants = $request->input('variants');
        $options = $request->input('options');
        $menus = $request->input('menus');
        $menuImages = $request->file('menu_images');

        $formattedData = [];

        foreach ($variants as $key => $variantId) {
            $menu = $menus[$key];
            $option = $options[$key];
            $menuImage = $menuImages[$key] ?? null;

            if ($menuImage) {
                $originalFilename = $menuImage->getClientOriginalName();
                $filename = Str::random(20) . '_' . $originalFilename;
                $menuImage->move(public_path('upload/admin_images'), $filename);
            } else {
                $filename = null;
            }

            $formattedData[] = [
                'variant_id' => $variantId,
                'menu' => $menu,
                'max_options' => $option,
                'menu_image' => $filename,
            ];
        }

        // Now $formattedData contains the organized data
        // You can loop through $formattedData and save it accordin gly

        foreach ($formattedData as $data) {
            $package = new Packages();
            $package->price_id = $price->id;
            $package->variant_id = $data['variant_id'];
            $package->menu = $data['menu'];
            $package->max_options = $data['max_options'];
            $package->menu_image = $data['menu_image'];
            $package->save();
        }

        DB::commit();

        $notification = array(
            'message' => 'Failed to add packages. Please try again later.',
            'alert-type' => 'error',
        );
        return redirect()->route('category.index')->with($notification);
    }



    public function showPackage($id)
    {
        $packages = Packages::where('price_id', $id)
            ->select('packages.*', 'prices.id as price_id', 'prices.price', 'prices.price_name', 'prices.price_description', 'variants.variant_name', 'packages.max_options')
            ->join('prices', 'prices.id', '=', 'packages.price_id')
            ->join('variants', 'variants.id', '=', 'packages.variant_id') // Join with the 'variants' table
            ->get();

        // You should create an array to store the grouped packages
        $groupedPackages = [];

        foreach ($packages as $package) {
            // Assuming you have a 'variant_name' field in the 'variants' table
            $variant = $package->variant_name;

            if (!isset($groupedPackages[$variant])) {
                $groupedPackages[$variant] = [];
            }

            $groupedPackages[$variant][] = $package;
        }

        // dd($groupedPackages);
        return view('admin.category.view_cat', compact('packages', 'groupedPackages'));
    }



    public function update(Request $request, $id)
    {

        $menu = $request->input('menu');

        // Find the package by its price ID
        $package = Packages::find($id);

        if (!$package) {
            return response()->json(['message' => 'Package not found.'], 404);
        }

        // Update the menu field
        $package->menu = $menu;
        $package->save();
        return response()->json(['message' => 'Menu item updated successfully.']);
    }


    public function destroy($id)
    {
        // Find the package item by ID
        $package = Packages::find($id);

        // Check if the package item exists
        if ($package) {
            // Delete the package item
            $package->delete();

            // Get the updated list of items
            $updatedPackages = Packages::all();

            // Return the updated list of items
            return response()->json(['message' => 'Package item deleted successfully', 'packages' => $updatedPackages]);
        } else {
            // Return an error response if the package item was not found
            return response()->json(['error' => 'Package item not found'], 404);
        }
    }


    public function deleteVariant($variant)
    {
        try {
            // Find and delete all menu items with the specified variant
            Packages::where('variant', $variant)->delete();

            return response()->json([], 204); // 204 No Content status (Success without content)
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete variant. ' . $e->getMessage()], 500);
        }
    }

    public function AddPackAge()
    {
        $byCategory = DB::table('categories')
            ->select('id', 'name')
            ->get();

        $byPrice = DB::table('prices')
            ->select('id', 'price', 'price_name', 'price_description', 'category_id')
            ->get();


        $dataPack = DB::table('packages')
            ->select('packages.id', 'packages.menu', 'packages.price_id')
            ->get();


        $variants = DB::table('variants')
            ->select('variant_name', 'id')
            ->get();



        return view('admin.category.add_cat', compact('byCategory', 'byPrice', 'dataPack', 'variants'));
    }
}
