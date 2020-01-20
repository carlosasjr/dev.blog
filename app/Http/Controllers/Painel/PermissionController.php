<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\ControllerStandard;
use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;

class PermissionController extends ControllerStandard
{
    public function __construct(Permission $permission)
    {
        $this->model = $permission;
        $this->title = 'Permissão';
        $this->view = 'painel.permissions';
        $this->route = 'permissions';
    }

    public function profiles($id)
    {
        $permission = $this->model->find($id);

        $profiles = $permission->profiles()
            ->distinct()
            ->paginate($this->totalPage);

        $title = 'Perfis com a permissão: ' . $permission->name;

        return view('painel.permissions.profiles', compact('permission', 'profiles', 'title'));
    }

    public function searchProfiles(Request $request, $id)
    {
        $dataForm = $request->except('_token');

        $permission = $this->model->find($id);

        $profiles = $permission->profiles()
                               ->where('name', 'like', "%{$dataForm['pesquisa']}%")
                               ->orWhere('label', 'like', "%{$dataForm['pesquisa']}%")
                               ->paginate($this->totalPage);

        $title = 'Perfis com a permissão: ' . $permission->name;

        return view('painel.permissions.profiles', compact('permission', 'profiles', 'dataForm', 'title'));
    }

    public function listProfileAdd($id)
    {
        $permission = $this->model->find($id);


        $profiles = Profile::WhereNotIn('id', function ($query) use ($permission) {
            $query->select('permission_profile.profile_id');
            $query->from('permission_profile');
            $query->whereRaw("permission_profile.permission_id = {$permission->id}");
        })->get();

        $title = 'Vincular perfil a permissão: ' . $permission->name;


        return view('painel.permissions.profiles-add', compact('permission', 'profiles', 'title'));


    }

    public function permissionDeleteProfile($id, $profileId)
    {
        $permission = $this->model->find($id);

        $permission->profiles()->detach($profileId);

        return redirect()->route('permissions.profiles', $permission->id)
                        ->with('success', 'Perfil removido com sucesso!');
    }

    public function permissionAddProfile(Request $request, $id)
    {
        $dataForm = $request->get('profiles');

        $permission = $this->model->find($id);

        $permission->profiles()->attach($dataForm);

        return redirect()->route('permissions.profiles', $permission->id)
                         ->with('success', 'Perfil adicionado com sucesso!');
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
