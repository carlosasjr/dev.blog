@extends('painel.template.template')

@section('content')
    <div class="bred">
        <a href="{{route('painel')}}" class="bred">Home ></a>
        <a href="{{route('profiles.index')}}" class="bred">Perfis</a>
    </div>


    <div class="title-pg">
        <h1 class="title-pg">Gestão de Perfis: <b>{{$data->name ?? 'Novo'}}</b></h1>
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
            {!! Form::model($data, ['route' => ['profiles.update', $data->id], 'class' => 'form form-search form-ds', 'method' => 'put']) !!}
        @else
            {!! Form::open(['route' => 'profiles.store', 'class' => 'form form-search form-ds']) !!}
        @endif


        <div class="form-group">
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nome:']) !!}
        </div>

        <div class="form-group">
            {!! Form::text('label',null, ['class' => 'form-control', 'placeholder' => 'Descrição:']) !!}
        </div>


        <div class="form-group">
            {!! Form::submit('Enviar', ['class' => 'btn']) !!}
        </div>
        {!! Form::close() !!}

    </div><!--Content Dinâmico-->
@endsection

