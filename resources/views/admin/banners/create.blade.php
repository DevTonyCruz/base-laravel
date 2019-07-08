@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ url('admin/banners') }}">Banners</a>
                    </li>
                    <li class="breadcrumb-item active">Agregar</li>
                </ol>
            </div>
            <h4 class="page-title">
                <a href="{{ url('admin/banners') }}">Banners</a>
            </h4>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">

            <h4 class="header-title"><i class="mdi mdi-plus mr-1"></i>Agregar</h4>

            <form class="form-horizontal" action="{{ url('admin/banners/') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf
                <div class="form-group row mb-3">
                    <label for="title" class="col-3 col-form-label">Titulo</label>
                    <div class="col-9">
                        <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" id="title" name="title" placeholder="Ingrese el titulo del banner" value="{{ old('title') }}" required>
                        @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="subtitle" class="col-3 col-form-label">Sub Titulo</label>
                    <div class="col-9">
                        <input type="text" class="form-control{{ $errors->has('subtitle') ? ' is-invalid' : '' }}" id="subtitle" name="subtitle" placeholder="Ingrese el subtitulo del banner" value="{{ old('subtitle') }}" required>
                        @if ($errors->has('subtitle'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('subtitle') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="description" class="col-3 col-form-label">Descripción</label>
                    <div class="col-9">
                        <textarea type="text" class="form-control wyswyg-content{{ $errors->has('description') ? ' is-invalid' : '' }}" id="description" name="description" placeholder="Ingrese una descripción">{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="imput_files_id" class="col-3 col-form-label">Imagen</label>
                    <div class="col-9">
                        <div class="custom-file">
                            <input type="file" id="file" name="file" class="custom-file-input form-control {{ $errors->has('file') ? ' is-invalid' : '' }}" accept="image/x-png,image/gif,image/jpeg">
                            @if ($errors->has('file'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('file') }}</strong>
                                </span>
                            @endif
                            <label class="custom-file-label" id="file-label">
                                Elige un archivo
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-0 justify-content-end row">
                    <div class="col-9">
                        <button type="submit" class="btn btn-info">Guardar</button>
                    </div>
                </div>
            </form>

        </div>  <!-- end card-body -->
    </div>  <!-- end card -->
</div>
@endsection

@section('pagecss')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
@endsection

@section('pagescript')
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js" defer></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js" defer></script>
<script type="text/javascript" defer>
    $(document).ready(function() {
        $('.wyswyg-content').summernote({
            height: 150,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline']],
                ['font', ['strikethrough']],
                ['fontsize', ['fontsize']],
                ['color', ['color']]
            ]
        });
    });
</script>

@endsection
