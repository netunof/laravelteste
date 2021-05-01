@extends('posts.layout')

@section('content')

@if ($errors->any())
<div class="min-h-screen bg-white p-4 flex items-center">
    <div class="bg-red-50 p-4 rounded flex items-start text-red-600 my-4 shadow-lg max-w-xl mx-auto">
        <div class="text-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-5 pt-1" viewBox="0 0 24 24">
                <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.597 17.954l-4.591-4.55-4.555 4.596-1.405-1.405 4.547-4.592-4.593-4.552 1.405-1.405 4.588 4.543 4.545-4.589 1.416 1.403-4.546 4.587 4.592 4.548-1.403 1.416z"/>
            </svg>
        </div>
        <div class=" px-3">
            <h3 class="text-red-800 font-semibold tracking-wider">
                Epa! Os seguintes erros foram encontrados:
            </h3>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form method="POST" action="{{ route('posts.update', $post->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="text-xl text-gray-600" for="title">Título<span class="text-red-500">*</span></label></br>
                        <input type="text" class="border-2 border-gray-300 p-2 w-full" name="title" id="title" value="{{ $post->title }}" required/>
                    </div>
                    <div class="mb-4">
                        <label class="text-xl text-gray-600" for="resumo">Resumo</label></br>
                        <input type="text" class="border-2 border-gray-300 p-2 w-full" name="resumo" id="resumo" placeholder="(Optional)"/>
                    </div>
                    <div class="mb-8">
                        <label class="text-xl text-gray-600" for="body">Corpo do texto <span class="text-red-500">*</span></label></br>
                        <textarea name="description" class="border-2 border-gray-300 p-2 w-full" id="body" required>{{ $post->description }}</textarea>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
