<?php

namespace App\View\Components;

use Illuminate\View\Component;

class card_product extends Component
{
    // public $title;
    // public $img;
    // public $price;
    public $item;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($item)
    {
        // $this->title = $title;
        // $this->img = $img;
        // $this->price = $price;
        $this->item = $item;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.card_product');
    }
}
