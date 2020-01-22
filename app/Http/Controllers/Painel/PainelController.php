<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Permission;
use App\Models\Post;
use App\Models\Profile;
use App\User;

class PainelController extends Controller
{
    public function index()
    {
        $total['usuarios'] = User::count();
        $total['categorias'] = Category::count();
        $total['posts'] =  Post::count();
        $total['comentarios'] =  Comment::where('status', 'R')->count();
        $total['perfis'] =  Profile::count();
        $total['permissoes'] =  Permission::count();

        return view ('painel.home.index', compact('total'));
    }
}
