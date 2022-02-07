@props(['post' => $post])
<div class="mb-4 bg-gray-100 px-2 py-2 rounded-lg shadow">

    <a href="{{ route('users.posts', $post->user) }}" class="font-bold">{{ $post->user->name }}</a> <span class="text-gray-600">{{ $post->created_at->diffForHumans() }}</span>
    <p class="mb-2">{{ $post->body }}</p>

    <div class="flex items-center">
        @auth
        @if (!$post->likedBy(auth()->user()))
            <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-2">
                @csrf
                <button type="submit" class="text-blue-500">Like</button>
            </form>
        @else
            <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-blue-500">Unlike</button>
            </form>
        @endif
        @endauth

        <span>{{ $post->likes->count() }} {{ Str::plural('Like', $post->likes->count()) }}</span>
    </div>
    
    @can('destroy', $post)
    <div class="mt-2">
        <form action="{{ route('posts.destroy', $post) }}" method="post" class="mr-2">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500">Delete</button>
        </form>
    </div>
    @endcan

    <div class="flex items-center mt-3">
        <a href="{{ route('posts.show', $post) }}" class="h-10 px-5 font-semibold rounded-md bg-blue-300 text-white p-2">Comment</a>
    </div>

</div>