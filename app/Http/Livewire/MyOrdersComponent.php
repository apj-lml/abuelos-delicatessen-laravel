<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CustomerOrders;
use Livewire\WithPagination;
use Auth;

class MyOrdersComponent extends Component
{

    use WithPagination;
    public $customerOrderParticulars;

    public function showViewOrderParticularsModal($invoiceNo)
    {
        // dd($invoiceNo);
        $this->customerOrderParticulars = CustomerOrders::with('product')->where('invoice_no', '=', $invoiceNo)->get();
        $myvar = CustomerOrders::with('product')->where('invoice_no', '=', $invoiceNo)->get();
        // foreach($myvar as $var){
        //     dd($var['product']);
            
        // }
    }
    public function fulfillOrder($invoiceNo)
    {
        $this->fulfillCustomerOrder = CustomerOrders::where('invoice_no', '=', $invoiceNo)->get();

        foreach($this->fulfillCustomerOrder as $fulfillOrder){
            $fulfillOrder->update([
                'order_status' => 'Fulfilled'
            ]);

            $product = Product::find($fulfillOrder['product_id']);
            $product->update([
                'product_qty' => $product['product_qty'] - $fulfillOrder['product_qty']
            ]);
        }

        $this->dispatchBrowserEvent('fireFulfillOrderToast');

    }

    public function cancelOrder($invoiceNo)
    {
        $this->dispatchBrowserEvent('firefulfillOrderToast');
        $this->fulfillCustomerOrder = CustomerOrders::where('invoice_no', '=', $invoiceNo)->get();

        foreach($this->fulfillCustomerOrder as $fulfillOrder){
            $fulfillOrder->update([
                'order_status' => 'Canceled'
            ]);
        }
        $this->dispatchBrowserEvent('fireCancelOrderToast');

    }

    public function render()
    {

        $myOrders = CustomerOrders::where('order_status', '=', 'Pending')->where('customer_id', '=', Auth::user()->id)->groupBy('invoice_no')->paginate(5);
        return view('livewire.my-orders-component', ['customerOrders'=>$myOrders]);

    }
}
