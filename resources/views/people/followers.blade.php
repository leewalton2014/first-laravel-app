@extends('layouts.app')

@section('content')

    <div class="flex justify-center">

        <div class="w-8/12 bg-white p-6 rounded-lg">
            <a href="{{ route('users.posts', $user) }}" class="mt-2 px-5 font-semibold rounded-md bg-blue-500 text-white p-2 mb-5">{{$user->username}}'s Profile</a>

            <h1 class="font-medium text-2xl mb-3 mt-3">Followers of {{"@"}}{{$user->username}}</h1>

            @if($users->count())
                @foreach ($users as $user)
                    <x-user :user="$user"/>
                @endforeach

                {{ $users->links('pagination::tailwind') }}
            @else
                <p>There are no followers.</p>
            @endif

        </div>
    </div>

@endsection
