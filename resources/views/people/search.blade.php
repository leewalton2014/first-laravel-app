@extends('layouts.app')

@section('content')

    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">

            @auth
            <form action="{{ route('people.search') }}" method="post" class="mb-4">
                @csrf
                <div class="mb-4">
                    <label for="search" class="sr-only">Search</label>
                    <textarea name="search" id="search" cols="30" rows="1" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('search') border-red-500 @enderror" placeholder="Type a name to start searching for a username...">@if ($term){{ $term }}@endif</textarea>

                    @error('search')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Search Users</button>
                </div>
            </form>
            @endauth

            @if($users->count())
                @foreach ($users as $user)
                    <x-user :user="$user"/>
                @endforeach

                {{ $users->links('pagination::tailwind') }}
            @else
                <p>There are no people.</p>
            @endif

        </div>
    </div>

@endsection
