@extends('layouts.app')

@section('title')
    Iniciar Sesión en Devstagram!
@endsection

@section('content')
    <div class="flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/login.jpg') }}" alt="IMG-LOGIN">
        </div>

        <div class="md:w-4/12 bg-white shadow-md rounded-lg p-6">
            <form method="POST" action="{{route('login')}}" novalidate>
                @csrf

                @if (session('mensaje'))
                <p class="bg-red-500 text-white my-2 rounded-md text-sm p-2 text-center">{{ session('mensaje') }}</p>
                @endif

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="@error('email') border-red-500 @enderror border p-3 w-full rounded-lg shadow"
                        placeholder="Tu correo electrónico.">
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-md text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Contraseña</label>
                    <input type="password" name="password" id="password"
                        class="@error('password') border-red-500 @enderror border p-3 w-full rounded-lg shadow"
                        placeholder="Tu contraseña.">
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-md text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-5">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember" class="text-base text-gray-700">Recordar mi sesión</label>
                </div>

                <input type="submit" value="Login"
                    class="bg-sky-500 hover:bg-sky-700 transition-colors cursor-pointer w-full uppercase font-bold rounded-lg text-white p-3">
            </form>
        </div>
    </div>
@endsection
