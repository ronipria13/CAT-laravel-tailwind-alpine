<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Rolesgenerator extends Component
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
        $roles = [];
        // check if user has roles session
        if(session()->has('myroles')){
            $myroles = session()->get('myroles');

            // check roles session expire time
            if($myroles['expires_at']->diffInSeconds(now(),false) < 0){
                //if not expired, get roles from session
                $roles = $myroles['roles'];
            }
            else { 
                //if expired, get roles from database
                session()->forget('myroles');
                $roles = $this->myRoles();
            }
        }
        // if no roles session found, get roles from database
        else {
            $roles = $this->myRoles();
        }
        //send roles to view
        return view('components.rolesgenerator', compact('roles'));
    }
    /**
     * generate roles based on user account
     */
    private function myRoles()
    {
        $myroles = auth()->user()->roleplay->load('roles');
        session()->put('myroles', [
            "roles" => $myroles->pluck('roles')->toArray(), // store all owned roles
            "expires_at" => now()->addMinutes(5) // set session expire time for 5 minutes
        ]);

        return $myroles->pluck('roles')->toArray();

    }
}
