<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\ProductType;
use Livewire\Component;

class ProductFilter extends Component
{
    public $products;
    public $selectedType = 'all';
    public $types;
    private ProductType $type;

    public function mount($types)
    {
        $this->types = $types;
        $this->products = Product::all();
    }

    public function updatedSelectedType(string $value)
    {
        if ($value == 'all') {
            $this->products = Product::all();
        } else {
            $type =  $this->type::where('name', $value)->get()->first();

            $this->products = $type->products()->get();
        }
    }

    public function render()
    {
        return view('livewire.product-filter');
    }
}
