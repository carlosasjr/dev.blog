@extends('site.template.template')

@section('content')
    <div class="category">

        <section class="content">
            <div class="col-md-8">

                <article class="post">
                    <div class="image-post text-center">
                        <img src="{{ url("assets/uploads/posts/{$post->image}") }}" alt="{{ $post->title }}"
                             class="img-post">
                    </div>
                    <div class="description-post-pg text-justify">
                        <p class="details-post">
                            <span>Autor:</span> {{ $post->user->name }} / <span>Data publicação</span>:
                            <time datetime="{{ $post->date }} {{ $post->hour }}">
                                {{ \App\Helper\Helper::formatDateTime($post->date)}}
                            </time>
                        </p>

                        <h2 class="title-post-pg">{{ $post->title }}</h2>

                        {!! $post->description !!}
                    </div>
                </article><!--End Post-->

                <article class="post comments">
                    <h2 class="title-comment">Deixe o seu comentário</h2>
                    <form class="form form-contact form-comment">
                        <input type="name" name="nome" placeholder="Nome:">
                        <input type="email" name="email" placeholder="E-mail:">
                        <textarea name="descricao" placeholder="Descrição"></textarea>

                        <button>Enviar</button>
                    </form>

                    <div class="comment">
                        <div class="col-md-2 text-center">
                            <img src="imgs/user-carlos-ferreira.png" alt="Carlos Ferreira"
                                 class="user-comment-img img-circle">
                        </div>
                        <div class="col-md-10 comment-user">
                            <p>Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de
                                impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido
                                pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos.
                                Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração
                                eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60,
                                quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais
                                recentemente quando passou a ser integrado a softwares de editoração eletrônica como
                                Aldus PageMaker.</p>
                        </div>
                    </div>

                    <div class="comment">
                        <div class="col-md-2 text-center">
                            <img src="imgs/user-carlos-ferreira.png" alt="Carlos Ferreira"
                                 class="user-comment-img img-circle">
                        </div>
                        <div class="col-md-10 comment-user">
                            <p>Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de
                                impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido
                                pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos.
                                Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração
                                eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60,
                                quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais
                                recentemente quando passou a ser integrado a softwares de editoração eletrônica como
                                Aldus PageMaker.</p>
                        </div>
                    </div>
                    <div class="reply-comment">
                        <div class="col-md-2 text-center">
                            <img src="imgs/user-carlos-ferreira.png" alt="Carlos Ferreira"
                                 class="user-comment-img img-circle">
                        </div>
                        <div class="col-md-10 comment-user">
                            <p>Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de
                                impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido
                                pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos.
                                Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração
                                eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60,
                                quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais
                                recentemente quando passou a ser integrado a softwares de editoração eletrônica como
                                Aldus PageMaker.</p>
                        </div>
                    </div>
                    <div class="reply-comment">
                        <div class="col-md-2 text-center">
                            <img src="imgs/user-carlos-ferreira.png" alt="Carlos Ferreira"
                                 class="user-comment-img img-circle">
                        </div>
                        <div class="col-md-10 comment-user">
                            <p>Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de
                                impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido
                                pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos.
                                Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração
                                eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60,
                                quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais
                                recentemente quando passou a ser integrado a softwares de editoração eletrônica como
                                Aldus PageMaker.</p>
                        </div>
                    </div>

                    <div class="comment">
                        <div class="col-md-2 text-center">
                            <img src="imgs/user-carlos-ferreira.png" alt="Carlos Ferreira"
                                 class="user-comment-img img-circle">
                        </div>
                        <div class="col-md-10 comment-user">
                            <p>Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de
                                impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido
                                pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos.
                                Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração
                                eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60,
                                quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais
                                recentemente quando passou a ser integrado a softwares de editoração eletrônica como
                                Aldus PageMaker.</p>
                        </div>
                    </div>
                </article>


            </div><!--POSTS-->

            <!--Sidebar-->
            @include('site.include.sidebar')
        </section>


        <section class="post-relation">
            <h1 class="title-post-rel">Posts Relacionados:</h1>

            @foreach($postRel as $post)
                <article class="post-rel col-md-3 col-xm-6 col-sm-12">
                    <a href="{{ route('post', $post->url) }}">
                        <div class="image-post text-center">
                            <img src="{{ url("assets/uploads/posts/{$post->image}") }}" alt="{{ $post->title }}"
                                 class="img-post">
                        </div>
                        <div class="description-post">
                            <h2 class="title-post-rel-list">{{ $post->title }}</h2>
                        </div>
                    </a>
                </article>
            @endforeach
        </section>

    </div>
@endsection





