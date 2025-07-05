<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Project Showcase</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script> 
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans antialiased">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">University Project Showcase</h1>

        <div x-data="{
                selectedProjectId: {{ $projects->first()?->id ?? 'null' }},
                toggleProject(id) {
                    this.selectedProjectId = id;
                }
            }" 
            class="flex flex-col md:flex-row gap-8" 
            x-cloak>
            
            <!-- Sidebar -->
            <aside class="w-full md:w-1/4 lg:w-1/5 flex-shrink-0 bg-white p-4 rounded shadow self-start">
                <!-- Profile Section -->
                <div class="flex flex-col items-center mb-6">
                    <img src="{{ asset('images/profile.jpg') }}" 
                        alt="Antonio Profile Picture"
                        class="w-24 h-24 rounded-full object-cover mb-4 border-2 border-gray-300 shadow-sm">

                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Antonio</h3>

                    <!-- Contact Links -->
                    <ul class="text-sm text-gray-600 space-y-2 text-center">
                        <li>
                            <a href="mailto:your.email@example.com" class="hover:text-blue-600 hover:underline flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span>your.email@example.com</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://linkedin.com/in/yourprofile" target="_blank" rel="noopener noreferrer"
                                class="hover:text-blue-600 hover:underline flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                    viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                </svg>
                                <span>LinkedIn Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://github.com/yourusername" target="_blank" rel="noopener noreferrer"
                                class="hover:text-blue-600 hover:underline flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                    viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                                </svg>
                                <span>GitHub Profile</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <hr class="my-6 border-gray-300">

                <!-- Project Navigation -->
                <nav>
                    <h2 class="text-xl font-semibold mb-4 text-gray-700 text-center md:text-left">Projects</h2>
                    @if ($projects->isNotEmpty())
                        <ul class="space-y-2">
                            @foreach ($projects as $project)
                                <li>
                                    <button 
                                        @click="toggleProject({{ $project->id }})"
                                        :class="{
                                            'bg-blue-600 text-white hover:bg-blue-700': selectedProjectId === {{ $project->id }},
                                            'bg-gray-200 text-gray-700 hover:bg-gray-300': selectedProjectId !== {{ $project->id }}
                                        }"
                                        class="w-full text-left px-4 py-2 rounded transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-400"
                                        aria-selected="selectedProjectId === {{ $project->id }}">
                                        {{ $project->name }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500">No projects yet.</p>
                    @endif
                </nav>
            </aside>

            <!-- Main Content Area -->
            <main class="w-full md:w-3/4 lg:w-4/5 bg-white p-6 rounded shadow min-h-[300px]">
                @if ($projects->isNotEmpty())
                    @foreach ($projects as $project)
                        <div 
                            x-show="selectedProjectId === {{ $project->id }}" 
                            class="space-y-4"
                            x-cloak>
                            <h2 class="text-2xl font-bold text-gray-800">{{ $project->name }}</h2>
                            
                            <div class="prose max-w-none text-gray-700">
                                {!! nl2br(e($project->description)) !!}
                            </div>

                            <!-- Comments Section -->
                            <div class="mt-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">Comments</h3>
                                @forelse($project->comments as $comment)
                                    <div class="border rounded p-3 mb-3 bg-gray-50">
                                        <p class="text-sm text-gray-700 break-words">
                                            <strong>{{ $comment->commenter->name ?? 'Anonymous' }}</strong>:
                                            {{ $comment->content }}
                                        </p>
                                        @if ($commenter_id && $commenter_id == $comment->commenter_id)
                                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="text-gray-400 hover:text-red-600 focus:outline-none focus:text-red-600 transition duration-150 ease-in-out"
                                                        title="Delete comment"
                                                        onclick="return confirm('Are you sure you want to delete this comment?');">
                                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                    <span class="sr-only">Delete comment</span>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                @empty
                                    <p class="text-sm text-gray-500">No comments yet.</p>
                                @endforelse
                            </div>

                            <!-- Comment Form -->
                            @if (session('commenter_id'))
                                <form method="POST" action="{{ route('comments.store') }}" class="mt-4">
                                    @csrf
                                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                                    <textarea 
                                        name="content" 
                                        required 
                                        class="w-full border rounded p-2 mb-2" 
                                        placeholder="Leave a comment..."
                                        aria-label="Comment text"></textarea>
                                    <button 
                                        type="submit"
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">
                                        Submit Comment
                                    </button>
                                </form>
                            @else
                                <div class="mt-4">
                                    <p class="text-sm text-gray-600 mb-2">Autentificati per lasciare un commento.</p>
                                
                                    <a href="{{ route('login.google', 'google') }}"
                                       class="inline-flex items-center justify-center
                                         px-4 py-2
                                         border border-gray-300
                                         rounded-md
                                         shadow-sm
                                         text-sm font-medium
                                         text-gray-700
                                         bg-white
                                         hover:bg-gray-50
                                         focus:outline-none
                                         focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                
                                        <!-- Google Icon SVG -->
                                        <svg class="w-5 h-5 mr-3 -ml-1" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="google" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                                            <path fill="#4285F4" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path>
                                            <path fill="#FBBC05" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path>
                                            <path fill="#34A853" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path>
                                            <path fill="#EA4335" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571l6.19,5.238C39.999,35.081,44,30.011,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path>
                                        </svg>
                                
                                        Sign in with Google
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endforeach

                    <!-- Message if no project is selected -->
                    <div 
                        x-show="selectedProjectId === null" 
                        class="text-gray-500 text-center py-10"
                        x-cloak>
                        Please select a project from the sidebar.
                    </div>
                @else
                    <!-- Message shown if the $projects collection is empty -->
                    <div class="text-center text-gray-500 py-10">
                        <p>No projects have been added yet. Check back later!</p>
                    </div>
                @endif
            </main>
        </div>
    </div>

    @if (session()->has('commenter_id'))
        <form method="POST" action="{{ route('logout') }}" class="fixed bottom-6 right-6">
            @csrf
            <button 
                type="submit"
                class="bg-red-500 hover:bg-red-600 text-white rounded-full w-12 h-12 flex items-center justify-center shadow-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-red-400"
                aria-label="Logout">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </button>
        </form>
    @endif
</body>
</html>