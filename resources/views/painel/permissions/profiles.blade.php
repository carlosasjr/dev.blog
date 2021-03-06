@extends('painel.template.template')

@section('content')

    <div class="bred">
        <a href="{{route('painel')}}" class="bred">Home ></a> <a href="{{route('permissions.index')}}" class="bred">Permissões</a>
    </div>

    <div class="title-pg">
        <h1 class="title-pg">Perfis da permissão: <b>{{ $permission->name }}</b></h1>
    </div>

    <div class="content-din bg-white">

        <div class="form-search">
            {!! Form::open(['route' => ['permissions.profiles.search', $permission->id], 'class' => 'form form-inline']) !!}

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
            <a href="{{ route('permissions.profiles.list', $permission->id) }}" class="btn-insert">
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

            @forelse($profiles as $profile)
                <tr>
                    <td>{{ $profile->name }}</td>
                    <td>{{ $profile->label }}</td>
                    <td>
                        <a href="{{ route('permissions.profile.delete', [$permission->id, $profile->id]) }}" class="delete"><span
                                class="glyphicon glyphicon-trash"></span> Deletar</a>

                    </td>
                </tr>
            @empty
                <p>Nenhum Perfil Vinculado a Permissão</p>
            @endforelse
        </table>

        @if(isset($dataForm))
            {!! $profiles->appends($dataForm)->links() !!}
        @else
            {!! $profiles->links() !!}
        @endif

    </div><!--Content Dinâmico-->
@endsection

