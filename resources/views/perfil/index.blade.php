@extends('layouts.app')

@section('title')
    {{ auth()->user()->username }}
@endsection

@section('content')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6 rounded-lg">
            <form action="{{ route('perfil.store') }}" method="POST" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Nombre</label>
                    <input type="text" name="username" id="username" value="{{ auth()->user()->username }}"
                        class="border p-3 w-full rounded-lg shadow mb-5 @error('name') border-red-500 @enderror"
                        placeholder="Tu nombre de usuario.">
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-md text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>


                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">Tu foto de perfil</label>
                    <input type="file" name="imagen" id="imagen" value="" accept=".jpg,.jpeg,.png"
                        class="border p-3 w-full rounded-lg shadow mb-5">
                    @error('imagen')
                        <p class="bg-red-500 text-white my-2 rounded-md text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Correo electronico</label>
                    <input type="email" name="email" id="email" value="{{ auth()->user()->email }}"
                        class="border p-3 w-full rounded-lg shadow mb-5 @error('name') border-red-500 @enderror"
                        placeholder="Tu correo electronico.">
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-md text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <hr class="mb-5">


                <div class="mb-5 text-center">
                    <p class="uppercase text-lg font-bold">cambiar contraseña</p>
                </div>


                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Contraseña</label>
                    <input type="password" name="password" id="password"
                        class="border p-3 w-full rounded-lg shadow mb-5 @error('name') border-red-500 @enderror"
                        placeholder="Tu contraseña.">
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-md text-sm p-2 text-center">{{ $message }}</p>
                    @enderror

                    @if (session('error'))
                        <p class="bg-red-500 text-white my-2 rounded-md text-sm p-2 text-center">{{ session('error') }}
                        </p>
                    @endif
                </div>

                <div class="mb-5">
                    <label for="new_password" class="mb-2 block uppercase text-gray-500 font-bold">Nueva Contraseña</label>
                    <input type="password" name="new_password" id="new_password"
                        class="border p-3 w-full rounded-lg shadow mb-5 @error('name') border-red-500 @enderror"
                        placeholder="Tu nueva contraseña.">
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-md text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>



                <input type="submit" value="Actualizar"
                    class="bg-white hover:bg-sky-500 hover:text-white outline outline-1 outline-gray-500 hover:outline-white transition-colors cursor-pointer w-full uppercase font-bold rounded-lg text-black p-3">
            </form>
        </div>
    </div>
@endsection
