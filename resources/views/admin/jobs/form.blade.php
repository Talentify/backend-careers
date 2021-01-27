@extends('admin.layout')

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('assets/js/admin/jobs/form.js') }}"></script>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Inserir/editar vagas</h1>
    </div>

    <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Informações da vaga</h4>
        <form action=".{{$job ? '/'.$job['id'] : '/'}}" method="{{$job ? 'PUT' : 'POST'}}" id="job-form">
            <div class="row g-3">
                <div class="col-12">
                    <label for="title" class="form-label">Título</label>
                    <input name="title" type="text" class="form-control" id="title" value="{{$job ? $job['title'] : ''}}" required>
                </div>

                <div class="col-12">
                    <label for="lastName" class="form-label">Descrição</label>
                    <textarea name="description" class="form-control" id="lastName" rows="5" required>{{$job ? $job['description'] : ''}}</textarea>
                </div>

                <div class="col-12">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" class="form-select" id="status">
                        <option value="1" selected>Aberta</option>
                        <option value="0" {{$job && $job['status'] == 0 ? 'selected' : ''}}>Fechada</option>
                    </select>
                </div>

                <div class="col-12">
                    <label for="workplace" class="form-label">Endereço <span class="text-muted">(Opcional)</span></label>
                    <input name="workplace" type="text" class="form-control" id="workplace" placeholder="São Paulo, SP" value="{{$job ? $job['workplace'] : ''}}">
                </div>

                <div class="col-12">
                    <label for="salary" class="form-label">Salário <span class="text-muted">(Opcional)</span></label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input name="salary" type="text" value="{{$job ? $job['salary'] : ''}}" class="form-control" id="salary">
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <button class="w-100 btn btn-primary btn-lg" type="submit">Salvar</button>
        </form>
    </div>
</main>

<script>
    $(function() {
        $('#salary').maskMoney();
    })
</script>

@stop