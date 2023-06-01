{{-- RUTA DE LA PLANTILLA PRINCIPAL --}}
@extends("layouts.app")

{{-- NOMBRE DE LAS SECCIONES ESPECIFICAS, TITULO A MOSTRAR --}}
@section("titulo", "Área")

{{-- MUESTRA TODO EL CONTENIDO-APP --}}
@section("contenido")

<div class="card">
    <div class="card-body">
        <div id="app" class="container" v-cloak>
            <div class="columns">
                <div class="column">
                    <div class="notification">
                        <div class="columns is-vcentered">

                            <!-- Número total de ÁREAS -->
                            <div class="column">
                                @verbatim
                                <h4 class="is-size-4">Áreas ({{paginacion.total}})</h4>
                                @endverbatim
                            </div>

                            <!-- Botón de busqueda -->
                            <div class="column">
                                <div class="field has-addons">
                                    <div class="control">
                                        <input :readonly="deberiaDeshabilitarBusqueda" v-model="busqueda" @keyup="buscar()" class="input " type="text" placeholder="Buscar por nombre">
                                    </div>
                                    <div class="control">
                                        <button :disabled="deberiaDeshabilitarBusqueda || !busqueda" v-show="!this.busqueda" @click="buscar()" class="button is-info" :class="{'is-loading': buscando}">
                                            <span class="icon is-small">
                                                <i class="fa fa-search"></i>
                                            </span>
                                        </button>
                                        <!-- Bóton para limpiar la busqueda -->
                                        <button v-show="this.busqueda" @click="limpiarBusqueda()" class="button is-info" :class="{'is-loading': buscando}">
                                            <span class="icon is-small">
                                                <i class="fa fa-times"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="field is-grouped is-pulled-right">
                                    <div class="control">
                                        <a href="{{route('formularioArea')}}" class="button is-success">Agregar</a>
                                    </div>
                                    <div class="control">
                                        <a href="{{route('pdf')}}" class="button is-dark" target="_blank">Imprimir PDF</a>
                                    </div>
                                    <div class="control">
                                        @verbatim
                                        <!-- El atributo "v-show" determina si el botón debe mostrarse o no -->
                                        <transition name="bounce">
                                            <button @click="eliminarMarcadas()" v-show="numeroDeElementosMarcados > 0" class="button is-warning" :class="{'is-loading': cargando.eliminandoMuchos}">
                                                Eliminar ({{numeroDeElementosMarcados}})
                                            </button>
                                        </transition>
                                        @endverbatim
                                    </div>
                                </div>
                                &nbsp;
                            </div>
                        </div>
                    </div>
                    <!-- Se muestra si, se demora al cargar -->
                    <div v-show="cargando.lista" class="notification is-info has-text-centered">
                        <h3 class="is-size-3">Cargando</h3>
                        <div>
                            <h1 class="icono-gigante">
                                <i class="fa-light fa-spinner"></i>
                            </h1>
                        </div>
                        <p class="is-size-5">
                            Por favor, espera un momento
                        </p>
                    </div>
                    <transition name="fade">
                        <div v-show="areas.length <= 0 && !busqueda && !cargando.lista" class="notification is-info has-text-centered">
                            <h3 class="is-size-3">No hay áreas</h3>
                            <div>
                                <h1 class="icono-gigante">
                                    <i class="fas fa-box-open"></i>
                                </h1>
                            </div>
                        </div>
                    </transition>
                    <transition name="fade">
                        <div v-show="areas.length <= 0 && busqueda && !cargando.lista" class="notification is-warning has-text-centered">
                            <h3 class="is-size-3"> No hay resultados que coincidan con tu búsqueda</h3>
                            <div>
                                <h1 class="icono-gigante">
                                    <i class="fas fa-search"></i>
                                </h1>
                            </div>
                        </div>
                    </transition>
                    @include("errores")
                    @include("notificacion")
                    <div>

                        <!-- v-show determina si la tabla debe mostrarse o no, basada en dos condiciones.  -->
                        <!-- La 1º condición es areas > 0 la tabla se mostrará y 2º Si se carga el área -->
                        <table v-show="areas.length > 0 && !cargando.lista" class="table is-bordered is-striped is-hoverable is-fullwidth">
                            <thead>
                                <tr>
                                    <th>
                                        <button @click="onBotonParaMarcarClickeado()" class="button" :class="{'is-info': numeroDeElementosMarcados > 0}">
                                            <span class="icon is-small">
                                                <i class="fa fa-check"></i>
                                            </span>
                                        </button>
                                    </th>
                                    <th>Área</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @verbatim
                                <tr v-for="area in areas">
                                    <td>
                                        <button @click="invertirEstado(area)" class="button" :class="{'is-info': area.marcada}">
                                            <span class="icon is-small">
                                                <i class="fa fa-check"></i>
                                            </span>
                                        </button>
                                    </td>
                                    <td>{{area.nombre}}</td>
                                    <td>
                                        <button @click="editar(area)" class="button is-warning">
                                            <span class="icon is-small">
                                                <i class="fa fa-edit"></i>
                                            </span>
                                        </button>
                                    </td>
                                    <td>
                                        <button @click="eliminar(area)" class="button is-danger" :class="{'is-loading': area.eliminando}">
                                            <span class="icon is-small">
                                                <i class="fa fa-trash"></i>
                                            </span>
                                        </button>
                                    </td>
                                </tr>
                                @endverbatim
                            </tbody>
                        </table>
                        <!-- Contenedor de navegación (barra de paginación) -->
                        <nav v-show="paginacion.ultima > 1" class="pagination" role="navigation" aria-label="pagination">
                            <a :disabled="!puedeRetrocederPaginacion()" @click="retrocederPaginacion()" class="pagination-previous">Anterior</a>
                            <a :disabled="!puedeAvanzarPaginacion()" @click="avanzarPaginacion()" class="pagination-next">Siguiente página</a>
                            @verbatim
                            <ul class="pagination-list">
                                <li v-for="pagina in paginas">
                                    <a v-if="!pagina.puntosSuspensivos" @click="irALaPagina(pagina.numero)" class="pagination-link" :class="{'is-current':pagina.numero === paginacion.actual}">{{pagina.numero}}</a>
                                    <span class="pagination-ellipsis" v-else>&hellip;</span>
                                </li>
                            </ul>
                            @endverbatim
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{url('/js/areas.js?q=') . time()}}"></script>
    </div>
</div>

@endsection