@extends('layouts.panel')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css" integrity="sha512-mEMf5CzqpAD5pib4wjOK3Z6mg01wTESCVyP9o8mmvbEMXuccXvideThJ4k18zih4dzkbEwsc+K8LkGTKjmVVjQ==" crossorigin="anonymous" />
@endsection

@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
        <div class="col">
            <h3 class="mb-0">Editar Médico</h3>
        </div>
        <div class="col text-right">
            <a href="{{ url('doctors') }}" class="btn btn-sm btn-default">
                Cancelar y volver
            </a>
        </div>
        </div>
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ url('doctors/'.$doctor->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nombre del Médico</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $doctor->name) }}" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="text" name="email" class="form-control" value="{{ old('email', $doctor->email) }}">
            </div>
            <div class="form-group">
                <label for="dni">DNI</label>
                <input type="text" name="dni" class="form-control" value="{{ old('dni', $doctor->dni) }}">
            </div>
            <div class="form-group">
                <label for="address">Dirección</label>
                <input type="text" name="address" class="form-control" value="{{ old('address', $doctor->address) }}">
            </div>
            <div class="form-group">
                <label for="phone">Teléfono / Móvil</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $doctor->phone) }}">
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="text" name="password" class="form-control" value="">
                <p>Ingrese un valor solo si desea modificar la contraseña</p>
            </div>
            <div class="form-group">
                <label for="specialties">Especialidades</label>
                <select name="specialties[]" id="specialties" class="form-control selectpicker" data-style="btn-default" multiple title="Seleccione una o varias">
                @foreach($specialties as $specialty)
                    <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                @endforeach
                </select>
            </div>
            <button class="btn btn-primary" type="submit">
                Guardar
            </button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js" integrity="sha512-Fa6GAsxM3xf/SiRja5rpvyhVcSbfbeSrCC68nNboPhd3TjCrBq+h7+GUHNhn2v+QEmZMQlU6mnT+5EyhBvPdHw==" crossorigin="anonymous"></script>
<script>
    $(document).ready(() => {
        $('#specialties').selectpicker('val', @json($specialty_ids));
    });
</script>
@endsection