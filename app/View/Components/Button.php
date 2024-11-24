<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $class;

    public function __construct($class)
    {
        $this->class = $class;
    }

    public function render()
    {
        return view('components.button');
    }
}
