<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\CustomerOrders;
use Livewire\WithPagination;
use Auth;

class MyFulfilledOrdersComponent extends Component
{
    use WithPagination;
    public $customerOrderParticulars;
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function showViewOrderParticularsModal($invoiceNo)
    {
        // dd($user->id);

        $this->customerOrderParticulars = CustomerOrders::with('product')->where('invoice_no', '=', $invoiceNo)->get();
        // dd(CustomerOrders::where('invoice_no', '=', $invoiceNo));
    }

    public function render()
    {

        $customerOrders = CustomerOrders::with('product')->where('order_status', '=', 'Fulfilled')->where('customer_id', '=', Auth::user()->id)->groupBy('invoice_no')->paginate(5);

        return view('livewire.my-fulfilled-orders-component', ['customerOrders'=>$customerOrders]);
        // return view('livewire.my-fulfilled-orders-component');

    }

}
