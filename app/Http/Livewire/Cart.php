<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Cart extends Component
{

    protected $listeners = ['cartUpdated' => '$refresh'];
    public $cartItems = [];
    public $showingCheckoutModal = false;
    public $showingMessageModal = false;

    public function removeCart($id)
    {
        \Cart::remove($id);

        session()->flash('success', 'Item has removed !');
        $this->showMessageModal();

    }

    public function clearAllCart()
    {
        \Cart::clear();

        session()->flash('success', 'Cart is emptied.');

        $this->showMessageModal();
    }

    public function showCheckoutModal()
    {
        $this->reset();
        $this->showingCheckoutModal = true;
    }

    public function showMessageModal()
    {
        $this->reset();
        // session()->flash('success', 'Cart is emptied.');

        $this->showingMessageModal = true;
    }

    public function proceedToCheckOut()
    {
        $this->showingCheckoutModal = false;
    }


    // public function render()
    // {
    //     $this->cartItems = \Cart::getContent()->toArray();

    //     return view('livewire.cart-list');
    // }

    public function render()
    {
        return view('livewire.cart');
    }
}
