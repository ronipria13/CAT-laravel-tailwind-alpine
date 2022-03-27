<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Managements\Roles;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $maxAttempts = 3;
    protected $decayMinutes = 2;

    public function index()
    {
        return view('login');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            if(!Auth::user()->is_active){
                Auth::logout();
                return response()->json([
                    'success' => false,
                    'message' => 'Your account has been disabled.',
                ], 401);
            }


            $this->checkCurrentRole();
            $request->session()->regenerate();
            
            session()->put('current_role', auth()->user()->thisRole->id);
            session()->put('current_role_name', auth()->user()->thisRole->role_name);

            //set my roles
            $myroles = auth()->user()->roleplay->load('roles');
            session()->put('myroles', [
                "roles" => $myroles->pluck('roles')->toArray(), // store all owned roles
                "expires_at" => now()->addMinutes(5) // set session expire time for 5 minutes
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Login Success',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Username or password is incorrect.',
        ], 401);
    }
    /**
     * Logins out the user.
     * destroy session and redirect to login page
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    /**
     * check if this user has current role
     */
    private function checkCurrentRole()
    {
        //if current role is null
        $user = User::where("id",auth()->user()->id);
        if(is_null(auth()->user()->current_role) OR auth()->user()->current_role == "")
        {
            $this->setCurrentRole($user);
        }
        else{
            //if current role is setted
            $roles = Roles::where("id",auth()->user()->current_role)->get();
            if($roles->count() == 0) //if current role is not exist
            {
                $this->setCurrentRole($user);
            }
        }
    }
    /**
     * set current role
     */
    private function setCurrentRole($user)
    {
        //if user has role
        if(auth()->user()->roleplay->count() > 0)
        {
            // set current role to the first role of user
            $main_role = auth()->user()->roleplay->first()->role_id;
            $user->update(['current_role' => $main_role]);
        }
        else{
            //if user has no role
            return response()->json([
                'success' => false,
                'message' => 'No role assigned',
            ], 401);
        }
    }
}
