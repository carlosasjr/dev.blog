@extends('painel.template.template')

@section('content')

    <div class="bred">
        <a href="{{route('painel')}}" class="bred">Home ></a> <a href="{{route('permissions.index')}}" class="bred">Permissões</a>
    </div>

    <div class="title-pg">
        <h1 class="title-pg">Listagem das Permissões</h1>
    </div>

    <div class="content-din bg-white">

        <div class="form-search">
            {!! Form::open(['route' => 'permissions.search', 'class' => 'form form-inline']) !!}

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
            <a href="{{ route('permissions.create') }}" class="btn-insert">
                <span class="glyphicon glyphicon-plus"></span>
                Cadastrar
            </a>
        </div>

        <table class="table table-striped">
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th width="280">Ações</th>
            </tr>

            @forelse($data as $permission)
                <tr>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->label }}</td>
                    <td>
                        <a href="{{ route('permissions.edit', $permission->id) }}" class="edit"><span
                                class="glyphicon glyphicon-pencil"></span> Editar</a>

                        <a href="{{ route('permissions.show', $permission->id) }}" class="delete"><span
                                class="glyphicon glyphicon-eye-open"></span>Visualizar</a>

                        <a href="{{ route('permissions.profiles', $permission->id) }}" class="edit">
                            <i class="fa fa-users"></i> Perfis</a>
                    </td>
                </tr>
            @empty
                <p>Nenhuma Permissão Cadastrada</p>
            @endforelse
        </table>

        @if(isset($dataForm))
            {!! $data->appends($dataForm)->links() !!}
        @else
            {!! $data->links() !!}
        @endif

    </div><!--Content Dinâmico-->
@endsection

