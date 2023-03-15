<?php

namespace App\Http\Livewire;

use App\Models\TypeWork;
use Livewire\Component;

class MethodsController extends Component
{
    public function services_get_type_work()
    {
        $type_work = TypeWork::where("type_works.status","ACTIVE")->get();
        return $type_work;
    }
}
