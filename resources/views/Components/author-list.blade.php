{{-- resources/views/components/author-list.blade.php --}}
@props(['authors'])

<div class="mb-6">
    <p class="text-sm font-semibold text-gray-600 mb-1">Created by:</p>
    @if ($authors->isNotEmpty())
        <ul class="list-disc list-inside ml-4 text-gray-700">
            @foreach ($authors as $author)
                <li>{{ $author->name }}</li>
            @endforeach
        </ul>
    @else
        <p class="text-sm text-gray-500 italic">No authors listed.</p>
    @endif
</div>