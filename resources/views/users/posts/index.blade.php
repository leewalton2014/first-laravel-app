@extends('layouts.app')

@section('content')
    
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            
            <div class="mb-4 bg-gray-300 px-2 py-2 rounded-lg shadow ">
                <div>
                    <h1 class="font-medium text-2xl">{{ $user->name }}</h1>
                    <span class="mb-2 text-gray-600">{{"@"}}{{ $user->username }}</span>
                    <p>Posted {{ $posts->count() }} {{ Str::plural('Post', $posts->count()) }}</p>
                    <p>Received {{ $user->receivedLikes->count() }} Likes</p>
                </div>
            </div>

            @if($posts->count())
                @foreach ($posts as $post)
                    <x-post :post="$post"/>
                @endforeach

                {{ $posts->links('pagination::tailwind') }}
            @else
                <p>{{ $user->name }} does not have any posts.</p>
            @endif

        </div>
    </div>

@endsection