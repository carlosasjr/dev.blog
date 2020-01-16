<!doctype html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resposta de Comentário</title>
</head>
<body>
<p> Olá, <b>{{ $comment->name }}!</b></p>
    <br>
    <p>Seu comentário foi respondido.</p>
    <p><b>Dados do comentário: </b> {{ $comment->description }}</p>
    <p><b>Dados da resposta: </b> {{ $reply->description }}</p>
    <br>
    <p>Att,</p>
    <p>Blog, Carlos Júnior - Programador</p>

</body>
</html>


