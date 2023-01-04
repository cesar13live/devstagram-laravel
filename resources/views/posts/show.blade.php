@extends('layouts.app')

@section('title')
    {{ $post->titulo }}
@endsection

@section('content')
    <div class="container mx-auto gap-8 md:flex">
        <div class="md:w-1/2">
            <div class="bg-white rounded-t-lg p-5 flex">

                <div class="flex w-1/2 gap-2 justify-items-center">
                    <img class="rounded-full w-10 h-10" src="{{ $user->imagen ? asset('perfiles' . '/' . $user->imagen) : asset('usuario.svg')}}" alt="IMG_PP">
                    <p class="font-bold text-lg py-2">{{ $post->user->username }}</p>
                </div>

                <div class="flex-initial w-1/2 grid justify-items-end">
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                    </button>
                </div>
            </div>
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="IMG_POST">


        {{-- Ya dio like --}}
            <div class="bg-white p-3 rounded-b-lg">
                <livewire:like-post :post="$post">
                
               
                <p class="mt-5">{{ $post->descripcion }}</p>

                <div class="grid justify-items-end w-full">

                    @auth
    
                        @if ($post->user_id === auth()->user()->id)
                            <form method="POST" action="{{ route('posts.destroy', $post) }}">
                                @method('DELETE')
                                @csrf
                                <button type="submit"
                                    class="text-red-500 font-bold hover:bg-red-400 hover:rounded-lg hover:p-1 hover:text-white transition-colors cursor-pointer">Eliminar
                                    publicación</button>
                            </form>
                        @endif
    
                    @endauth
                </div>
            </div>
        </div>
    

    <div class="md:w-1/2 md:mt-5">

        <div class="shadow bg-white p-5 rounded-lg">

            @auth
                <p class="text-xl font-bold text-center mb-4">Agrega un nuevo comentario</p>
                <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user]) }}" method="POST">
                    @csrf
                    <div class="mb-5">
                        @if (session('mensaje'))
                            <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                                {{ session('mensaje') }}
                            </div>
                        @endif
                        <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">Añade un
                            comentario</label>

                        <textarea type="text" name="comentario" id="comentario"
                            class="border p-3 w-full rounded-lg shadow mb-5 @error('comentario') border-red-500 @enderror"
                            placeholder="Añade un comentario a la publicación."></textarea>
                        @error('comentario')
                            <p class="bg-red-500 text-white my-2 rounded-md text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>
                    <input type="submit" value="Comentar"
                        class=" bg-white border  hover:bg-sky-700 hover:text-white transition-colors cursor-pointer w-full uppercase font-bold rounded-lg text-black p-3 ">
                </form>
            @endauth

            @guest
                <p class="text-xl font-bold text-center mb-4">Primero necesitas iniciar sesión 😊</p>
            @endguest

        </div>

        <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10 p-5 rounded-lg">
            <p class="text-xl font-bold text-center mb-4">Todos los comentarios</p>

            <div class="flex gap-2">
                <a href="{{ route('posts.index', $post->user) }}" class="font-bold">{{ $post->user->username }}</a>
                <p>{{ $post->titulo }}</p>
            </div>

            <div class="text-gray-500 mb-5">
                <p>{{ $post->created_at->diffForHumans() }}</p>
            </div>

            <hr>
            @if ($post->comentarios->count())
                @foreach ($post->comentarios as $comentario)
                    <div class="flex gap-2">
                        <a href="{{ route('posts.index', $comentario->user) }}"
                            class="font-bold">{{ $comentario->user->username }}</a>
                        <p>{{ $comentario->comentario }}</p>
                    </div>
                    <p class="text-gray-500 text-sm mb-5">{{ $comentario->created_at->diffForHumans() }}</p>
                @endforeach
            @else
                <p class="p-10 text-center">Aún no hay comentarios</p>
            @endif

        </div>
    </div>
</div>
    
@endsection
