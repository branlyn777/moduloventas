<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Livewire\Component;

class IconoController extends Component
{
    public $nombreempresa, $logoempresa;
    public function render()
    {
        $this->nombreempresa = Company::find(1)->shortname;
        $this->logoempresa = Company::find(1)->image;
        return view('livewire.vistas.iconoempresa');
    }
}
