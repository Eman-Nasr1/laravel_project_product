<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;  
use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    //
    public function index(){
        $products=Product::get();
        return view('createproduct ', ['products' => $products]); 

    }

    public function create(Request $request){

        return view('products');


    }


//     public function store(Request $request)  
// {  
//     try {  
//         $validatedData = $request->validate([  
//             'title' => 'required|string|max:255|regex:/^[A-Za-z\s]+$/',  
//             'description' => 'required|string|max:255|regex:/^[A-Za-z\s]+$/',  
//             'amount' => 'required|numeric',  
//             'price' => 'required|numeric',  
//             'image' => 'required|image|mimes:png,jpg,jpeg|max:2048', 
//         ]);  
 
//         if ($request->hasFile('image')) {  
//             $image = $request->file('image');
//             $imageName = time() . '_' . $image->getClientOriginalName(); // Generate unique image name
//             $image->move(public_path('images'), $imageName); // Move the file to public/images
//             $validatedData['image'] = $imageName;
//         }  
    
//         DB::table('product')->insert($validatedData);  
//         return redirect()->route('products.create')->with('message', 'Product created successfully.'); 

//     } catch (\Exception $e) {  
//         dd($e->getMessage());  
//     }  
// }


public function store(Request $request)  
{  
    try {  
        $validatedData = $request->validate([  
            'title' => 'required|string|max:255|regex:/^[A-Za-z\s]+$/',  
            'description' => 'required|string|max:255|regex:/^[A-Za-z\s]+$/',  
            'amount' => 'required|numeric',  
            'price' => 'required|numeric',  
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048', 
        ]);  
 
        if ($request->hasFile('image')) {  
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName(); // Generate unique image name
            $image->move(public_path('images'), $imageName); // Move the file to public/images
            $validatedData['image'] = $imageName;
        }  
    
       Product::create($validatedData);  
        return redirect()->route('products.create')->with('message', 'Product created successfully.'); 

    } catch (\Exception $e) {  
        dd($e->getMessage());  
    }  
}


// public function edit($id)
// {
//     $product = DB::table('product')->find($id);

//     if (!$product) {
//         return redirect()->route('products.index')->with('error', 'Product not found.');
//     }

//     return view('editproduct', compact('product'));
// }

public function edit(Product $product)
{
   
    return view('editproduct', compact('product'));
}

  

public function update(Request $request, Product $product)
{
    try {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048', 
        ]);


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName); 

            $validatedData['image'] = $imageName;
        } else {
            $validatedData['image'] = $product->image;
        }

        $product->update($validatedData);

        return redirect()->route('products.index')->with('message', 'Product updated successfully.');

    } catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }
}


public function delete( Product $product)
{
    try {
   

        $product->delete();

        return redirect()->route('products.index')->with('message', 'Product deleted successfully.');
    } catch (\Exception $e) {
        return redirect()->route('products.index')->with('error', 'An error occurred while deleting the product: ' . $e->getMessage());
    }
}
}
