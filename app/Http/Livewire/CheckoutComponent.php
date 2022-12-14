<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CheckoutComponent extends Component
{

    protected $listeners = ['cartUpdated' => '$refresh'];
    public $cartItems = [];
    public $showingCheckoutModal = false;
    public $showingMessageModal = false;

    public $cartProducts;
    public $countProducts = 0;


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

    public function render()
    {
        // $count = 0;

        $items = \Cart::getContent();

            foreach ($items as $item) {
                $this->countProducts += $item->quantity;
            }
        $this->cartItems = \Cart::getContent()->toArray();
        return view('livewire.checkout-component', ['countProducts' => $this->countProducts]);
    }
}
