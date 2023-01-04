@extends('layouts.app')

@section('title')
    {{ $user->username }}
@endsection

@section('content')
    <div class="flex justify-center">

        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img class="rounded-full"
                    src="{{ $user->imagen ? asset('perfiles' . '/' . $user->imagen) : asset('usuario.svg') }}"
                    alt="IMAGEN_USUARIO">
            </div>

            <div class="md:8-/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center py-10 md:py-10 md:items-start">

                <div class="flex mb-5 gap-5">
                    <p class="text-gray-800 text-2xl font-bold">{{ $user->name }}</p>
                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a href="{{ route('perfil.index') }}"><button
                                    class="outline outline-offset-2 outline-1 rounded-sm px-2 font-bold hover:text-sky-500 hover:outline-blue-500">Editar
                                    Perfil</button></a>
                        @endif

                    @endauth
                </div>
                <p class="text-gray-800 text-sm mb-3 font-bold">{{$user->MyFollowers()->count()}}  <span>@choice('Seguidor | Seguidores',$user->MyFollowers()->count())</span></p>

                <p class="text-gray-800 text-sm mb-3 font-bold">{{$user->ImFollowing()->count()}}  <span>Siguiendo</span></p>

                <p class="text-gray-800 text-sm mb-3 font-bold">{{ $user->posts->count() }} <span>Publicaciones</span></p>

                @auth
                    @if ($user->id !== auth()->user()->id)
                        @if (!$user->following(auth()->user()))
                            <form action="{{ route('users.follow', $user) }}" method="post">
                                @csrf
                                <input type="submit"
                                    class="bg-white outline outline-1 rounded-sm font-bold py-1 px-3 cursor-pointer"
                                    value="Seguir">
                            </form>
                        @else
                            <form action="{{ route('users.unfollow', $user) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="submit"
                                    class="bg-white outline outline-1 rounded-sm text-base font-bold py-1 px-3 cursor-pointer"
                                    value="Siguiendo">
                            </form>
                        @endif
                    @endif

                @endauth

            </div>
        </div>
    </div>


    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>

        @if ($posts->count())

                 <x-listar-post :posts="$posts" />

            <div class="mt-5">
                {{ $posts->links('pagination::tailwind') }}
            </div>
        @else
            <p class="text-gray-600 uppercase text-sm text-center font-bold">No hay publicaciones</p>
        @endif

    </section>
@endsection
