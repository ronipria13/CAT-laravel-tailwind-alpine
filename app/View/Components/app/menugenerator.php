<?php

namespace App\View\Components\app;

use App\Models\Managements\Menugroups;
use Illuminate\View\Component;
use App\Models\Managements\Menus;
use App\Models\Managements\Permissions;

class menugenerator extends Component
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
        $menu = [];
        // check if user has menu session
        if(session()->has('menu_session')){
            $menu_session = session()->get('menu_session');

            // check menu session expire time
            if($menu_session['expires_at']->diffInSeconds(now(),false) < 0){
                //if not expired, get menu from session
                $menu = $menu_session['menu'];
            }
            else { 
                //if expired, get menu from database
                session()->forget('menu_session');
                $menu = $this->myMenu();
            }
        }
        // if no menu session found, get menu from database
        else {
            $menu = $this->myMenu();
        }
        //send menu to view
        return view('components.app.menugenerator', compact('menu'));
    }

    /**
     * generate menu based on your role
     */
    private function myMenu()
    {
        // get all menu group with menus
        $menu = Menugroups::with('menus')->get()->toArray();
        // get your permission by role
        $permissions = Permissions::MypermissionsForMenu()->get();
        $myPermissons = $permissions->pluck('action_id');

        // remap menu and set menu based on your permission
        foreach($menu as $key => $value) {
            foreach($value['menus'] as $key2 => $value2) {
                if(!$myPermissons->contains($value2['action_id'])) {
                    unset($menu[$key]['menus'][$key2]);
                }
            }
            if(count($menu[$key]['menus']) == 0) {
                unset($menu[$key]);
            }
        }

        // store menu in session with expire time
        session()->put('menu_session', ["menu" => $menu, "expires_at" => now()->addMinutes(5)]); //set expires time to 5 minutes

        return $menu;

    }
}
