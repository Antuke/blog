{{-- resources/views/components/comment.blade.php --}}
@props(['comment', 'commenter_id' => null])


<div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-4 shadow-sm">
    <p class="text-gray-800 mb-2">{{ $comment->content }}</p>

    <div class="flex items-center justify-between">
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
                        onclick="return confirm('Are you sure you want to delete this comment?');">
                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <span class="sr-only">Delete comment</span>
                </button>
            </form>
        @endif
    </div>
</div>