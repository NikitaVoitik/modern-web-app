@props(['$showVotes' => false, 'votesMap' => [], 'candidate'])

<div>
    <h4 class="text-xl font-semibold text-gray-800">
        {{ $candidate->name }}
    </h4>
    <p class="mt-2 text-gray-600">
        <span class="font-medium">Party:</span> {{ $candidate->party }}
    </p>
    @if($showVotes)
        <p class="text-sm text-gray-500">
            Votes: {{ $votesMap[$candidate->id] ?? 0 }}
        </p>
    @endif
</div>
