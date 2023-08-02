<?php

namespace App\View\Components\web;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class dropdown extends Component
{
    /**
     * Create a new component instance.
     */

    public $name;
    public $mydata;
    public $emptyOption;

    public function __construct($mydata,$name,$emptyOption=false)
    {
        $this->name = $name;
        $this->mydata = $mydata;
        $this->emptyOption = isset($emptyOption) ? $emptyOption : false;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.web.dropdown');
    }
}
