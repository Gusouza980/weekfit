@extends('painel.template.main')


@section('conteudo')
    @if(session()->get("usuario")["admin"])
        @include('painel.includes.analytics')
    @endif
@endsection