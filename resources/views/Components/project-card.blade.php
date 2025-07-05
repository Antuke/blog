{{-- resources/views/components/project-card.blade.php --}}
@props(['project', 'commenter_id' => null])

<div class="mb-12 bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-3xl font-bold mb-2 text-gray-900">{{ $project->name }}</h1>
    <p class="text-gray-700 mb-4">{{ $project->description }}</p>

    <x-author-list :authors="$project->authors" />

    <div class="mt-8">
        <h3 class="text-xl font-semibold mb-4 text-gray-800">Comments</h3>
        <x-comment-section :comments="$project->comments" :commenter-id="$commenter_id" />
    </div>

    <div class="mt-8 pt-6 border-t border-gray-200">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Leave a Comment</h2>
        <x-comment-form :project-id="$project->id" />
    </div>
</div>