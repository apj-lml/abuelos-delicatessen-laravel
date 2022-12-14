<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;



class ViewProductComponent extends Component
{

    public $search;
    public $prod_id;
 
    protected $queryString = ['id'];

    public function mount($id)
    {
        // $product = Product::findOrFail($id);
        $this->prod_id = $id;
    }

    public function render()
    {
        return view('livewire.view-product-component',
        ['product' => Product::with('productImages')->find($this->prod_id)]
    );
    }
}
