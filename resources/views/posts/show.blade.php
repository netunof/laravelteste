@extends('posts.layout')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <p class="p-2 w-full text-5xl" name="title" id="title">{{ $post->title }}</p>
                    </div>
                    <div class="mb-8">
                        <p class="p-2 w-full" name="title" id="title">{{ $post->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
