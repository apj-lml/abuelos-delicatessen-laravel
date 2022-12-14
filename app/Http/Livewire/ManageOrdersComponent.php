<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CustomerOrders;
use App\Models\Product;
use Livewire\WithPagination;



class ManageOrdersComponent extends Component
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


            $product = Product::findOrFail($fulfillOrder['product_id']);

            // dd($fulfillOrder['order_qty']);

            $product->update([
                'product_qty' => $product['product_qty'] - $fulfillOrder['order_qty']
            ]);

            // $product->save();
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
        $customerOrders = CustomerOrders::where('order_status', '=', 'Pending')->groupBy('invoice_no')->paginate(5);
        return view('livewire.manage-orders-component', ['customerOrders'=>$customerOrders]);
    }
}
