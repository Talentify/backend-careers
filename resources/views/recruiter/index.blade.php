@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Lista de {{ $details['title']['plural'] }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 pb-1">
                            <a href="{{ route($details['route'].'.create') }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i> Adicionar
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table table-sm table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#COD</th>
                                <th scope="col">Recrutador</th>
                                <th scope="col">E-mail</th>
                                <th scope="col" style="width: 70px;"></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($datas as $data)
                            <tr>
                                <th scope="row">#{{ str_pad($data['id'], 5, "0", STR_PAD_LEFT) }}</th>
                                <td>{{$data['name']}}</td>
                                <td>{{$data['email']}}</td>
                                <td>
                                    <a href="{{ route($details['route'].'.show', $data['id']) }}" class="btn btn-xs text-success btn-box-tool p-0">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{ route($details['route'].'.edit', $data['id']) }}" class="btn btn-xs text-primary btn-box-tool p-0">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </a>
                                    <form action="{{ route($details['route'].'.destroy', $data['id']) }}" method="POST" style="float:right; vertical-align: middle;">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-xs text-danger p-0">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
