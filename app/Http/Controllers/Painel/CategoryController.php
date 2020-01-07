<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\ControllerStandard;
use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends ControllerStandard
{
    public function __construct(Category $category)
    {
        $this->model = $category;
        $this->title = 'Categoria';
        $this->view  = 'painel.categories';
        $this->route = 'categorias';
        $this->upload = [
            'name' => 'image',
            'patch' => 'categories'
        ];
    }

    public function search(Request $request)
    {
        $dataForm = $request->except('_token');

        $data = $this->model->where('name', 'like', "%{$dataForm['pesquisa']}%")
            ->orWhere('url', $dataForm['pesquisa'])
            ->paginate($this->totalPage);

        return view("{$this->view}.index", compact('data', 'dataForm'));
    }
}
