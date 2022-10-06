<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maize\Markable\Models\Reaction;

class DashboardController extends Controller
{
    public function dashboard()
    {
            $posts = Post::where('categoria','!=','1')->orderBy('id','desc')->with(['reactions'])->paginate($perPage = 6, $columns = ['*'], $pageName = 'pagina');

            $categorias = Category::where('estado',2)->where('in_menu',2)->get();

            $total = Post::where('categoria','!=','1')->count();
            $total = ceil($total/6);
            return view('dashboard',compact('posts','total','categorias'));
    }

    public function category($slug)
    {
        $categoria = Category::where('slug',$slug)->first();
        if(!$categoria){ return redirect("/");}
        $posts = Post::where('categoria',$categoria->id)->orderBy('id','desc')->paginate($perPage = 6, $columns = ['*'], $pageName = 'pagina');

        $categorias = Category::where('estado',2)->where('in_menu',2)->get();
        $total = Post::where('categoria',$categoria->id)->count();
        $total = ceil($total/6);
        return view('dashboard',compact('posts','total','categorias','categoria'));
    }
    public function tags($titulo)
    {
        $categorias = Category::where('estado',2)->where('in_menu',2)->get();
        $posts = Post::where('categoria','!=','1')->whereRaw("find_in_set('" . $titulo . "', palabras_clave)")->paginate($perPage = 6, $columns = ['*'], $pageName = 'pagina');
        $total = Post::where('categoria','!=','1')->whereRaw("find_in_set('" . $titulo . "', palabras_clave)")->count();
        $total = ceil($total/6);
        return view('dashboard',compact('posts','total','categorias','titulo'));
    }

    public function post($slug)
    {
        $categorias = Category::where('estado',2)->where('in_menu',2)->get();
        $post = Post::where('slug',$slug)->withCount(['reactions'])->first();

        $posts_siguientes = Post::where('categoria','!=','1')->where('id','<',$post->id)->orderBy('id', 'DESC');
        $total = $posts_siguientes->count();
        $total = ceil($total/6);
        $posts_siguientes = $posts_siguientes->paginate(10);
        // dd($posts_siguientes);
        return view('detalle',compact('post','categorias','posts_siguientes','total'));
    }

    public function AddReaction(Request $request)
    {
        // return response()->json($request->like,200);
        if($request->like == "false"){
            $this->RemoveReaction($request);
            return response()->json($request->like,200);
        }
        else{
            $post = Post::find($request->id);
            $user = Auth::user();
            $emoji = $request->emoji;

            Reaction::add( $post, $user, $emoji);
            $post->increment('post_reactions_count');
            return response()->json($post,200);
        }

    }
    public function RemoveReaction(Request $request)
    {
        $post = Post::find($request->id);
        $user = Auth::user();

        Reaction::remove($post, $user, 'kissing_heart');
        return response()->json($post->id,200);
    }
}
