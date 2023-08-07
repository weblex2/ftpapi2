<?php

namespace App\View\Components\web;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class tariffCalculator extends Component
{
    /**
     * Create a new component instance.
     */

    public $basePriceBrutto;
    public $workingPriceBrutto;
    public $workingPriceTotal;
    public $total;
    public $advancedPayment;
    public $zip;
    public $energyUsage;
    public $data;


    public function __construct($data, $zip, $energyUsage)
    {
        $this->energyUsage = $energyUsage;
        $this->zip = $zip;
        $this->data = $data;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.web.tariffCalculator');
    }
}
