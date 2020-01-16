<?php

namespace App\Http\Controllers\Site;

use App\Events\PostViewed;
use App\Http\Controllers\Controller;
use App\Mail\SendContact;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        return view('site.home.index', compact('title', 'postsFeature', 'posts'));
    }

    public function search(Request $request)
    {
        $dataForm = $request->except('_token');

        $title = 'Blog Carlos Santos';

        $posts = $this->post
                      ->where('title', 'like', "%{$dataForm['key-search']}%")
                      ->orWhere('description', 'like', "%{$dataForm['key-search']}%")
                      ->orderBy('date', 'DESC')->paginate($this->totalPage);

        return view('site.search.search', compact('title', 'posts', 'dataForm'));
    }

    public function company()
    {
        $title = 'Empresa Carlos Santos';
        return view('site.company.company', compact('title'));
    }

    public function contact()
    {
        $title = 'Contato Carlos Santos';
        return view('site.contact.contact', compact('title'));
    }

    public function sendContact(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|min:3|max:100',
            'subject' => 'required|min:3|max:100',
            'message' => 'required|min:3|max:1000',
        ]);

        $dataForm = $request->all();

        Mail::send(new SendContact($dataForm));

        return redirect()->back()
                         ->with('success', 'E-mail enviado com sucesso! Em breve entraremos em contato com você.');

    }

    public function category(Category $category, $url)
    {
        $category = $category->where('url', $url)->first();

        $title = "Categoria {$category->name} - Carlos Santos";

        $posts = $category->posts()->paginate($this->totalPage);

        return view('site.category.category', compact('category', 'posts', 'title'));
    }

    public function post($url)
    {
        $post = $this->post->with([
            'comments' => function ($query) {
                $query->where('status', 'A');
            },

            'comments.answers'
        ])
            ->where('url', $url)
            ->first();

        $title = "{$post->title} - Carlos Santos";

        $postRel = $this->post->where('category_id', $post->category_id)
            ->where('id', '<>', $post->id)
            ->limit(4)
            ->get();

        event(new PostViewed($post));

        return view('site.post.post', compact('post', 'title', 'postRel'
        ));
    }

    public function commentPost(Request $request)
    {
        $comment = new Comment();

        $dataForm = $request->all();

        $validate = validator($dataForm, $comment->rules());

        if ($validate->fails()) {
            return implode($validate->messages()->all("<p>:message</p>"));
        }


        if (!$comment->newComment($dataForm)) {
            return 'Falha ao cadastrar comentário';
        }

        return '1';
    }
}
