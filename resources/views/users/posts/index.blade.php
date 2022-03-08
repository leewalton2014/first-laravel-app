@extends('layouts.app')

@section('content')

    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">

            <x-user :user="$user"/>

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
