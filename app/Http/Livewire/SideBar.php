<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SideBar extends Component
{
    public $name; // new property
    public $link; // new property
    public $icon; // new property
    public $type; // new property
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name = null, $link= null, $icon= null)
    {

        $this->name = $name;
        $this->link = $link;
        $this->icon = $icon;
    }
    public function render()
    {
        // return view('livewire.side-bar');
        return view('components.backend.side-bar');
    }
}
