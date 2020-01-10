<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;

class ControllerStandard extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $model;
    protected $totalPage = 10;
    protected $title;
    protected $view;
    protected $route;
    protected $upload = false;

    /**
     * @param Request $request
     * @param null $dataFile
     * @return array
     */
    protected function upload(Request $request, $dataFile = null): array
    {
        $file = $request->file($this->upload['name']);

        //define o nome para o arquivo
        $nameFile = (!empty($dataFile)) ? $dataFile : uniqid(date('YmdHis')) . '.' . $file->getClientOriginalExtension();

        $upload = $file->storeAs($this->upload['patch'], $nameFile);
        return array($nameFile, $upload);
    }


    /**
     * @param $data
     * @return bool
     */
    protected function deleteFile($data)
    {
        $path = public_path("assets/uploads/{$this->upload['patch']}/");
        $nameFile = $path . $data->{$this->upload['name']};

        if (file_exists($nameFile)) {
            File::delete($nameFile);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $title = "Listagem de {$this->title}s";

        $data = $this->model->paginate($this->totalPage);

        return view("{$this->view}.index", compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Cadastrar {$this->title}";
        return view("{$this->view}.create", compact('title'));
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
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->model->find($id);

        $title = "{$this->title}: {$data->name}";

        return view("{$this->view}.show", compact('title', 'data'));
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

        $title = "Editar {$this->title}: {$data->name}";

        return view("{$this->view}.create", compact('title', 'data'));
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
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->model->find($id);

        $delete = $data->delete();

        if (!$delete) {
            return redirect()->back()
                             ->withErrors('Falha ao deletar');
        }

        if ($this->upload) {
            $this->deleteFile($data);
        }

        return redirect()->route("{$this->route}.index")
            ->with(['success' => 'Registro deletado com sucesso!']);
    }

    public function search(Request $request)
    {
        $dataForm = $request->except('_token');

        $data = $this->model->where('name', 'like', "%{$dataForm['pesquisa']}%")
            ->paginate($this->totalPage);

        return view("{$this->view}.index", compact('data', 'dataForm'));
    }

}
