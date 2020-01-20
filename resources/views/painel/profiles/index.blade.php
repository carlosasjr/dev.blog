@extends('painel.template.template')

@section('content')

    <div class="bred">
        <a href="{{route('painel')}}" class="bred">Home ></a> <a href="{{route('profiles.index')}}" class="bred">Perfil</a>
    </div>

    <div class="title-pg">
        <h1 class="title-pg">Listagem das Perfis</h1>
    </div>

    <div class="content-din bg-white">

        <div class="form-search">
            {!! Form::open(['route' => 'profiles.search', 'class' => 'form form-inline']) !!}

            {!! Form::text('pesquisa', null, ['class' => 'form-control', 'placeholder' => 'Pesquisa']) !!}


            {!! Form::submit('Filtrar', ['class' => 'btn']) !!}

            {!! Form::close() !!}
        </div>

        @if(Session::has('success'))
            <div class="alert alert-success hide-msg">
                {{ Session::get('success') }}
            </div>
        @endif

        <div class="class-btn-insert">
            <a href="{{ route('profiles.create') }}" class="btn-insert">
                <span class="glyphicon glyphicon-plus"></span>
                Cadastrar
            </a>
        </div>

        <table class="table table-striped">
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th width="400">Ações</th>
            </tr>

            @forelse($data as $profile)
                <tr>
                    <td>{{ $profile->name }}</td>
                    <td>{{ $profile->label }}</td>
                    <td>
                        <a href="{{ route('profiles.edit', $profile->id) }}" class="edit"><span
                                class="glyphicon glyphicon-pencil"></span> Editar</a>

                        <a href="{{ route('profiles.show', $profile->id) }}" class="delete"><span
                                class="glyphicon glyphicon-eye-open"></span>Visualizar</a>

                        <a href="{{ route('profiles.users', $profile->id) }}" class="edit">
                            <i class="fa fa-id-card"></i> Usuários</a>

                        <a href="{{ route('profiles.permissions', $profile->id) }}" class="delete">
                            <i class="fa fa-unlock-alt"></i> Permissões</a>
                    </td>
                </tr>
            @empty
                <p>Nenhuma Perfil Cadastrado</p>
            @endforelse
        </table>

        @if(isset($dataForm))
            {!! $data->appends($dataForm)->links() !!}
        @else
            {!! $data->links() !!}
        @endif

    </div><!--Content Dinâmico-->
@endsection

