<?php

namespace App\View\Components\client;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class card extends Component
{
    // public $card;
    public $name;
    public $price;
    public $category;
    public $productid;
    public $imageurl;
    public $imageurlsecond;
    public $quantity;
    public $sale;
    public $salepercent;
    public $promotion;
    /**
     * Create a new component instance.
     */
    public function __construct($name, $price, $category, $productid, $imageurl, $imageurlsecond, $quantity, $sale, $salepercent, $promotion)
    {
        $this->name = $name;
        $this->price = $price;
        $this->promotion = $promotion;
        $this->category = $category;
        $this->productid = $productid;
        $this->imageurl = $imageurl;
        $this->imageurlsecond = $imageurlsecond;
        $this->quantity = $quantity;
        $this->sale = $sale;
        $this->salepercent = $salepercent;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.client.card');
    }
}