@extends('posts.layout')

@section('content')
<div class="grid">
    <!-- component -->
    <div class="overflow-x-auto">
        <div class="h-auto w-auto py-20 bg-gray-100 flex items-center justify-center bg-gray-100 font-sans overflow-hidden">
            <div class="w-full sm:w-5/6">
                <div class="w-full text-5xl text-center mb-5">
                    Publicações
                </div>
                <div>
                    <a class="text-white rounded-md bg-green-500 p-2 px-4 cursor-pointer" onclick="modalForm()">
                        Nova Publicação
                    </a>
                </div>

                <div class="bg-white shadow-md rounded my-6">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">ID</th>
                                <th class="py-3 px-6 text-left">Título</th>
                                <th class="py-3 px-6 text-center">Resumo</th>
                                <th class="py-3 px-6 text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            {{-- POSTS --}}
                            @foreach ($posts as $post)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                {{-- ID --}}
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        {{ $post->id }}
                                    </div>
                                </td>
                                {{-- TÍTULO --}}
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        {{ $post->titulo }}
                                    </div>
                                </td>
                                {{-- RESUMO --}}
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center">
                                        {{ ($post->resumo) }}
                                    </div>
                                </td>
                                {{-- AÇÕES --}}
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        {{-- MOSTRAR --}}
                                        <a id="btnMostrar" class="cursor-pointer" onclick="mostrar({{$post->id}})">
                                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </div>
                                        </a>
                                        {{-- EDITAR --}}
                                        <a id="btnEditar" class="cursor-pointer" onclick="editar({{$post->id}})">
                                            <div class="w-4 mr-2 transform hover:text-green-500 hover:scale-110">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </div>
                                        </a>
                                        {{-- APAGAR --}}
                                        <a id="btnApagar" class="cursor-pointer" onclick="apagar({{$post->id}})">
                                            <div class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            {{-- POSTS --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-gray-100">
        {!! $posts->links() !!}
    </div>


    {{-- modal --}}
    <div class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="modalForm">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" >
                <div id="corpoForm">

                </div>
                <div class="p-5">
                    <div class="flex justify-center items-baseline flex-wrap">
                        <div class="flex m-2 gap-4">

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- modal --}}
</div>
<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    //Renderiza formulário no modal
    function modalForm() {
        $.ajax({
            type: "GET",
            url: "{{ route('posts.create') }}",
            success: function (response) {
                $('#modalForm').show();
                $('#corpoForm').html(response);
            }
        });
    }
    //CREATE
    function criar() {
        $.ajax({
            data: {
                "_token": "{{ csrf_token() }}",
                titulo: $('#titulo').val(),
                resumo: $('#resumo').val(),
                corpo: $('#corpo').val(),
            },
            type: "POST",
            dataType: "json",
            url: "{{ route('posts.store') }}",
            success: function (response) {
                alert("Post criado!");
                $('#formCriar').trigger("reset");
                $('#modalForm').hide();
                location.reload();
            },
            error: function (jqXHR,error) {
                console.log(jqXHR.responseText); //eu dou uma mensagem de erro inteligível
            }
        });
    }
    //READ
    function mostrar(id) {
        $.ajax({
            type: "GET",
            url: "posts/"+id,
            data: id,
            success: function (response) {
                $('#modalForm').show();
                $('#corpoForm').html(response);
            }
        });
    }
    //EDIT
    function editar(id) { //esta função por hora é desnecessária pois já existe um formulário sendo submetido na view edit e sendo validado no back
        $.ajax({
            method: 'GET',
            url: '/posts/'+id+'/edit',
            data: id,
            success: function(response) {
                $('#modalForm').show();
                $('#corpoForm').html(response);
            }
        });
    }
    //UPDATE
    function atualizar(id) {
        $.ajax({
            data: {
                "_token": "{{ csrf_token() }}",
                titulo: $('#titulo').val(),
                resumo: $('#resumo').val(),
                corpo: $('#corpo').val(),
                id,
                _method: 'PUT'
            },
            type: "POST",
            dataType: "json",
            url: "/posts/"+id,
            success: function (response) {
                alert("Post atualizado!");
                $('#formCriar').trigger("reset");
                $('#modalForm').hide();
                location.reload();
            },
            error: function (jqXHR,error) {
                console.log(jqXHR.responseText);
            }
        });
    }
    //DELETE
    function apagar(id) {
        if(confirm("Deseja apagar o post?") == true){
            $.ajax({
                headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
                method: 'POST',
                url: "posts/"+id,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                    _method: 'DELETE'
                },
                success: function(result) {
                    location.reload();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(jqXHR.responseText);
                }
            });
        }
    }



    $(document).on('click', '#btnFechar', function () {
        $('#modalForm').hide();
    });
</script>
@endsection
