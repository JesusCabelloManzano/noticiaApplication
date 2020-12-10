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
                <a href="{{ url('backend/autor/create') }}" class="btn btn-primary">Crear autor</a>
                <a href="#" data-table="autor" data-id="{{ $autor->id }}" data-name="{{ $autor->name }}" class="btn btn-danger" id="enlaceBorrar">Borrar autor</a>
                <a href="{{ url('backend/noticia/' . $autor->id . '/noticias') }}" class="btn btn-primary">Ver noticias autor</a>
            </div>
        </div>
    </div>
</div>
@if(session()->has('error'))
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-danger" role="alert">
                <h2>Error ...</h2>
            </div>
        </div>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ url('backend/autor/' . $autor->id) }}" method="post" id="editAutorForm" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="card-body">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            @error('nombre')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="text" maxlength="60" minlength="2" required class="form-control" id="name" placeholder="Nombre autor" name="nombre" value="{{ old('nombre', $autor->name) }}">
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endsection