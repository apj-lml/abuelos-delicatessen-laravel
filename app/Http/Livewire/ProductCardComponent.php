<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;


class ProductCardComponent extends Component
{

    public $searchVal = '';
    

    public function render()
    {
        return view('livewire.product-card-component', [
            'products' => Product::with('productImages')->where('product_title', 'like', "%{$this->searchVal}%")->paginate(7),
        ]);
        // return view('livewire.product-card-component');
    }
}
