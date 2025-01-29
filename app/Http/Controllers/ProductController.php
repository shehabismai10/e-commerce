<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class productController extends Controller
{
    //show form to create new product 
    public function admincreate(){
        $products=product::all();
        $categories=category::all();

        return view('products.admin-create',  compact('products','categories'));
    }


    public function vendorcreate(){
        $products=product::all();
        $categories=category::all();

        return view('products.vendor-create',  compact('products','categories'));
    }



        //display all products
        public function adminindex(){
            $products=DB::table('products')->get();

               // Debugging: Log or dump the products
              // dd($products->toArray()); // This will dump the products and stop further execution

            

            return view('products.admin-index',compact('products'));
        }


        public function vendorindex(){
            $products=DB::table('products')->get();

               // Debugging: Log or dump the products
              // dd($products->toArray()); // This will dump the products and stop further execution

            

            return view('products.vendor-index',compact('products'));
        }



        public function userindex(){
            $products=DB::table('products')->get();

               // Debugging: Log or dump the products
              // dd($products->toArray()); // This will dump the products and stop further execution

            

            return view('products.user-index',compact('products'));
        }




    //store products into database
    public function vendorstore(Request $request){
        //validation
    
        $request->validate([
            'name'=>'required|string|max:255',
            'description'=>'nullable|string',
            'quantity' => 'required|integer|min:0',
            'sku' => 'required|string|max:100|unique:products,sku',
            'image'=>'nullable|image|max:2048',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
        ]);

          //save to Category table
        $products=product::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'quantity'=>$request->quantity,
            'sku'=>$request->sku,
            'image' => $request->file('image') ? $request->file('image')->store('products', 'public') : null,
            'category_id'=>$request->category_id,
            'price'=>$request->price,


            


        ]);
        //view all products
        return redirect()->route('products.vendor-index')->with('success','product created successfully');
    
        
        
    }


    public function adminstore(Request $request){
        //validation
    
        $request->validate([
            'name'=>'required|string|max:255',
            'description'=>'nullable|string',
            'quantity' => 'required|integer|min:0',
            'sku' => 'required|string|max:100|unique:products,sku',
            'image'=>'nullable|image|max:2048',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
        ]);

          //save to Category table
        $products=product::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'quantity'=>$request->quantity,
            'sku'=>$request->sku,
            'image' => $request->file('image') ? $request->file('image')->store('products', 'public') : null,
            'category_id'=>$request->category_id,
            'price'=>$request->price,


            


        ]);
        //view all products
        return redirect()->route('products.admin-index')->with('success','product created successfully');
    
        
        
    }


//view edit form
public function adminedit($id){
    $products=product::findOrFail($id);
    $categories =Category::all(); // Retrieve all categories
    

    return view('products.admin-edit',compact('products','categories'));
}


public function vendoredit($id){
    $products=product::findOrFail($id);
    $categories =Category::all(); // Retrieve all categories
    

    return view('products.vendor-edit',compact('products','categories'));
}

//update the exist data
public function adminupdate(Request $request,$id){

    //validation


    $request->validate([
        'name'=>'required|string|max:255',
        'description'=>'nullable|string',
        'quantity' => 'required|integer|min:0',
        'sku' => 'required|string|max:100|unique:products,sku',
        'image'=>'nullable|image|max:2048',
        'category_id' => 'required|exists:categories,id',
        'price' => 'required|numeric|min:0',
    ]);


    //update product
    $products=product::findOrFail($id);
    $products->name=$request->input('name');
    $products->description=$request->input('description');
    $products->quantity=$request->input('quantity');
    $products->sku=$request->input('sku');
    $products->category_id=$request->input('category_id');
    $products->price=$request->input('price');

    if($request->hasFile('image')){
        //delete old photo if exists
        if($products->image && storage::exists('public/'.$products->image)){
            storage::delete('public' .$products->image);
        }
        $products->image=$request->file('image')->store('products','public');
        
    }
    $products->save();

    return redirect()->route('products.admin-index')->with('success', 'product updated successfully!');





}


public function vendorupdate(Request $request,$id){

    //validation


    $request->validate([
        'name'=>'required|string|max:255',
        'description'=>'nullable|string',
        'quantity' => 'required|integer|min:0',
        'sku' => 'required|string|max:100|unique:products,sku',
        'image'=>'nullable|image|max:2048',
        'category_id' => 'required|exists:categories,id',
        'price' => 'required|numeric|min:0',
    ]);


    //update product
    $products=product::findOrFail($id);
    $products->name=$request->input('name');
    $products->description=$request->input('description');
    $products->quantity=$request->input('quantity');
    $products->sku=$request->input('sku');
    $products->category_id=$request->input('category_id');
    $products->price=$request->input('price');

    if($request->hasFile('image')){
        //delete old photo if exists
        if($products->image && storage::exists('public/'.$products->image)){
            storage::delete('public' .$products->image);
        }
        $products->image=$request->file('image')->store('products','public');
        
    }
    $products->save();

    return redirect()->route('products.vendor-index')->with('success', 'product updated successfully!');





}

public function admindelete($id){

    //find products using id
    $products=product::findOrFail($id);

    //delete the category
    $products->delete();

    //redirect
    return redirect()->route('products.admin-index')->with('success','product deleted successfully!');
}

public function vendordelete($id){

    //find products using id
    $products=product::findOrFail($id);

    //delete the category
    $products->delete();

    //redirect
    return redirect()->route('products.admin-index')->with('success','product deleted successfully!');
}

//CART

// 1.view cart
public function ProductCart(){
    $products=DB::table('products')->get();

    return view('products.cart',compact('products'));
    
}

//2.add Product To cart
public function addProductToCart(Request $request){
    $product_id=$request->input('product_id');
    $quantity = $request->input('quantity', 1);
    $cartItemId = $request->input('cart_item_id');

    $product=product::findOrFail($product_id);

    if(!$product){
        return response()->json(['error'=>'Product is not found'],404);
    }else{
        //Initialize or retrieve the cart array using session
        $cart = session()->get('cart', []);
        
        if(isset($cart[$product_id])){
             // Update quantity if product is already in the cart
            $cart[$product_id]['quantity'] += $quantity;
            



        }else{
            //if the product is not in the cart ADD IT
            $cart[$product_id]=[
                'id'=>$product->id,
                'name'=>$product->name,
                'price'=>$product->price,
                'image'=>$product->image,
                'quantity'=>$quantity


                

            ];
            session()->put('cart', $cart);


            //calculate the total 
            $totalQuantity=0;
            foreach($cart as $item){
                $totalQuantity+=$item['quantity'];
            }
            return response()->json(['message' => 'Cart updated', 'cartCount' => $totalQuantity], 200);
            


        }



    }



}


//delete item from cart
public function deleteItem(Request $request){
    if($request->id){
        $cart = session()->get('cart');
        if(isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
        }
        session()->flash('success', 'Product successfully deleted.');


    }
}
}

