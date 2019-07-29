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
                            <a href="{{ route('roles.index') }}">Roles</a>
                        </li>
                        <li class="breadcrumb-item active">Editar</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    <a href="{{ route('roles.index') }}">Roles</a>
                </h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="col-lg-6" id="shipping">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title">Editar registro</h4>

                <div class="form-group col-md-6">
                    <label for="zip_shipping" class="form-label td-text-label">C.P.</label>
                    <input type="text" placeholder="Ingrese su código postal" name="zip_shipping" id="zip_shipping"
                        class="form-control zip-code" onkeyup="SepomexObject.searchZip('shipping')" require>
                    <input type="hidden" class="sepomex-id" name="sepomex_shipping" id="sepomex_shipping" value="">
                </div>
                <div class="form-group col-md-6">
                    <label for="state_shipping" class="form-label td-text-label">Estado</label>
                    <select class="custom-select state-data" id="state_shipping" name="state_shipping"
                        onchange="SepomexObject.getLocation('shipping', this.value);" require>
                        <option value="S" selected="">Seleccionar</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="city_shipping" class="form-label td-text-label">Municipio</label>
                    <select class="custom-select location-data" id="city_shipping" name="city_shipping"
                        onchange="SepomexObject.getColony('shipping', this.value);" disabled require>
                        <option value="S" selected="">Seleccionar</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="colony_shipping" class="form-label td-text-label">Colonia</label>
                    <select class="custom-select colony-data" id="colony_shipping" name="colony_shipping"
                        onchange="SepomexObject.getZipCode('shipping', this.value);" disabled require>
                        <option value="S" selected="">Seleccionar</option>
                    </select>
                </div>

            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div>

@endsection

@section('js')
<script type="text/javascript">
    window.onload=function() {        
        
        SepomexObject.getStates('shipping');
  };
</script>
@endsection