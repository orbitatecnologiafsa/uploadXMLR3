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
    @if ($ultimo_up != '')
        <div class="container-fluid py-4">
            <h4 class="text-white">Ultima atualização {{ date('d/m/Y H:i:s',strtotime($ultimo_up)) }}</h4>
        </div>
    @endif
    <div class="container-fluid py-4" style="bottom: 300px;">
        <form method="get" action="{{ route('adm-busca-cliente-files-pasta', $cliente->documento . '/') }}">
            <div class="card" style="margin-top: 100px;">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">Baixar xml {{ $cliente->nome }} , CNPJ -> {{ $cliente->documento }}
                        </h6>
                    </div>
                </div>
                <div class="col-md-5 pb-0 p-3">
                    @if ($download == '')
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-3">

                                <select class="form-control" id="" name="busca_pasta">
                                    @foreach ($pastas as $pasta)
                                        <option value="{{ $pasta }}">{{ $pasta }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    @else
                        <h6 class="mb-2"> Xml gerado {{ request()->input('busca_pasta') . '.zip' }}
                        </h6>
                    @endif
                    @error('cliente')
                        <div class="error " style="color:red">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-5 pb-0 p-3 me-2">
                    <div class="form-group">
                        @if ($download != '')
                            <a href="{{ $download }}" class="btn btn-info  active" id="btn-download">
                                Baixar xml</a>
                            <a href="{{ route('adm-busca-cliente-files', $cliente->documento) }}"
                                class="btn btn-warning  active">
                                Gerar novo xml</a>
                        @else
                            <button class=" btn btn-primary  active">Gerar xml</button>
                        @endif





                    </div>
                </div>
            </div>
        </form>
    </div>

    @include('tamplate.footer')

    </div>
@endsection
