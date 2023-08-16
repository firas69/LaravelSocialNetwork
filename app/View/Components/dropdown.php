<?php

namespace App\View\Components;
use App\Models\category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class dropdown extends Component
{




    public function render(): View|Closure|string
    {
        return view('components.dropdown', [

        ]);
    }
}
