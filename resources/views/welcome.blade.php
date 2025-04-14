<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
    <script src="https://cdn.tailwindcss.com"></script> 
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

<div class="container mx-auto px-4 py-8">

    @forelse ($projects as $project)
        <div class="mb-12 bg-white p-6 rounded-lg shadow-md">

            <h1 class="text-3xl font-bold mb-2 text-gray-900">{{ $project->name }}</h1>
            <p class="text-gray-700 mb-4">{{ $project->description }}</p>

            {{-- Authors Section --}}
            <div class="mb-6">
                <p class="text-sm font-semibold text-gray-600 mb-1">Created by:</p>
                @if ($project->authors->isNotEmpty())
                    <ul class="list-disc list-inside ml-4 text-gray-700">
                        @foreach ($project->authors as $author)
                            <li>{{ $author->name }}</li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-sm text-gray-500 italic">No authors listed.</p>
                @endif
            </div>

            {{-- Comments Section --}}
            <div class="mt-8">
                <h3 class="text-xl font-semibold mb-4 text-gray-800">Comments</h3>
                @forelse ($project->comments as $comment)
                    {{-- Comment Card --}}
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-4 shadow-sm">
                    <p class="text-gray-800 mb-2">{{ $comment->content }}</p>

                    {{-- Commenter Info and Delete Button Container --}}
                    {{-- Use flex to align items horizontally and justify-between to push them apart --}}
                    <div class="flex items-center justify-between">
                        {{-- Commenter Info --}}
                        <p class="text-sm text-gray-600 italic">
                            Commented by: <span class="font-medium not-italic">{{ $comment->commenter->name }}</span>
                            - <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                        </p>

                        @if ($commenter_id && $commenter_id == $comment->commenter_id)
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-gray-400 hover:text-red-600 focus:outline-none focus:text-red-600 transition duration-150 ease-in-out"
                                        title="Delete comment"
                                        {{-- Optional: Add confirmation --}}
                                        onclick="return confirm('Are you sure you want to delete this comment?');">
                                    {{-- Heroicons Trash SVG (adjust size w- h- if needed) --}}
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="sr-only">Delete comment</span> {{-- For screen readers --}}
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
                @empty
                    <p class="text-gray-500 italic">No comments yet.</p>
                @endforelse
            </div>

            {{-- Leave Comment Section --}}
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Leave a Comment</h2>

                {{-- Replace 'true' with your actual authentication check, e.g., @auth --}}
                @if (true)
                    <form action="{{ route('comments.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        <div>
                            <label for="content-{{ $project->id }}" class="sr-only">Comment</label> {{-- Screen reader label --}}
                            <textarea
                                name="content"
                                id="content-{{ $project->id }}" {{-- Unique ID per project form --}}
                                class="block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out sm:text-sm"
                                rows="4"
                                placeholder="Write your comment here..."
                                required></textarea>
                        </div>
                        <button
                            type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Submit Comment
                        </button>
                    </form>
                @else
                    <p class="text-gray-600">
                        Please <a href="{{-- route('login') --}}" class="text-blue-600 hover:underline font-medium">login</a> to leave a comment.
                        {{-- Optionally add your Google Login link here --}}
                        {{-- <a href="/login/google" class="text-blue-600 hover:underline font-medium">login with Google</a> --}}
                    </p>
                @endif
            </div>

        </div> {{-- End Project Wrapper --}}

        {{-- Separator between projects - removed <hr>, using margin bottom on the wrapper instead --}}

    @empty
        <p class="text-center text-gray-500 text-xl">No projects found.</p>
    @endforelse

</div> {{-- End Container --}}


@if(session()->has('commenter_id'))
    <form method="POST" action="{{ route('logout') }}" class="fixed bottom-6 right-6">
        @csrf
        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white rounded-full w-12 h-12 flex items-center justify-center shadow-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-red-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
        </button>
    </form>
@endif



</body>
</html>