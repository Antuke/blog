{{-- resources/views/components/comment-form.blade.php --}}
@props(['project-id'])

{{-- Replace 'true' with your actual authentication check, e.g., @auth --}}
@if (true)
    <form action="{{ route('comments.store') }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="project_id" value="{{ $project-id }}">
        <div>
            <label for="content-{{ $project->id }}" class="sr-only">Comment</label>
            <textarea
                name="content"
                id="content-{{ $project->id }}"
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
    </p>
@endif