@extends('painel.template.template')

@section('content')
    <div class="bred">
        <a href="{{route('painel')}}" class="bred">Home ></a>
        <a href="{{route('users.index')}}" class="bred">Usuário ></a>
        <a href="{{route('users.profiles', $user->id)}}" class="bred">{{ $user->name }}</a>
    </div>


    <div class="title-pg">
        <h1 class="title-pg">Adicionar novos perfis ao usuário: <b>{{$user->name ?? 'Novo'}}</b></h1>
    </div>


    <div class="content-din">
        @if(isset($errors) && count($errors) > 0)
            <div class="alert alert-warning">
                @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
        @endif

        {!! Form::open(['route' => ['users.profiles.add', $user->id], 'class' => 'form form-search form-ds']) !!}

        @foreach($profiles as $profile)
            <div class="form-group">
                <label>
                    {!! Form::checkbox('profiles[]', $profile->id) !!}
                    {{ $profile->name }}
                </label>
            </div>

        @endforeach


        <div class="form-group">
            {!! Form::submit('Enviar', ['class' => 'btn']) !!}
        </div>
        {!! Form::close() !!}

    </div><!--Content Dinâmico-->
@endsection

