<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function headers($req)
    {
        $domain_url = (isset($_SERVER['HTTPS']) ? "https" : "http") .  "://$_SERVER[HTTP_HOST]";
        header("Content-type: application/json");
        header("AMP-Access-Control-Allow-Source-Origin: " . $domain_url);
        header("Access-Control-Expose-Headers: AMP-Access-Control-Allow-Source-Origin");

        if($req == "login"){
            header("AMP-Redirect-To: ".$domain_url);
            header("Access-Control-Expose-Headers: AMP-Redirect-To");
        }
    }

    public function customLogin(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $this->headers("login");
            return json_encode(Auth::user());
        }
        $this->headers("error");
        return response()->json(["error" => "Las datos ingresados no son correctos."],401);
        // return json_encode(["error" => "Las datos ingresados no son correctos."]);
    }


    public function customRegistration(Request $request)
    {
        // return json_encode($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $this->create($request->all());

        if (Auth::attempt($request->only('email', 'password'))) {
            $this->headers("login");
            return json_encode(Auth::user());
        }

        return redirect("dashboard")->withSuccess('You have signed-in');
    }

    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'rol' => Hash::make($data['rol']),
      ]);
    }


    public function signOut() {

        Session::flush();
        Auth::logout();
        $this->headers("login");
        // return Redirect('/');
    }
}
