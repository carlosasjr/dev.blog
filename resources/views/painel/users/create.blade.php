@extends('painel.template.template')

@section('content')
    <div class="bred">
        <a href="{{route('painel')}}" class="bred">Home ></a>
        <a href="{{route('users.index')}}" class="bred">Usuários</a>
    </div>


    <div class="title-pg">
        <h1 class="title-pg">Gestão de Usuários: <b>{{$data->name ?? 'Novo'}}</b></h1>
    </div>


    <div class="content-din">
        @if(isset($errors) && count($errors) > 0)
            <div class="alert alert-warning">
                @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
        @endif

        @if(isset($data))
            {!! Form::model($data, ['route' => ['users.update', $data->id], 'class' => 'form form-search form-ds', 'files' => true, 'method' => 'put']) !!}
        @else
            {!! Form::open(['route' => 'users.store', 'class' => 'form form-search form-ds', 'files' => true]) !!}
        @endif


        <div class="form-group">
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nome:']) !!}
        </div>
        <div class="form-group">
            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email:']) !!}
        </div>
        <div class="form-group">
            {!! Form::password('password',  ['class' => 'form-control', 'placeholder' => 'Senha:']) !!}
        </div>
        <div class="form-group">
            {!! Form::password('password_confirmation',  ['class' => 'form-control', 'placeholder' => 'Confirmar Senha:']) !!}
        </div>
        <div class="form-group">
            {!! Form::text('facebook',null, ['class' => 'form-control', 'placeholder' => 'FaceBook:']) !!}
        </div>
        <div class="form-group">
            {!! Form::text('twitter',null, ['class' => 'form-control', 'placeholder' => 'Twitter:']) !!}
        </div>
        <div class="form-group">
            {!! Form::text('github',null, ['class' => 'form-control', 'placeholder' => 'GitHub:']) !!}
        </div>
        <div class="form-group">
            {!! Form::text('site',null, ['class' => 'form-control', 'placeholder' => 'Site:']) !!}
        </div>
        <div class="form-group">
            {!! Form::textarea('bibliograply',null, ['class' => 'form-control', 'placeholder' => 'Bibliografia:']) !!}
        </div>

        <div class="form-group">
            {!! Form::file('image',  ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Enviar', ['class' => 'btn']) !!}
        </div>
        {!! Form::close() !!}

    </div><!--Content Dinâmico-->
@endsection

