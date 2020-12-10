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
                <a href="{{ url('backend/autor') }}" class="btn btn-primary">Autores</a>
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
<!-- mostrar todos los errores juntos -->
{{--@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif--}}
<form action="{{ url('backend/autor') }}" method="post" id="createAutorForm">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            @error('nombre')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="text" maxlength="60" minlength="2" required class="form-control" id="nombre" placeholder="Nombre autor" name="nombre" value="{{ old('nombre') }}">
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endsection