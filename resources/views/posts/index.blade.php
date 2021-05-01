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
                    <a class="text-white rounded-md bg-green-500 p-2 px-4 cursor-pointer" id="btnCreate"
                        data-attr="{{ route('posts.create') }}" title="Criar"> Nova Publicação
                    </a>
                </div>

                <div class="bg-white shadow-md rounded my-6">
                    <table class="table-auto">
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
                            @foreach ($data as $key => $value)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                {{-- ID --}}
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        {{ $value->id }}
                                    </div>
                                </td>
                                {{-- TÍTULO --}}
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        {{ $value->title }}
                                    </div>
                                </td>
                                {{-- RESUMO --}}
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center">
                                        {{ \Str::limit($value->description, 100) }}
                                    </div>
                                </td>
                                {{-- AÇÕES --}}
                                <td class="py-3 px-6 text-center">
                                    <form action="{{ route('posts.destroy',$value->id) }}" method="POST">
                                        <div class="flex item-center justify-center">
                                            {{-- MOSTRAR --}}
                                            <a id="btnShow" class="cursor-pointer"
                                                data-attr="{{ route('posts.show',$value->id) }}">
                                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </div>
                                            </a>
                                            {{-- EDITAR --}}
                                            <a id="btnEditL" class="cursor-pointer"
                                                data-attr="{{ route('posts.edit',$value->id) }}">
                                                <div class="w-4 mr-2 transform hover:text-green-500 hover:scale-110">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </div>
                                            </a>
                                            {{-- APAGAR --}}
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Tem certeza que deseja apagar o post?')">
                                                <div class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </div>
                                            </button>
                                        </div>
                                    </form>
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
        {!! $data->links() !!}
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
                            <button class="hidden text-base flex justify-center px-4 py-2 rounded font-bold cursor-pointer bg-green-600 text-white border" id="btnStore">
                                <div class="flex leading-5">Salvar</div>
                            </button>
                            <button class="hidden text-base flex justify-center px-4 py-2 rounded font-bold cursor-pointer bg-yellow-600 text-white border" id="btnEdit">
                                <div class="flex leading-5">Editar</div>
                            </button>
                            <button class="hidden text-base flex justify-center px-4 py-2 rounded font-bold cursor-pointer bg-red-600 text-white border" id="btnDelete">
                                <div class="flex leading-5">Apagar</div>
                            </button>
                            <button class="text-base flex justify-center px-4 py-2 rounded font-bold cursor-pointer bg-gray-100 text-black border" id="btnFechar">
                                <div class="flex leading-5">Fechar</div>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- modal --}}

</div>
<script>
    //criando uma função pra cada botão, futuramente implementar uma lógica mais simples e menos verbosa
    $(document).on('click', '#btnCreate', function(event) {
        event.preventDefault();//eu previno o comportamento padrão das tags, por exemplo <a> não vai direcionar pro link
        let href = $(this).attr('data-attr'); //.attr pega qualquer elemento data-algumaCoisa, que no caso é uma URL
        //ajax abre uma requisição para a URL oferecida e renderiza ela no success
        $.ajax({//$ é sinônimo de jQuery, ou seja, jQuery.ajax
        //url recebe uma string como argumento, eis uma penca de argumentos pra função
        //ajax é assíncrono por padrão
            url: href,
            beforeSend: function() {//é chamada antes da requisição, se retornar falso cancela a requisição do ajax
                $('#loader').show();
            },
            // return the result
            success: function(result) { //função intermediária que recebe qualquer coisa como parâmetro, só é acionada se a requisição funcionar
                $('#modalForm').show(); //jQuery(pega algum elemento da página).mostraOElemento()
                $('#btnStore').show();
                $('#corpoForm').html(result).show(); //renderiza a URL neste elemento da página
            },
            complete: function() { //é chamada depois de error e success
                $('#loader').hide();
            },
            error: function(jqXHR, testStatus, error) { //retorna o erro caso a requisição não aconteça
                console.log(error);
                alert("Page " + href + " cannot open. Error:" + error);
                $('#loader').hide();
            },
            timeout: 8000 //define o tempo limite para a resquisição, se passar 8 segundos a função é cancelada
        }) //fim do ajax e dos seus parâmtros de configuração
    });
    //editar ícone
    $(document).on('click', '#btnEditL', function(event) {
        event.preventDefault();
        let href = $(this).attr('data-attr');
        $.ajax({
            url: href,
            beforeSend: function() {
                $('#loader').show();
            },
            success: function(result) {
                $('#modalForm').show();
                $('#btnStore').show();
                $('#btnEdit').hide();
                $('#btnDelete').hide();
                $('#corpoForm').html(result).show();
            },
            complete: function() {
                $('#loader').hide();
            },
            error: function(jqXHR, testStatus, error) {
                console.log(error);
                alert("Page " + href + " cannot open. Error:" + error);
                $('#loader').hide();
            },
            timeout: 8000
        })
    });
    //editar botão
    $(document).on('click', '#btnEdit', function(event) {
        event.preventDefault();
        let href = $(this).attr('data-attr');
        $.ajax({
            url: href,
            beforeSend: function() {
                $('#loader').show();
            },
            success: function(result) {
                $('#modalForm').show();
                $('#btnStore').show();
                $('#btnEdit').hide();
                $('#btnDelete').hide();
                $('#corpoForm').html(result).show();
            },
            complete: function() {
                $('#loader').hide();
            },
            error: function(jqXHR, testStatus, error) {
                console.log(error);
                alert("Page " + href + " cannot open. Error:" + error);
                $('#loader').hide();
            },
            timeout: 8000
        })
    });
    //mostrar
    $(document).on('click', '#btnShow', function(event) {
        event.preventDefault();
        let href = $(this).attr('data-attr');
        $.ajax({
            url: href,
            beforeSend: function() {
                $('#loader').show();
            },
            success: function(result) {
                $('#modalForm').show();
                $('#btnStore').hide();
                $('#btnEdit').show();
                $('#btnDelete').show();
                $('#corpoForm').html(result).show();
            },
            complete: function() {
                $('#loader').hide();
            },
            error: function(jqXHR, testStatus, error) {
                console.log(error);
                alert("Page " + href + " cannot open. Error:" + error);
                $('#loader').hide();
            },
            timeout: 8000
        })
    });
    $(document).on('click', '#btnFechar', function () {
        $('#modalForm').hide();
    });
</script>
@endsection
