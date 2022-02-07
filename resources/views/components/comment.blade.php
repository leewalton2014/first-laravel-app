@props(['comment' => $comment])
<div class="mb-4 bg-gray-50 px-2 py-2 rounded-lg shadow-sm">

    <a href="{{ route('users.posts', $comment->user) }}" class="font-bold">{{ $comment->user->name }}</a> <span class="text-gray-600">{{ $comment->created_at->diffForHumans() }}</span>
    <p class="mb-2">{{ $comment->comment_body }}</p>
    
    @can('destroy', $comment)
    <div class="mt-2">
        <form action="{{ route('comments.destroy', $comment) }}" method="post" class="mr-2">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500">Delete</button>
        </form>
    </div>
    @endcan

</div>