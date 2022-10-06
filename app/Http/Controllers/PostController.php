<?php

namespace App\Http\Controllers;

use App\Models\Post;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFMpeg;
use getID3;
// use getID3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PostController extends Controller
{
    public function test()
    {


    }
    public function headers()
    {
        $domain_url = (isset($_SERVER['HTTPS']) ? "https" : "http") .  "://$_SERVER[HTTP_HOST]";
        header("Content-type: application/json");
        header("AMP-Access-Control-Allow-Source-Origin: " . $domain_url);
        header("Access-Control-Expose-Headers: AMP-Access-Control-Allow-Source-Origin");
        header("AMP-Redirect-To: ".$domain_url.'/ultimos-memes');
        header("Access-Control-Expose-Headers: AMP-Redirect-To");
    }
    public function max_size($req,$size)
    {
        if($req->getSize() >= $size ) {
            return true;
        }
        return false;
    }
    public function add_post(Request $request)
    {
        if(!(Auth::check())) die("Debes iniciar sesion");

        $original_file = $request->file('data_file');
        if(!$original_file)return response()->json(['error'=>'Debes subir un archivo.'],401);
        $mime = mime_content_type($original_file->getRealPath());

        if(strstr($mime, "video/")){

            if($this->max_size($original_file,20000000))return response()->json(['error'=>'El video exece el limite de tamaño.'],422);
            $post = $this->add_video($request);

        }else if(strstr($mime, "image/")){
            $post = $this->add_image($request);
        }else{
            die("no es una imagen o video");
        }
        $post['user_id'] = $request->user_id;
        $post['categoria']  = '1';

        Post::create($post);

        $this->headers();
        return response()->json($post,200);
    }

    public function add_image($request )
    {
        $original_file = $request->file('data_file');
        $tipo = 1;
        list($width, $height) = getimagesize($original_file->getRealPath());
        $size = "$width,$height";
        $descripcion = $request->descripcion;

        //saco texto de la imagen
        $comando = "tesseract " . escapeshellarg($original_file->getRealPath()) . " stdout -l eng -l spa -c debug_file=/dev/null";
        exec($comando, $textoDetectado, $codigoSalida);

        foreach ($textoDetectado as $key => $value) {

            $textoDetectado[$key] = str_replace(',', '', $value);

            $textoDetectado[$key] = preg_replace('/[^\p{L}\p{N}\s]/u', '', $value);
            $textoDetectado[$key] = str_replace(' ', ',', $textoDetectado[$key]);

            if(!$value || strlen($value) <= 2){
                unset($textoDetectado[$key]);
            }
        }
        $palabras_clave = ($codigoSalida === 0 && !$request->palabras_clave)
            ? implode(",", $textoDetectado )
            : str_replace(' ',',',$request->palabras_clave);

        $img = Image::make($original_file->getRealPath());
        $img->resize($width, $height,function ($constraint) {
            $constraint->aspectRatio();$constraint->upsize();
        })->encode('webp',90);

        $url  = $this->genRandomString().time().'.webp';

        Storage::disk('local')->put('public/post/'.$url,$img);

        $tmp_descripcion = '';
        foreach (explode(',',$palabras_clave) as $palabra)
        {
            if ($palabra && (strlen($palabra) >= 3)){
                $tmp_descripcion .= ' '.$palabra;
            }
        }


        $descripcion = $request->descripcion ? $request->descripcion : $tmp_descripcion;
        $slug        = Str::slug($descripcion.$this->genRandomString().time());

        return compact('url','size','palabras_clave','tipo','descripcion','slug');
    }

    public function add_video($request)
    {
        $original_file = $request->file('data_file');
        $tipo = 2;
        $palabras_clave = str_replace(' ',',',$request->palabras_clave);

        $getID3 = new getID3;
        $file = $getID3->analyze($original_file);

        $size = $file['video']['resolution_x']."," .$file['video']['resolution_y'];
        $url = $this->genRandomString().time().'.'.$file['fileformat'];

        $original_file->move('storage/post-video/',$url);

        $tmp_descripcion = '';
        foreach (explode(',',$palabras_clave) as $palabra)
        {
            if ($palabra && (strlen($palabra) >= 3)){
                $tmp_descripcion .= ' '.$palabra;
            }
        }

        $descripcion = $request->descripcion ? $request->descripcion : $tmp_descripcion;
        $slug        = Str::slug($descripcion.$this->genRandomString().time());

        return compact('url','size','palabras_clave','tipo','descripcion','slug');

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
