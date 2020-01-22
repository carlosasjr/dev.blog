<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\ControllerStandard;
use App\Models\Permission;
use App\Models\Profile;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends ControllerStandard
{
    public function __construct(Profile $profile)
    {
        $this->model = $profile;
        $this->title = 'Perfil';
        $this->view = 'painel.profiles';
        $this->route = 'profiles';
    }


    //users
    public function users($id)
    {
        $profile = $this->model->find($id);

        $users = $profile->users()
            ->distinct('user_id')
            ->paginate($this->totalPage);

        $title = 'Usuários com o perfil: ' . $profile->name;

        return view('painel.profiles.users', compact('profile', 'users', 'title'));
    }

    public function listUsersAdd($id)
    {
        $profile = $this->model->find($id);

        //$users = User::doesntHave('profiles')->get();
        $users = User::WhereNotIn('id', function ($query) use ($profile) {
            $query->select('profile_user.user_id');
            $query->from('profile_user');
            $query->whereRaw("profile_user.profile_id = {$profile->id}");
        })->get();

        $title = 'Vincular usuário ao perfil: ' . $profile->name;

        return view('painel.profiles.users-add', compact('profile', 'users', 'title'));
    }

    public function userAddProfile(Request $request, $id)
    {
        $dataForm = $request->get('users');

        $profile = $this->model->find($id);

        $profile->users()->attach($dataForm);

        return redirect()->route('profiles.users', $profile->id)
            ->with('success', 'Usuário adicionado com sucesso!');;
    }

    public function userDeleteProfile($id, $userId)
    {
        $profile = $this->model->find($id);

        $profile->users()->detach($userId);

        return redirect()->route('profiles.users', $profile->id)
            ->with('success', 'Usuário removido com sucesso!');
    }


    public function searchUsers(Request $request, $id)
    {
        $dataForm = $request->except('_token');

        $profile = $this->model->find($id);

        $users = $profile->users()
            ->where('users.name', 'like', "%{$dataForm['pesquisa']}%")
            ->orWhere('users.email', '=', "{$dataForm['pesquisa']}")
            ->paginate($this->totalPage);

        $title = 'Usuários com o perfil: ' . $profile->name;

        return view('painel.profiles.users', compact('profile', 'users', 'title', 'dataForm'));
    }


    //permissions
    public function permissions($id)
    {
        $profile = $this->model->find($id);

        $permissions = $profile->permissions()
            ->distinct()
            ->paginate($this->totalPage);

        $title = 'Permissões com o perfil: ' . $profile->name;

        return view('painel.profiles.permissions', compact('profile', 'permissions', 'title'));
    }


    public function listPermissionAdd($id)
    {
        $profile = $this->model->find($id);

        $permissions = Permission::WhereNotIn('id', function ($query) use ($profile) {
            $query->select('permission_profile.permission_id');
            $query->from('permission_profile');
            $query->whereRaw("permission_profile.profile_id = {$profile->id}");
        })->get();

        $title = 'Vincular permissão ao perfil: ' . $profile->name;

        return view('painel.profiles.permissions-add', compact('profile', 'permissions', 'title'));
    }

    public function permissionAddProfile(Request $request, $id)
    {
        $dataForm = $request->get('permissions');

        $profile = $this->model->find($id);

        $profile->permissions()->attach($dataForm);

        return redirect()->route('profiles.permissions', $profile->id)
            ->with('success', 'Permissão adicionada com sucesso!');;
    }

    public function permissionDeleteProfile($id, $permissionId)
    {
        $profile = $this->model->find($id);

        $profile->permissions()->detach($permissionId);

        return redirect()->route('profiles.permissions', $profile->id)
            ->with('success', 'Permissão removida com sucesso!');
    }

    public function searchPermissions(Request $request, $id)
    {
        $dataForm = $request->except('_token');

        $profile = $this->model->find($id);

        $permissions = $profile->permissions()
            ->where(function ($query) use ($dataForm) {
                $query->where('permissions.name', 'like', "%{$dataForm['pesquisa']}%")
                    ->orWhere('permissions.label', 'like', "%{$dataForm['pesquisa']}%");
            })->paginate($this->totalPage);

        $title = 'Permissões com o perfil: ' . $profile->name;

        return view('painel.profiles.permissions', compact('profile', 'permissions', 'title', 'dataForm'));
    }


    public function search(Request $request)
    {
        $dataForm = $request->except('_token');

        $data = $this->model->where('name', 'like', "%{$dataForm['pesquisa']}%")
            ->orWhere('label', 'like', "%{$dataForm['pesquisa']}%")
            ->paginate($this->totalPage);

        return view("{$this->view}.index", compact('data', 'dataForm'));
    }


}
