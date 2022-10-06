<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function headers($req)
    {
        $domain_url = (isset($_SERVER['HTTPS']) ? "https" : "http") .  "://$_SERVER[HTTP_HOST]";
        header("Content-type: application/json");
        header("AMP-Access-Control-Allow-Source-Origin: " . $domain_url);
        header("Access-Control-Expose-Headers: AMP-Access-Control-Allow-Source-Origin");

        if($req == "redirect"){
            header("AMP-Redirect-To: ".$domain_url);
            header("Access-Control-Expose-Headers: AMP-Redirect-To");
        }
        if(is_numeric($req)){
            header("AMP-Redirect-To: ".$domain_url."/profile/$req");
            header("Access-Control-Expose-Headers: AMP-Redirect-To");
        }
    }
    public function profile($id)
    {
        $user = User::find($id);
        if(!$user)return redirect("/");
        $categorias = Category::where('estado',2)->get();
        $posts = $user->posts($user->id);
        return view('profile',compact('user','categorias','posts'));
    }

    public function edit_profile($id)
    {
        if(Auth::user()->id != $id){
            $this->headers("redirect");
            return response()->json(["error" => "No cuentas con los permisos necesarios."],401);
        }
        $categorias = Category::where('estado',2)->get();
        $user = User::find($id);

        return view('profile',compact('user','categorias'));
    }
    public function update_profile(Request $request)
    {
        if(Auth::user()->id != $request->id)
        {
        $this->headers("error");
        return response()->json(["error" => "No cuentas con los permisos necesarios."],401);
        }
        $user = User::find($request->id);
        $request->validate([
            'name' => 'required',
            'email' => 'unique:users,email,'.$user->id,
            // 'password' => 'required|min:6',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if($request->image_perfil){
            $original_file = $request->file('image_perfil');
            list($width, $height) = getimagesize($original_file->getRealPath());
            $img = Image::make($original_file->getRealPath());
            $img->resize($width, $height,function ($constraint) {
                $constraint->aspectRatio();$constraint->upsize();
            })->encode('webp',90);

            $url  = $this->genRandomString().time().'.webp';

            Storage::disk('local')->put('public/user/'.$url,$img);
            $user->image_perfil = $url;
        }
        if($request->password)
        {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $this->headers($request->id);
        return json_encode($user);
    }
    public function genRandomString()
    {
        $length = 10;
        $characters = "0123456789ABCDEFGHIJKLMNOPQRSTUVWZYZ";

        $real_string_length = strlen($characters) ;
        $string="id";

        for ($p = 0; $p < $length; $p++)
        {
            $string .= $characters[mt_rand(0, $real_string_length-1)];
        }

        return strtoupper($string);
    }
}
