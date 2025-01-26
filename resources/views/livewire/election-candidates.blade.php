<div wire:poll.5s class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 p-2 overflow-visible">
    @foreach($election->candidates as $candidate)
        <a href="{{ route('candidates.show', $candidate->id) }}"
           class="rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300
           {{ $candidate->id === $votedFor ? 'bg-gradient-to-r from-blue-500 to-indigo-500 rounded-lg shadow-lg text-white' : 'bg-white text-gray-600' }}">
            <div class="p-4">
                <h4 class="text-xl font-semibold {{ $candidate->id === $votedFor ? 'text-white' : 'text-gray-800' }} text-nowrap overflow-ellipsis overflow-hidden">
                    {{ $candidate->name }}
                </h4>
                <p class="mt-2">
                    <span class="font-medium">Party:</span> {{ $candidate->party }}

                    <br>
                    <span class="font-medium">Votes:</span>  {{ $votesMap[$candidate->id] ?? 0 }}
                </p>
            </div>
        </a>
    @endforeach
</div>
