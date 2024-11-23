<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public $id;

    public $class;

    public $type;

    public $name;

    public $value;

    public $required;

    public $autofocus;

    public function __construct($id, $class, $type, $name, $value, $required, $autofocus)
    {
        $this->id = $id;
        $this->class = $class;
        $this->type = $type;
        $this->name = $name;
        $this->value = $value;
        $this->required = $required;
        $this->autofocus = $autofocus;
    }

    public function render()
    {
        return view('components.input');
    }
}
