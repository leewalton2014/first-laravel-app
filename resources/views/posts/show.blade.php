@extends('layouts.app')

@section('content')
    
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <x-post :post="$post"/>

            @auth
            <form action="" method="post" class="mb-4">
                @csrf
                <div class="mb-4">
                    <label for="comment" class="sr-only">Comment</label>
                    <textarea name="comment" id="comment" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('comment') border-red-500 @enderror" placeholder="Leave a comment..."></textarea>

                    @error('comment')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>    
                    @enderror
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Post Comment</button>
                </div>
            </form>
            @endauth

        </div>
    </div>

@endsection