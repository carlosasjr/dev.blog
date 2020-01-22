@extends('painel.template.template')

@section('content')
    <div class="title-pg">
        <h1 class="title-pg">Dashboard</h1>
    </div>

    <div class="content-din">


        <div class="col-md-3 col-sm-4 col-xm-12">
            <div class="rel-dash">
                <i class="fa fa-id-card" aria-hidden="true"></i>
                <div class="text-rel">
                    <h2 class="result">
                        {{ $total['usuarios'] }}
                    </h2>
                    <h3 class="result-ds">
                        Total de Usuários
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4 col-xm-12">
            <div class="rel-dash">
                <i class="fa fa-cubes" aria-hidden="true"></i>
                <div class="text-rel">
                    <h2 class="result">
                        {{ $total['categorias'] }}
                    </h2>
                    <h3 class="result-ds">
                        Total de Categorias
                    </h3>
                </div>
            </div>
        </div>


        <div class="col-md-3 col-sm-4 col-xm-12">
            <div class="rel-dash">
                <i class="fa fa-file" aria-hidden="true"></i>
                <div class="text-rel">
                    <h2 class="result">
                        {{ $total['posts'] }}
                    </h2>
                    <h3 class="result-ds">
                        Total de Posts
                    </h3>
                </div>
            </div>
        </div>


        <div class="col-md-3 col-sm-4 col-xm-12">
            <div class="rel-dash">
                <i class="fa fa-comments" aria-hidden="true"></i>
                <div class="text-rel">
                    <h2 class="result">
                        {{ $total['comentarios'] }}
                    </h2>
                    <h3 class="result-ds">
                        Total de Comentários
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4 col-xm-12">
            <div class="rel-dash">
                <i class="fa fa-users" aria-hidden="true"></i>
                <div class="text-rel">
                    <h2 class="result">
                        {{ $total['perfis'] }}
                    </h2>
                    <h3 class="result-ds">
                        Total de Perfis
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4 col-xm-12">
            <div class="rel-dash">
                <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                <div class="text-rel">
                    <h2 class="result">
                        {{ $total['permissoes'] }}
                    </h2>
                    <h3 class="result-ds">
                        Total de Permissões
                    </h3>
                </div>
            </div>
        </div>



    </div><!--Content Dinâmico-->
@endsection

