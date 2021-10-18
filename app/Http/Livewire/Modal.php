<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Modal extends Component
{

    public $show = false;

    protected $listeners = ['show'];

    public function show() : void
    {
        $this->show = true;
    }

    /*public function render()
    {
        return view('livewire.modal');
    }*/
}
