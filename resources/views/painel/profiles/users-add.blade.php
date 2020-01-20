@extends('painel.template.template')

@section('content')
    <div class="bred">
        <a href="{{route('painel')}}" class="bred">Home ></a>
        <a href="{{route('profiles.index')}}" class="bred">Perfil ></a>
        <a href="{{route('profiles.users', $profile->id)}}" class="bred">{{ $profile->name }}</a>
    </div>


    <div class="title-pg">
        <h1 class="title-pg">Adicionar novos usuários ao perfil: <b>{{$profile->name ?? 'Novo'}}</b></h1>
    </div>


    <div class="content-din">
        @if(isset($errors) && count($errors) > 0)
            <div class="alert alert-warning">
                @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
        @endif

        {!! Form::open(['route' => ['profiles.users.add', $profile->id], 'class' => 'form form-search form-ds']) !!}

        @foreach($users as $user)
            <div class="form-group">
                <label>
                    {!! Form::checkbox('users[]', $user->id) !!}
                    {{ $user->name }}
                </label>
            </div>

        @endforeach


        <div class="form-group">
            {!! Form::submit('Enviar', ['class' => 'btn']) !!}
        </div>
        {!! Form::close() !!}

    </div><!--Content Dinâmico-->
@endsection

