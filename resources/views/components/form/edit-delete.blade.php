@props([
    'editRoute',
    'deleteRoute',
])

@if(auth()->user()->isAdmin())
    <div class="flex space-x-4 p-2">
        <a href="{{ $editRoute }}"
           class="p-6 px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg shadow hover:bg-blue-700  dark:hover:bg-blue-600 transition ease-in-out duration-150">
            {{ __('Edit') }}
        </a>

        <form action="{{ $deleteRoute }}" method="POST" onsubmit="return confirm('Are you sure?');">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-lg shadow hover:bg-red-700  dark:hover:bg-red-600 transition ease-in-out duration-150">
                {{ __('Remove') }}
            </button>
        </form>
    </div>
@endif
