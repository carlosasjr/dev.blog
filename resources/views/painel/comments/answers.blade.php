@extends('painel.template.template')

@section('content')

    <div class="bred">
        <a href="{{route('painel')}}" class="bred">Home ></a> <a href="{{route('comentarios.index')}}"
                                                                 class="bred">Comentários</a>
    </div>

    <div class="title-pg">
        <h1 class="title-pg">Listagem das Respostas: <b>{{ $comment->name }} - {{ $comment->description }}</b></h1>
    </div>

    {!! Form::open(['route' => ['comentarios.destroy', $comment->id], 'method' =>'delete']) !!}
    {!! Form::submit('Deletar o comentário', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

    <div class="content-din bg-white">
        <table class="table table-striped">
            <tr>
                <th>Nome</th>
                <th>Resposta</th>
                <th width="190">Ações</th>
            </tr>

            @forelse($answers as $answer)
                <tr>
                    <td>{{ $answer->user->name }}</td>
                    <td>{{ $answer->description }}</td>
                    <td>
                        <a href="{{ route('answer.destroy', [$comment->id, $answer->id]) }}" class="edit">
                            <i class="fa fa-trash-o"></i> Deletar Resposta</a>

                    </td>
                </tr>
            @empty
                <p>Nenhuma Resposta Cadastrada</p>
            @endforelse
        </table>


        @if(Session::has('success'))
            <div class="alert alert-success hide-msg">
                {{ Session::get('success') }}
            </div>
        @endif

        @if(isset($errors) && count($errors) > 0)
            <div class="alert alert-warning">
                @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
        @endif


        <div class="form-search">
            {!! Form::open(['route' => ['answerComment', $comment->id], 'class' => 'form']) !!}

            <div class="form-group">
                {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Responder aqui..']) !!}
            </div>

            {!! Form::submit('Enviar Resposta', ['class' => 'btn btn-success']) !!}

            {!! Form::close() !!}
        </div>


    </div><!--Content Dinâmico-->
@endsection




