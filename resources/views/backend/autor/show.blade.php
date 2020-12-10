@extends('backend.base')

@section('postscript')
<script src="{{ url('assets/backend/js/script.js?r=' . uniqid()) }}"></script>
@endsection

@section('content')
<form id="formDelete" action="{{ url('backend/autor/' . $autor->id) }}" method="post">
    @method('delete')
    @csrf
</form>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ url()->previous() }}" class="btn btn-primary">Atras</a>
                <a href="{{ url('backend/autor') }}" class="btn btn-primary">Autores</a>
                <a href="{{ url('backend/autor/create') }}" class="btn btn-primary">Create enterprise</a>
                <a href="#" data-table="autor" data-id="{{ $autor->id }}" data-name="{{ $autor->name }}" class="btn btn-danger" id="enlaceBorrar">Borrar autor</a>
                <a href="{{ url('backend/autor/' . $autor->id . '/edit') }}" class="btn btn-primary">Editar autor</a>
                <a href="{{ url('backend/noticia/' . $autor->id . '/noticias') }}" class="btn btn-primary">Ver noticias autor</a>
            </div>
        </div>
    </div>
</div>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Campo</th>
            <th scope="col">Valor</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Nombre</td>
            <td>{{$autor->name}}</td>
        </tr>
    </tbody>
</table>
@endsection