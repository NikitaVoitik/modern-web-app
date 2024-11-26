<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Elections') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @foreach ($elections as $election)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <a href="{{ route('elections.show', $election->id) }}">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                            Election: {{ $election->id }} - Presidential Election
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Date: {{ $election->election_date }}
                        </p>
                    </a>
                    <form action="{{ route('vote.store') }}" method="POST" class="mt-4">
                        @csrf
                        <input type="hidden" name="election_id" value="{{ $election->id }}">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-gray-500">
                            @foreach($election->candidates as $candidate)
                                <div class="bg-gray-100 shadow p-4
                                @if($votedMap[$election->id] == $candidate->id)
                                    bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-lg shadow-lg
                                @endif
                                flex items-center ">
                                    <a href="{{ route('candidates.show', $candidate->id) }}" class="flex-1">
                                        <p class="font-medium @if($votedMap[$election->id] == $candidate->id) text-white @else text-gray-800 @endif">
                                            {{ $candidate->name }}
                                        </p>
                                        <p class="text-sm">
                                            Party: {{ $candidate->party }}
                                        </p>
                                        <p class="text-sm">
                                            Votes: {{ $votesMap[$candidate->id] ?? 0 }}
                                        </p>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>

<script>
    function handleCheckboxClick(clickedCheckbox) {
        const checkboxes = document.querySelectorAll('input[name="candidate_checkbox"]');
        checkboxes.forEach(checkbox => {
            if (checkbox !== clickedCheckbox) {
                clickedCheckbox.checked = !clickedCheckbox.checked;
            }
        });
    }
</script>
