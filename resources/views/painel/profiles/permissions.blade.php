@extends('painel.template.template')

@section('content')

    <div class="bred">
        <a href="{{route('painel')}}" class="bred">Home ></a> <a href="{{route('profiles.index')}}" class="bred">Perfil</a>
    </div>

    <div class="title-pg">
        <h1 class="title-pg">Permissões do perfil: <b>{{ $profile->name }}</b></h1>
    </div>

    <div class="content-din bg-white">

        <div class="form-search">
            {!! Form::open(['route' => ['profiles.permissions.search', $profile->id], 'class' => 'form form-inline']) !!}

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
            <a href="{{ route('profiles.permissions.list', $profile->id) }}" class="btn-insert">
                <span class="glyphicon glyphicon-plus"></span>
                Cadastrar
            </a>
        </div>

        <table class="table table-striped">
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th width="150">Ações</th>
            </tr>

            @forelse($permissions as $permission)
                <tr>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->label }}</td>
                    <td>
                        <a href="{{ route('profiles.permissions.delete', [$profile->id, $permission->id]) }}" class="delete"><span
                                class="glyphicon glyphicon-trash"></span> Deletar</a>

                    </td>
                </tr>
            @empty
                <p>Nenhum Permissão Vinculado ao Perfil</p>
            @endforelse
        </table>

        @if(isset($dataForm))
            {!! $permissions->appends($dataForm)->links() !!}
        @else
            {!! $permissions->links() !!}
        @endif

    </div><!--Content Dinâmico-->
@endsection

