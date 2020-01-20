@extends('painel.template.template')

@section('content')
    <div class="bred">
        <a href="{{route('painel')}}" class="bred">Home ></a>
        <a href="{{route('users.index')}}" class="bred">Usuários</a>
    </div>

    <div class="title-pg">
        <h1 class="title-pg">Usuário: <b>{{$data->name}}</b></h1>
    </div>


    <div class="content-din">
        @if(isset($errors) && count($errors) > 0)
            <div class="alert alert-warning">
                @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
        @endif


        <h2><strong>Nome: </strong>{{ $data->name }}</h2>
        <h2><strong>Email: </strong>{{ $data->email }}</h2>
        <h2><strong>Facebook: </strong>{{ $data->facebook }}</h2>
        <h2><strong>Twitter: </strong>{{ $data->twitter }}</h2>
        <h2><strong>GitHub: </strong>{{ $data->gibhub }}</h2>
        <h2><strong>Site: </strong>{{ $data->site }}</h2>
        <h2><strong>Bibliografia: </strong>{{ $data->bibliograply }}</h2>

            {!! Form::model($data, ['route' => ['users.destroy', $data->id], 'class' => 'form form-search form-ds', 'method' => 'delete']) !!}

        <div class="form-group">
            {!! Form::submit("Deletar Usuário: {$data->name}" , ['class' => 'btn btn-danger']) !!}
        </div>
        {!! Form::close() !!}

    </div><!--Content Dinâmico-->
@endsection

