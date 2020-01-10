@extends('site.template.template')

@section('content')
    <div class="conpany text-center">
        <h1 class="title">
            Sobre a EspecializaTi
        </h1>
        <h2 class="sub-title">
            Felizmente estamos conseguindo cumprir a nossa missão que é formar o maior número de profissionais
            verdadeiramente qualificados para o mercado web.
        </h2>

        <div class="col-md-6">
            <img src="{{ url('assets/site/imgs/empresa-especializati.jpg') }}" alt="EspecializaTi" class="company">
        </div>
        <div class="col-md-6 text-company text-justify">
            <p class="text-company-esp">Temos a missão social de ajudar ao máximo cada pessoa que sonha em se tornar
                um(a) programador(a) acima da média, pessoas que estão verdadeiramente comprometidas com o próprio
                sucesso.</p>

            <p>A Especializa Ti foi fundada em 2014 pelo professor Carlos Ferreira, atualmente aplicamos nossa
                metodologia em escopo mundial. Já temos alunos em mais de 6 países diferentes.</p>

            <p>Nossa visão é muito clara e objetiva, temos como meta principal ajudar cada um que se proponha a ter uma
                vida melhor, ajudamos ensinando ao máximo tudo aquilo que aprendemos com prática diária.</p>

            <p>Possuímos uma metodologia de ensino diferenciada, pois aplicamos conceitos práticos que são úteis para o
                dia a dia de qualquer programador web. Nosso foco é ensinar como aplicar conhecimentos em
                funcionalidades do mundo real.</p>
        </div>
    </div>
@endsection





