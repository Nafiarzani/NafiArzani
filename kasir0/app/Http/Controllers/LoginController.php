<?php
namespace App\Http\Controllers;
use illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            // Authentication successful
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->role == 'pengguna') {
                return redirect()->route('admin.dashboard');
            }
        } else {
            // Authentication failed
            return redirect()->route('login')->with('failed', 'Incorrect email or password');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('success','You have successfully logged out');
    }
    public function register(){
        return view('auth.register');
    }
    public function register_proses(Request $request){
        $request->validate([
            'nama'=> 'required',
            'email' => 'required|email|unique:users,email',
            
                'password' => [
                    'required',
                    Password::min(8)
                      ->mixedCase()
                ],
            ]);

            $data['name'] = $request->nama;
            $data['email'] = $request->email;
            $data['password'] = Hash::make($request->password);

            user::create($data);

            $login = [
                'email'=> $request->email,
                'password'=> $request->password,
            ];
           if(Auth::attempt($login)) {
            return redirect()->route('admin.dashboard');
           }else{ 
            return redirect()->route('login')->with('failed','Incorrect email or password ');
           }

    }
}
