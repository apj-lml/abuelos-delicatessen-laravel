<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;


class CheckOurProductComponent extends Component
{



    public function render()
    {
        // return view('livewire.check-our-product-component', [
        //     'products' => Product::where('product_title', 'like', "%{$this->searchVal}%")->paginate(8),
        // ]);
        return view('livewire.check-our-product-component',
        [
            'products' => Product::all(),
        ]);
    }
}
