<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CustomerOrders;
use Livewire\WithPagination;


class FulfilledOrdersComponent extends Component
{

    use WithPagination;
    public $customerOrderParticulars;

    public function showViewOrderParticularsModal($invoiceNo)
    {
        // dd($invoiceNo);
        $this->customerOrderParticulars = CustomerOrders::with('product')->where('invoice_no', '=', $invoiceNo)->get();
        // dd(CustomerOrders::where('invoice_no', '=', $invoiceNo));
    }

    public function render()
    {
        $customerOrders = CustomerOrders::with('product')->where('order_status', '=', 'Fulfilled')->groupBy('invoice_no')->paginate(5);

        return view('livewire.fulfilled-orders-component', ['customerOrders'=>$customerOrders]);
    }
}
