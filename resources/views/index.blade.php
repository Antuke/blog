{{-- resources/views/projects/index.blade.php --}}
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
        <x-project-card :project="$project" :commenter-id="$commenter_id" ?? null />
    @empty
        <p class="text-center text-gray-500 text-xl">No projects found.</p>
    @endforelse
</div>

<x-logout-button />

</body>
</html>