@extends('tamplate.main')

@section('titulo', 'Adm-XML cliente')
@section('ativo-busca-cliente', 'active')
@section('caminho', 'Menu')
@section('atual-page', "XML cliente->$cliente->nome cnpj->$cliente->documento")
@push('sidbar')
    @include('adm.partial.sidbar')
@endpush
@push('navbar')
    @include('adm.partial.navbar')
@endpush
@section('conteudo')
    <div class="container-fluid py-4" style="bottom: 100px; margin-top:300px;">
        <h1 class="text-center">Aqui é onde vai ficar a pagina que vai conter o filto dos xml</h1>
    </div>
@endsection
