<?php

namespace App\View\Components;

use App\Models\Form;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormBuilder extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Form $form)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-builder');
    }
}
