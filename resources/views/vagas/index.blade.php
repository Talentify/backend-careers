
@extends('layout')

@section('cabecalho')
<h1>Vagas</h1>
@endsection

@section('conteudo')
    @include('mensagem', ['mensagem' => $mensagem])

    <a href="{{ route('vagas.create') }}" class="btn btn-dark ml-2 mb-3" >Adicinar</a>
    <ul class="list-group">
        @forelse( $vagas AS $vaga )
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span id="nome-vaga-{{$vaga->id}}">{{$vaga->titulo}} -- {{$vaga->descricao}}</span>
                <div class="input-group w-50" hidden id="input-nome-vaga-{{$vaga->id}}">
                    <form method="post" action="/vagas/{{$vaga->id}}/edit">
                        <div class="d-flex input-group-append">
                            <input type="text" name="nome" class="form-control" value="{{$vaga->titulo}}">
                            @csrf
                            @method("GET")
                            <button class="btn btn-primary">Edite</button>
                        </div>
                    </form>
                </div>
                <span class="d-flex">
                    @auth
                        <button style="height:32px" class="btn btn-info btn-sm mr-1" onclick="toggleInput({{$vaga->id}})" >Ed</button>
                    @endauth
                    <form method="post" action="/vagas/{{$vaga->id}}">
                    <a href="/vagas/{{ $vaga->id }}/vaga" class="btn btn-info btn-sm">Vis</a>
                        @csrf
                        @method("delete")
                        @auth
                            <button class="btn btn-danger btn-sm" >Ex</button>
                        @endauth
                    </form>
                </span>
            </li>
        @empty
            Não existe vaga!!!
        @endforelse
    </ul>
<script>
    function toggleInput( vagaId ) {
        const nomeVagaEl =  document.getElementById('nome-vaga-' + vagaId);
        const inputVagaEl = document.getElementById('input-nome-vaga-' + vagaId);
        if (nomeVagaEl.hasAttribute('hidden')){
            nomeVagaEl.removeAttribute('hidden');
            inputVagaEl.hidden = true;
        } else {
            inputVagaEl.removeAttribute('hidden');
            nomeVagaEl.hidden = true;
        }
    }

    function editarVaga( vagaId ) {
        let formdata = new FormData();
        const titulo  = document.querySelector(`#input-nome-vaga-${vagaId} > input`).value;
        const token = document.querySelector('input[name="_token"]').value;
        const url   = `/vagas/${vagaId}/edit`;
        formdata.append('titulo', titulo );
        formdata.append('_token', token );
        fetch( url, {
            body: formdata,
            method: 'OPTIONS'
        });
        /*$.ajax({
            method: "POST",
            url: url,
            data: { _token: token, titulo: titulo }
        });
        */
    }
</script>
@endsection

