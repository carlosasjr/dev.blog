<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\ControllerStandard;
use App\Models\Profile;
use App\User;
use Illuminate\Http\Request;


class UserController extends ControllerStandard
{
    public function __construct(User $user)
    {
        $this->model = $user;
        $this->title = 'Usuarios';
        $this->view = 'painel.users';
        $this->route = 'users';
        $this->upload = [
            'name' => 'image',
            'patch' => 'users'
        ];

        $this->middleware('can:users');

        $this->middleware('can:create_user')->only(['create', 'store']);
        $this->middleware('can:update_user')->only(['edit', 'update']);
        $this->middleware('can:view_user')->only(['show']);
        $this->middleware('can:delete_user')->only(['delete']);
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

    public function profiles($id)
    {
        $user = $this->model->find($id);

        $profiles = $user->profiles()
            ->distinct()
            ->paginate($this->totalPage);

        $title = 'Perfis do usuário: ' . $user->name;

        return view('painel.users.profiles', compact('title', 'user', 'profiles'));
    }

    public function userDeleteProfile($id, $profileId)
    {

        $user = $this->model->find($id);

        $profiles = $user->profiles()->detach($profileId);

        return redirect()->route('users.profiles', $user->id)
            ->with('success', 'Perfil removido com sucesso!');

    }

    public function searchProfiles(Request $request, $id)
    {
        $dataForm = $request->except('_token');

        $user = $this->model->find($id);

        $profiles = $user->profiles()
            ->where(function ($query) use ($dataForm) {
                $query->where('profiles.name', 'like', "%{$dataForm['pesquisa']}%")
                    ->orWhere('profiles.label', 'like', "%{$dataForm['pesquisa']}%");
            })->paginate($this->totalPage);


        $title = 'Perfis do usuário: ' . $user->name;

        return view('painel.users.profiles', compact('title', 'user', 'profiles', 'dataForm'));
    }

    public function listProfileAdd($id)
    {
        $user = $this->model->find($id);

        //$users = User::doesntHave('profiles')->get();
        $profiles = Profile::WhereNotIn('id', function ($query) use ($user) {
            $query->select('profile_user.profile_id');
            $query->from('profile_user');
            $query->whereRaw("profile_user.user_id = {$user->id}");
        })->get();

        $title = 'Vincular perfil ao usuário: ' . $user->name;

        return view('painel.users.profiles-add', compact('profiles', 'user', 'title'));
    }


    public function userAddProfile(Request $request, $id)
    {
        $dataForm = $request->get('profiles');

        $user = $this->model->find($id);

        $user->profiles()->attach($dataForm);

        return redirect()->route('users.profiles', $user->id);
    }

}
