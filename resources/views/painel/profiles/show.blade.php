@extends('painel.template.template')

@section('content')
    <div class="bred">
        <a href="{{route('painel')}}" class="bred">Home ></a>
        <a href="{{route('profiles.index')}}" class="bred">Perfil</a>
    </div>

    <div class="title-pg">
        <h1 class="title-pg">Perfil: <b>{{$data->name}}</b></h1>
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
        <h2><strong>Descrição: </strong>{{ $data->label }}</h2>


            {!! Form::model($data, ['route' => ['profiles.destroy', $data->id], 'class' => 'form form-search form-ds', 'method' => 'delete']) !!}

        <div class="form-group">
            {!! Form::submit("Deletar Perfil: {$data->name}" , ['class' => 'btn btn-danger']) !!}
        </div>
        {!! Form::close() !!}

    </div><!--Content Dinâmico-->
@endsection

