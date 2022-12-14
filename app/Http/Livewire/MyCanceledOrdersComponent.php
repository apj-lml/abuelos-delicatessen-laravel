<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CustomerOrders;
use Livewire\WithPagination;
use Auth;
class MyCanceledOrdersComponent extends Component
{
    use WithPagination;
    public $customerOrderParticulars;

    public function showViewOrderParticularsModal($invoiceNo)
    {
        $this->customerOrderParticulars = CustomerOrders::where('invoice_no', '=', $invoiceNo)->get();
    }
    
    public function render()
    {
        $customerOrders = CustomerOrders::with('product')->where('order_status', '=', 'Canceled')->where('customer_id', '=', Auth::user()->id)->groupBy('invoice_no')->paginate(5);
        return view('livewire.my-canceled-orders-component', ['customerOrders'=>$customerOrders]);
        // return view('livewire.my-canceled-orders-component');
    }
}
