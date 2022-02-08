@extends('layouts.app')

@section('content')
    
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            
            <div class="mb-4 bg-gray-300 px-2 py-2 rounded-lg shadow ">
                <div>
                    <h1 class="font-medium text-2xl">{{ $user->name }}</h1>
                    <span class="mb-2 text-gray-600">{{"@"}}{{ $user->username }}</span>

                    @auth
                    @if (!$user->followedBy(auth()->user()) && $user->id !== auth()->user()->id)
                        <form action="{{ route('users.follows', $user) }}" method="post" class="mr-2 mb-2">
                            @csrf
                            <button type="submit" class="mt-2 px-5 font-semibold rounded-md bg-blue-500 text-white p-2">Follow</button>
                        </form>

                    @elseif ($user->followedBy(auth()->user()) && $user->id !== auth()->user()->id)
                        <form action="{{ route('users.unfollows', $user) }}" method="post" class="mr-2 mb-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="mt-2 px-5 font-semibold rounded-md bg-red-500 text-white p-2">Unfollow</button>
                        </form>
                    @endif
                    @endauth
                    
                    <p class="mb-2 text-gray-600">{{ $user->follows()->count() }} {{ Str::plural('Follower', $user->follows()->count()) }}</p>

                    <p>Posted {{ $posts->count() }} {{ Str::plural('Post', $posts->count()) }}</p>
                    <p>Received {{ $user->receivedLikes->count() }} {{ Str::plural('Like', $user->receivedLikes->count()) }}</p>
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