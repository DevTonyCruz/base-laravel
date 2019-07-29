@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">
    <!-- start page title -->

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('admin/profile') }}">Perfil</a>
                        </li>
                        <li class="breadcrumb-item active">Principal</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    <a href="{{ url('admin/profile') }}">Perfil</a>
                </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <!-- Profile -->
            <div class="card bg-primary">
                <div class="card-body profile-user-box">

                    <div class="row">
                        <div class="col-sm-8">
                            <div class="media">
                                <span class="float-left m-2 mr-4"><img src="{{ asset('admin/images/user.png') }}"
                                        style="height: 100px;" alt="" class="rounded-circle img-thumbnail"></span>
                                <div class="media-body">

                                    <h4 class="mt-1 mb-1 text-white">{{ Auth::user()->name }}</h4>
                                    <p class="font-13 text-white-50">{{ Auth::user()->rol->name }}</p>

                                    <ul class="mb-0 list-inline text-light">
                                        <li class="list-inline-item mr-3">
                                            <h5 class="mb-1">{{ substr(Auth::user()->created_at, 0, 10) }}</h5>
                                            <p class="mb-0 font-13 text-white-50">Fecha de registro</p>
                                        </li>
                                        <li class="list-inline-item">
                                            <h5 class="mb-1">{{ substr(Auth::user()->updated_at, 0, 10) }}</h5>
                                            <p class="mb-0 font-13 text-white-50">Última actualización</p>
                                        </li>
                                    </ul>
                                </div> <!-- end media-body-->
                            </div>
                        </div> <!-- end col-->

                        <div class="col-sm-4">
                            <div class="text-center mt-sm-0 mt-3 text-sm-right">
                                <button type="button" class="btn btn-light">
                                    <i class="mdi mdi-account-edit mr-1"></i> Editar Perfil
                                </button>
                            </div>
                        </div> <!-- end col-->
                    </div> <!-- end row -->

                </div> <!-- end card-body/ profile-user-box-->
            </div>
            <!--end profile/ card -->
        </div> <!-- end col-->
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0 mb-3">Información general</h4>
                    <p class="text-muted font-13">
                        A continuación se muestra un informe resumido de la información de usuario
                    </p>

                    <hr>

                    <div class="text-left">
                        <p class="text-muted"><strong>Nombre :</strong> <span class="ml-2">{{  Auth::user()->name }}</span></p>

                        <p class="text-muted"><strong>Email :</strong> <span class="ml-2">{{  Auth::user()->email }}</span></p>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection