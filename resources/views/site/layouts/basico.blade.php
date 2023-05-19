<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Super Gestão -  @yield('titulo')</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href=" {{asset('css/estilo_base.css')}} ">
    </head>

    <body>
        @include('site.layouts.componentes.topo')
        @yield('conteudo')
    </body>
</html>