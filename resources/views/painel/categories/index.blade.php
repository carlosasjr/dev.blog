@extends('painel.template.template')

@section('content')

    <div class="bred">
        <a href="{{route('painel')}}" class="bred">Home ></a> <a href="{{route('categorias.index')}}" class="bred">Categorias</a>
    </div>

    <div class="title-pg">
        <h1 class="title-pg">Listagem das Categorias</h1>
    </div>

    <div class="content-din bg-white">

        <div class="form-search">
            {!! Form::open(['route' => 'categorias.search', 'class' => 'form form-inline']) !!}

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
            <a href="{{ route('categorias.create') }}" class="btn-insert">
                <span class="glyphicon glyphicon-plus"></span>
                Cadastrar
            </a>
        </div>

        <table class="table table-striped">
            <tr>
                <th>Nome</th>
                <th>URL</th>
                <th>Descrição</th>
                <th width="190">Ações</th>
            </tr>

            @forelse($data as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->url }}</td>
                    <td>{{ $category->description }}</td>
                    <td>
                        <a href="{{ route('categorias.edit', $category->id) }}" class="edit"><span
                                class="glyphicon glyphicon-pencil"></span> Editar</a>
                        <a href="{{ route('categorias.show', $category->id) }}" class="delete"><span
                                class="glyphicon glyphicon-eye-open"></span>Visualizar</a>
                    </td>
                </tr>
            @empty
                <p>Nenhuma Categoria Cadastrada</p>
            @endforelse
        </table>

        @if(isset($dataForm))
            {!! $data->appends($dataForm)->links() !!}
        @else
            {!! $data->links() !!}
        @endif

    </div><!--Content Dinâmico-->
@endsection

