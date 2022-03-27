<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Managements\Roleplay;
use App\Models\User;

class RolePlayController extends Controller
{
    //
    public function switch($role_id)
    {
        if(!Str::isUuid($role_id)){
            $code = 404;
            return response()->view('app.error.page', [
                "title" => "Sorry we couldn't find this page.",
                "message" => "But dont worry, you can find plenty of other things on our homepage.",
                "code" => $code
            ] ,$code);
        }
        $user = auth()->user();
        $roleOwned = Roleplay::where(["role_id" => $role_id, "user_id" => $user->id])->get();
        // dd($roleOwned->count());
        if($roleOwned->count() == 0){
            $code = 403;
            return response()->view('app.error.page', [
                "title" => "You don't have permission to access this page",
                "message" => "your role is not allowed to access this page",
                "code" => $code
            ] ,$code);
        }
        else{
            $user = User::findorfail($user->id);
            $user->current_role = $role_id;
            $user->update();
            session()->put('current_role', $role_id);
            session()->put('current_role_name', $user->thisRole->role_name);
            
            session()->forget('menu_session');
            session()->forget('myroles');
            return redirect()->route('home');
        }
    }


}
