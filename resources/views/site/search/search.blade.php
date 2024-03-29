@extends('site.template.template')

@section('content')
    <section class="content">
        <div class="col-md-8">

            <div class="category">
                <div class="title-category">
                    <h1 class="title-category">Resultados para: {{ $dataForm['key-search'] }}</h1>
                </div>

                @forelse($posts as $post)
                    <article class="post">
                        <div class="image-post col-md-4 text-center">
                            <img src="{{ url("assets/uploads/posts/{$post->image}") }}" alt="{{$post->title}}"
                                 class="img-post">
                        </div>
                        <div class="description-post col-md-8">
                            <h2 class="title-post">{{ $post->title }}</h2>

                            <p class="description-post">
                                {!! Str::limit($post->description, 200) !!}
                            </p>

                            <a class="btn-post" href="{{ url("/tutorial/{$post->url}") }}">Ir <span
                                    class="glyphicon glyphicon-chevron-right"></span></a>
                        </div>
                    </article>
                @empty
                    <p>Nenhum Post encontrado</p>
                @endforelse

                <div class="pagination-posts">
                    @if(isset($dataForm))
                        {!! $posts->appends($dataForm)->links() !!}
                    @else
                        {!! $posts->links() !!}
                    @endif
                </div>
            </div>

        </div><!--POSTS-->

        @include('site.include.sidebar')
    </section>
@endsection




