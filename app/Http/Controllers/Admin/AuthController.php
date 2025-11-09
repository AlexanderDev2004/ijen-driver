<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {
    public function showLogin(){
        return view('admin.auth.login');
    }
    public function login(Request $r){
        $r->validate(['email'=>'required|email','password'=>'required']);
        $user = User::where('email',$r->email)->first();
        if($user && Hash::check($r->password, $user->password) && $user->is_admin){
            session()->put('admin_id', $user->id);
            return redirect()->route('admin.dashboard');
        }
        return back()->withErrors(['email'=>'Credentials wrong or not admin']);
    }
    public function logout(){
        session()->forget('admin_id');
        return redirect()->route('admin.login');
    }
}
