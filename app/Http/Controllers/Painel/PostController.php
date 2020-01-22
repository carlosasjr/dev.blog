<?php

namespace App\Http\Controllers\Painel;

use App\Helper\Helper;
use App\Http\Controllers\ControllerStandard;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends ControllerStandard
{
    public function __construct(Post $post)
    {
        $this->model = $post;
        $this->title = 'Post';
        $this->view = 'painel.posts';
        $this->route = 'posts';
        $this->upload = [
            'name' => 'image',
            'patch' => 'posts'
        ];
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        //usando Gate Automático
        if (Gate::denies('create_post')) {
            abort(403, 'Oppss...Você não tem permissão para cadastrar ');
        }

        $title = "Cadastrar {$this->title}";
        $categories = Category::get()->pluck('name', 'id');
        return view("{$this->view}.create", compact('title', 'categories'));
    }


    public function show($id)
    {
        $data = $this->model->find($id);

        //utilizando policy
      //  $this->authorize('owner', $data);

       /* if (Gate::denies('post_view', $data)) {
            return redirect()->route('posts.index')
                             ->withErrors(['errors' => 'Usuário sem permissão para visualizar']);
        }*/


       //usando Gate Automático
        if (Gate::denies('view_post')) {
            abort(403, 'Oppss...Você não tem permissão para visualizar ');
        }

        $title = "{$this->title}: {$data->name}";

        return view("{$this->view}.show", compact('title', 'data'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->model->rules());

        $dataForm = $request->all();
        $dataForm['user_id'] = auth()->user()->id;
        $dataForm['featured'] = isset($dataForm['featured']) ? true : false;
        $dataForm['url'] = Helper::createUrl($dataForm['title']);

        if ($this->upload && $request->hasFile($this->upload['name'])) {
            list($nameFile, $upload) = $this->upload($request);

            if (!$upload) {
                return redirect()->back()
                    ->withErrors('errors', 'Falha no upload do arquivo')
                    ->withInput();
            }

            $dataForm[$this->upload['name']] = $nameFile;
        }

        $insert = $this->model->create($dataForm);

        if (!$insert) {
            return redirect()->back()
                ->withErrors('Falha ao cadastrar')
                ->withInput();
        }

        return redirect()->route("{$this->route}.index")
            ->with(['success' => 'Registro realizado com sucesso!']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->model->find($id);

        $title = "Editar {$this->title}: {$data->title}";

        $categories = Category::get()->pluck('name', 'id');

        return view("{$this->view}.create", compact('title', 'data', 'categories'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, $this->model->rules($id));

        $dataForm = $request->all();
        $dataForm['featured'] = isset($dataForm['featured']) ? true : false;
        $dataForm['url'] = Helper::createUrl($dataForm['title']);

        $data = $this->model->find($id);

        if ($this->upload && $request->hasFile($this->upload['name'])) {
            $file = $data->{$this->upload['name']};

            list($nameFile, $upload) = $this->upload($request, $file);

            if (!$upload) {
                return redirect()->back()
                    ->withErrors('Falha no upload do arquivo')
                    ->withInput();
            }

            $dataForm[$this->upload['name']] = $nameFile;
        }

        $update = $data->update($dataForm);

        if (!$update) {
            return redirect()->back()
                ->withErrors('Falha ao atualizar')
                ->withInput();
        }

        return redirect()->route("{$this->route}.index")
            ->with(['success' => 'Registro alterado com sucesso!']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $dataForm = $request->except('_token');

        $data = $this->model->where('title', 'like', "%{$dataForm['pesquisa']}%")
            ->orWhere('description', 'like', "%{$dataForm['pesquisa']}%")
            ->paginate($this->totalPage);

        return view("{$this->view}.index", compact('data', 'dataForm'));
    }

}
