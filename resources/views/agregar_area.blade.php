@extends("layouts.app")
@section("titulo", "ÁREA")
@section("contenido")

<div class="card">
    <div class="card-body">
        <div class="columns">
            <div class="column is-half-tablet">
                <h1 class="is-size-1">Agregar área</h1>
                <form method="POST" action="{{route("guardarArea")}}">
                    @csrf
                    <div class="field">
                        <label class="label">Nombre</label>
                        <div class="control">
                            <input autocomplete="off" name="nombre" class="input" type="text" placeholder="Nombre de área">
                        </div>
                    </div>
                    @include("errores")
                    @include("notificacion")
                    <button class="button is-success">Guardar</button>
                    <a class="button is-primary" href="{{route("areas")}}">Ver todas</a>
                </form>
                <br>
            </div>
        </div>
    </div>
</div>


@endsection