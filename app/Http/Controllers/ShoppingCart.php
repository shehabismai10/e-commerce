<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShoppingCart extends Controller
{
    //

    public function index(){
        $products=Product::all();
        return view('products.cart-count',compact('products'));
    }

    public function ProductCart(){
        return view('products.shopping-cart');
    }


    public function addProductToCart(Request $request){


        $Product_id=$request->input('id');
        $quantity=$request->input('quantity',1);
        $quantity=$request->input('quantity',1);


        $products=product::findOrFail($Product_id);

        if (!$products) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        //declare $cart array
        $cart = session()->get('cart', []);


        if(isset($cart[$Product_id])){
            //if the id already in the cart we gonna add to the quantity +1

            $cart[$Product_id]['quantity'] +=$quantity; // Increment the quantity of the product with the given ID by the specified amount


        }else{
            //if the id is not there we will add new product to cart

            $cart[$Product_id]=[
                'id'=>$products->id,
                'name'=>$products->name,
                'quantity'=>$quantity, //dont get quantity from database use the previous quantity
                'price'=>$products->price,
                'image'=>$products->image??''


            ];
        }

        //initialize $cart array and get it FROM THE session
        session()->put('cart', $cart);



        // Calculate the total quantity

        $totalQuantity = 0;
        foreach ($cart as $item) {
            $totalQuantity += $item['quantity'];
        }
        return response()->json(['message' => 'Cart updated', 'cartCount' => $totalQuantity], 200);





    }

public function deleteItem(Request $request){
    if($request->id) {
        $cart = session()->get('cart');
        if(isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
        }
        session()->flash('success', 'Movie successfully deleted.');
}






    }
}