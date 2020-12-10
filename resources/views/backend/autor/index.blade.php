@extends('backend.base')

@section('postscript')
<script src="{{ url('assets/backend/js/script.js?r=' . uniqid()) }}"></script>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ url()->previous() }}" class="btn btn-primary">Atras</a>
                <a href="{{ url('backend/autor/create') }}" class="btn btn-primary">Crear autor</a>
            </div>
        </div>
    </div>
</div>

@if(session()->has('op'))
<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-success" role="alert">
            Operation: {{ session()->get('op') }}. Id: {{ session()->get('id') }}. Result: {{ session()->get('r') }}
        </div>
    </div>
</div>
@endif

<table class="table table-hover">
    <thead>
        <tr>
            <th>#id</th>
            <th>nombre</th>
            <th>noticias</th>
            <th>añadir noticia</th>
            <th>show</th>
            <th>edit</th>
            <th>delete</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($autores as $autor)
        <tr>
            <td>{{ $autor->id }}</td>
            <td>{{ $autor->name }}</td>
            <td><a href="{{ url('backend/noticia/create/' . $autor->id) }}">add</a></td>
            <td><a href="{{ url('backend/autor/' . $autor->id) }}">show</a></td>
            <td><a href="{{ url('backend/autor/' . $autor->id . '/edit') }}">edit</a></td>
            <td><a href="#" data-table="autor" data-id="{{ $autor->id }}" class="enlaceBorrar" >delete</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
<form id="formDelete" action="{{ url('backend/autor') }}" method="post">
    @method('delete')
    @csrf
</form>
@endsection