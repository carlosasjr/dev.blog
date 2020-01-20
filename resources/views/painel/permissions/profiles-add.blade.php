@extends('painel.template.template')

@section('content')
    <div class="bred">
        <a href="{{route('painel')}}" class="bred">Home ></a>
        <a href="{{route('permissions.index')}}" class="bred">Permissões ></a>
        <a href="{{route('permissions.profiles', $permission->id)}}" class="bred">{{ $permission->name }}</a>
    </div>


    <div class="title-pg">
        <h1 class="title-pg">Adicionar novos perfis a permissão: <b>{{$permission->name ?? 'Novo'}}</b></h1>
    </div>


    <div class="content-din">
        @if(isset($errors) && count($errors) > 0)
            <div class="alert alert-warning">
                @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
        @endif

        {!! Form::open(['route' => ['permissions.profile.add', $permission->id], 'class' => 'form form-search form-ds']) !!}

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

