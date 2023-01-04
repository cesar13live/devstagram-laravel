@extends('layouts.app')

@section('title')
    Crear una nueva publicación
@endsection

{{-- Para mostrar en paginas en especifico, para js y css --}}
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush


@section('content')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <form action="{{ route('imagenes.store') }}" method="POST" enctype="multipart/form-data" id="dropzone"
                class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
                @csrf
            </form>
        </div>

        <div class="md:w-1/2 px-10 bg-white shadow-lg p-10 rounded-md mt-10 md:mt-0">
            <form action="{{ route('posts.store') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">Titulo</label>
                    <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}"
                        class="border p-3 w-full rounded-lg shadow mb-5 @error('titulo') border-red-500 @enderror"
                        placeholder="Titulo de la publicación.">
                    @error('titulo')
                        <p class="bg-red-500 text-white my-2 rounded-md text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">Descripción</label>
                    <textarea type="text" name="descripcion" id="descripcion"
                        class="border p-3 w-full rounded-lg shadow mb-5 @error('descripcion') border-red-500 @enderror"
                        placeholder="Descripción de la publicación.">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <p class="bg-red-500 text-white my-2 rounded-md text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input 
                        name="imagen"
                        type="hidden"
                        value="{{ old('imagen') }}"
                    />
                    @error('imagen')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }} </p>
                    @enderror
                </div>
                
                <input type="submit" value="Subir publicación"
                    class="bg-sky-500 hover:bg-sky-700 transition-colors cursor-pointer w-full uppercase font-bold rounded-lg text-white p-3">
            </form>

        </div>
    </div>
@endsection
