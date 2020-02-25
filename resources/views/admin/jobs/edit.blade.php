@extends('admin.master.master')

@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-user-plus">Editar Vaga</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="">Dashboard</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="">Vagas</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="" class="text-orange">Editar Vaga</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <div class="dash_content_app_box">
            <div class="nav">
                <form class="app_form" action="{{ route('admin.jobs.update' , ['uuid' => $job->uuid]) }}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="nav_tabs_content">
                        <div id="data">
                            <label class="label">
                                <span class="legend">*Empresa:</span>
                                <input type="text" name="company" placeholder="Nome da Empresa"
                                       value="{{ old('company') ?? $job->company }}"/>
                            </label>

                            <label class="label">
                                <span class="legend">*Título:</span>
                                <input type="text" name="title" placeholder="Título da Vaga"
                                       value="{{ old('title') ?? $job->title }}"/>
                            </label>

                            <label class="label">
                                <span class="legend">*Descrição:</span>
                                <textarea rows="4" cols="160" name="description" id="description">{{ old('description') ?? $job->description }}</textarea>
                            </label>

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">*Status:</span>
                                    <select name="status">
                                        <option
                                            value="active" {{ (old('status') == 'active' ? 'selected' : ($job->status == 'active' ? 'selected' : '')) }}>
                                            Ativa
                                        </option>
                                        <option
                                            value="inactive" {{ (old('status') == 'inactive' ? 'selected' : ($job->status == 'inactive' ? 'selected' : '')) }}>
                                            Inativa
                                        </option>
                                    </select>
                                </label>

                                <label class="label">
                                    <span class="legend">*Salário (Em dólar americano):</span>
                                    <input type="tel" name="salary" class="mask-money"
                                           placeholder="Valores em Dólar (USD)"
                                           value="{{ old('salary') ?? $job->salary }}"/>
                                </label>
                            </div>

                            <label class="label">
                                <span class="legend">*Endereço:</span>
                                <input type="text" name="workplace" placeholder="Endereço da Vaga"
                                       value="{{ old('workplace') ?? $job->workplace }}"/>
                            </label>

                            <label class="label">
                                <span class="legend">*Contato:</span>
                                <input type="text" name="contact" placeholder="Email de Contato"
                                       value="{{ old('contact') ?? $job->contact }}"/>
                            </label>
                        </div>
                    </div>
                    <div class="text-right mt-2">
                        <button class="btn btn-large btn-green icon-check-square-o" type="submit">Salvar Alterações
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
