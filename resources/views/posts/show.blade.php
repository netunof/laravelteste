@extends('posts.layout')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{-- o input hidden tem que aparecer no mostrar pra poder habilitar o update --}}
                    <input type="hidden" name="idPost" value="{{ $post->id }}">
                    <div class="mb-4">
                        <p class="p-2 w-full text-5xl" id="titulo">{{ $post->titulo }}</p>
                    </div>
                    <div class="mb-8">
                        <p class="p-2 w-full" id="resumo">{{ $post->corpo }}</p>
                    </div>
                    <div class="flex m-2 gap-4">
                        <button class="text-base flex justify-center px-4 py-2 rounded font-bold cursor-pointer bg-yellow-600 text-white border" type="button" id="btnEditar">
                            <div class="flex leading-5">Editar</div>
                        </button>
                        <button class="text-base flex justify-center px-4 py-2 rounded font-bold cursor-pointer bg-red-600 text-white border" type="button" id="btnApagar">
                            <div class="flex leading-5">Apagar</div>
                        </button>
                        <button class="text-base flex justify-center px-4 py-2 rounded font-bold cursor-pointer bg-gray-100 text-black border" type="reset" id="btnFechar">
                            <div class="flex leading-5">Fechar</div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
