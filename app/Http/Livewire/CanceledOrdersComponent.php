<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CustomerOrders;
use Livewire\WithPagination;


class CanceledOrdersComponent extends Component
{
    use WithPagination;
    public $customerOrderParticulars;

    public function showViewOrderParticularsModal($invoiceNo)
    {
        // dd($invoiceNo);
        $this->customerOrderParticulars = CustomerOrders::where('invoice_no', '=', $invoiceNo)->get();
        // dd(CustomerOrders::where('invoice_no', '=', $invoiceNo));
    }
    
    public function render()
    {
        $customerOrders = CustomerOrders::with('product')->where('order_status', '=', 'Canceled')->groupBy('invoice_no')->paginate(5);
        return view('livewire.canceled-orders-component', ['customerOrders'=>$customerOrders]);
    }
}
