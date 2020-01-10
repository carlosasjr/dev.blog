<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

class SiteController extends Controller
{
    private $post;
    private $totalPage = 6;
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function index()
    {
       $title = 'Blog Carlos Santos';

       $postsFeature = $this->post
                           ->where('featured', true)
                           ->where('status', 'A')
                           ->limit(3)
                           ->get();

       $posts = $this->post->orderBy('date', 'DESC')->paginate($this->totalPage);

       return view('site.home.index',  compact('title', 'postsFeature', 'posts'));
    }

    public function company()
    {
        $title = 'Empresa Carlos Santos';
        return view('site.company.company', compact('title'));
    }

    public function contact()
    {
        $title = 'Contato Carlos Santos';
        return view ('site.contact.contact', compact('title'));
    }

    public function category(Category $category, $url)
    {
        $category = $category->where('url', $url)->first();

        $title = "Categoria {$category->name} - Carlos Santos";

        $posts = $category->posts()->paginate($this->totalPage);

        return view ('site.category.category', compact('category', 'posts', 'title'));

    }
}
