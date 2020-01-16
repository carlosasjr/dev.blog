@extends('painel.template.template')

@section('content')

    <div class="bred">
        <a href="{{route('painel')}}" class="bred">Home ></a> <a href="{{route('comentarios.index')}}"
                                                                 class="bred">Comentários</a>
    </div>

    <div class="title-pg">
        <h1 class="title-pg">Listagem dos Comentários</h1>
    </div>

    <div class="content-din bg-white">

        <div class="form-search">
            {!! Form::open(['route' => 'comentarios.search', 'class' => 'form form-inline']) !!}

            {!! Form::text('pesquisa', isset($dataForm['pesquisa']) ? $dataForm['pesquisa'] : null, ['class' => 'form-control', 'placeholder' => 'Pesquisa']) !!}

            {!! Form::select('status', ['R' =>'Rascunho', 'A' => 'Respondidos'], isset($dataForm['status']) ? $dataForm['status'] : null, ['class' => 'form-control']) !!}

            {!! Form::submit('Filtrar', ['class' => 'btn']) !!}

            {!! Form::close() !!}
        </div>

        @if(Session::has('success'))
            <div class="alert alert-success hide-msg">
                {{ Session::get('success') }}
            </div>
        @endif

        <table class="table table-striped">
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Comentário</th>
                <th>Status</th>
                <th width="190">Ações</th>
            </tr>

            @forelse($data as $comment)
                <tr>
                    <td>{{ $comment->name }}</td>
                    <td>{{ $comment->email }}</td>
                    <td>{{ $comment->description }}</td>
                    <td>{{ ($comment->status == 'R') ? 'Rascunho' : 'Respondido'  }}</td>
                    <td>
                        <a href="{{ route('comentarios.answers', $comment->id) }}" class="edit">
                            <i class="fa fa-reply-all"></i> Responder</a>

                    </td>
                </tr>
            @empty
                <p>Nenhum Comentário Cadastrado</p>
            @endforelse
        </table>

        @if(isset($dataForm))
            {!! $data->appends($dataForm)->links() !!}
        @else
            {!! $data->links() !!}
        @endif

    </div><!--Content Dinâmico-->
@endsection

