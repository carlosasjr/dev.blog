<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\ControllerStandard;
use App\User;
use Illuminate\Http\Request;


class UserController extends ControllerStandard
{
    public function __construct(User $user)
    {
        $this->model = $user;
        $this->title = 'Usuarios';
        $this->view = 'painel.users';
        $this->route = 'usuarios';
        $this->upload = [
            'name' => 'image',
            'patch' => 'users'
        ];
    }

    public function search(Request $request)
    {
        $dataForm = $request->except('_token');

        $users = $this->user->where('name', 'like', "%{$dataForm['pesquisa']}%")
            ->orWhere('email', $dataForm['pesquisa'])
            ->paginate($this->totalPage);

        return view('painel.users.index', compact('users', 'dataForm'));
    }

    public function showProfile()
    {
      //recupera ao usuário
        $data = auth()->user();

        $title = 'Meu Perfil';

        return view('painel.users.profile', compact('title', 'data'));
    }

    public function updateProfile(Request $request, $id)
    {
        $request->validate($this->model->rules($id));

        $dataForm = $request->all();

        unset($dataForm['email']);

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

        return redirect()->route("profile")
            ->with(['success' => 'Perfil alterado com sucesso!']);
    }


}
