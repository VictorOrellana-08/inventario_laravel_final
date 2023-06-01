<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @extends("layouts.app")
    @section("titulo", "Principal")
    @section("contenido")
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 style="color: red; font-size: 24px;">BIENVENIDOS/AS - Control de Inventario </h1>
                    <br>
                    <img src="assets/lista.png" alt="..." width="200px" height="200px">
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>