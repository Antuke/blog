{{-- resources/views/components/comments-section.blade.php --}}
@props(['comments', 'commenter_id' => null])

@forelse ($comments as $comment)
    <x-comment :comment="$comment" :commenter-id="$commenter_id" />
@empty
    <p class="text-gray-500 italic">No comments yet.</p>
@endforelse