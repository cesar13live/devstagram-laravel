@extends('layouts.app')

@section('title')
    Registrate ahora!
@endsection

@section('content')
    <div class="flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/registrar.jpg') }}" alt="IMG-REGISTER">
        </div>

        <div class="md:w-4/12 bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('register') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">Nombre</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="border p-3 w-full rounded-lg shadow mb-5 @error('name') border-red-500 @enderror"
                        placeholder="Tu nombre completo.">
                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-md text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Usuario</label>
                    <input type="text" name="username" id="username" value="{{ old('username') }}" class="@error('username') border-red-500 @enderror border p-3 w-full rounded-lg shadow"
                        placeholder="Tu nombre de usuario.">
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-md text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="@error('email') border-red-500 @enderror border p-3 w-full rounded-lg shadow"
                        placeholder="Tu correo electrónico.">
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-md text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Contraseña</label>
                    <input type="password" name="password" id="password" class="@error('password') border-red-500 @enderror border p-3 w-full rounded-lg shadow"
                        placeholder="Tu contraseña.">
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-md text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Confirmar
                        Contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="border p-3 w-full rounded-lg shadow" placeholder="Escribe de nuevo tu contraseña.">
                </div>

                <input type="submit" value="Crear cuenta"
                    class="bg-sky-500 hover:bg-sky-700 transition-colors cursor-pointer w-full uppercase font-bold rounded-lg text-white p-3">
            </form>
        </div>
    </div>
@endsection
