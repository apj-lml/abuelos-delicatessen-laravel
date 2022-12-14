<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CustomerOrders;
use Auth;
// use Carbon\Carbon;

class CartController extends Controller
{
    public function cartList()
    {
        $cartItems = \Cart::getContent();
        // dd($cartItems);
        return view('cart', compact('cartItems'));
    }


    public function addToCart(Request $request)
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
            'image' => $request->image,
            )
        ]);
        session()->flash('success', 'Product is Added to Cart Successfully !');

        return redirect()->route('cart.list');
    }

    public function updateCart(Request $request)
    {
        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );

        session()->flash('success', 'Item Cart is Updated Successfully !');

        return redirect()->route('cart.list');
    }

    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        session()->flash('success', 'Item Cart Remove Successfully !');

        return redirect()->route('cart.list');
    }

    public function clearAllCart()
    {
        \Cart::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');

        return redirect()->route('cart.list');
    }

    public function checkout(Request $request)
    {
        $cartProduct = \Cart::getContent();

        $mytime = \Carbon::now();

        foreach ($cartProduct as $product){
            $create = CustomerOrders::create([
                'full_name' => $request->fullName,
                'customer_id' => Auth::user()->id,
                'product_id' => $product->id,
                'shipping_address' => $request->address2,
                'order_qty' => $product->quantity,
                'amount' => $product->price,
                'invoice_no' => $request->invoiceNo,
                'order_date' => $mytime->toDateTimeString(),
            ]);

            \Cart::clear();
        }

        return redirect()->route('cart.list');
    }
}
