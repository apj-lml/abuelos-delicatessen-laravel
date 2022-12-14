<?php

namespace App\Http\Livewire;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class MyModal extends ModalComponent
{
    public function render()
    {
    return view('livewire.my-modal');
    }
}
