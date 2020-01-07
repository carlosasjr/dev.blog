@extends('painel.template.template')

@section('content')
    <div class="bred">
        <a href="{{route('painel')}}" class="bred">Home ></a>
        <a href="{{route('profile')}}" class="bred">Meu Perfil</a>
    </div>

    <div class="title-pg">
        <h1 class="title-pg">Meu Perfil: <b>{{$data->name}}</b></h1>
    </div>

    <div class="content-din">
        @if(isset($errors) && count($errors) > 0)
            <div class="alert alert-warning">
                @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
        @endif

        @if(Session::has('success'))
            <div class="alert alert-success hide-msg">
                {{ Session::get('success') }}
            </div>
        @endif

        {!! Form::model($data, ['route' => ['profile.update', $data->id], 'class' => 'form form-search form-ds', 'files' => true, 'method' => 'put']) !!}

        <div class="form-group">
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nome:']) !!}
        </div>

        <div class="form-group">
            {!! Form::hidden('email', null, ['class' => 'form-control']) !!}
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

