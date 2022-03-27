<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class Testlist extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $users = User::where('id',2)->get();
        return view('components.testlist', compact('users'));
    }
}
