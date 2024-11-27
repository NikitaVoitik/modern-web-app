<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            {{ __('Live Elections') }}
        </h2>
    </x-slot>
    @foreach($elections as $election)
        <div class="py-12">
            <form action="{{ route('vote.store') }}" method="POST">
                @csrf
                <input type="text" name="election_id" class="hidden" value="{{ $election->id }}">
                <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-lg shadow-lg">
                        <div class="p-8">
                            <h3 class="text-2xl font-bold">
                                Election: {{ $election->id }}
                            </h3>
                            <p class="mt-4">
                                Type: Presidential Election
                            </p>
                            <p class="mt-4">
                                <span class="font-medium">Date:</span> {{ $election->election_date }}
                            </p>
                            <button type="submit"
                                    class="m-2 px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded-lg shadow hover:bg-green-700  dark:hover:bg-green-600 transition ease-in-out duration-150">
                                {{ __('Vote') }}
                            </button>
                            <div class="alert alert-danger text-red-600">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Candidates Section -->
                    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-2 overflow-visible">
                        @foreach($election->candidates as $candidate)
                            <a href="{{ route('candidates.show', $candidate->id) }}"
                               class="bg-white  rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                                <div class="p-6 flex items-center">
                                    <input
                                        type="checkbox"
                                        name="candidate_checkbox"
                                        value="{{ $candidateToElectionCandidateMap[$candidate->id] }}"
                                        class="mr-2 rounded-md"
                                        onclick="handleCheckboxClick(this)"
                                    >
                                    <div>
                                        <h4 class="text-xl font-semibold text-gray-800 ">
                                            {{ $candidate->name }}
                                        </h4>
                                        <p class="mt-2 text-gray-600 ">
                                            <span class="font-medium">Party:</span> {{ $candidate->party }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </form>
        </div>
    @endforeach
    @if ($errors->any())
@endif
</x-app-layout>

<script>
    function handleCheckboxClick(clickedCheckbox) {
        const checkboxes = document.querySelectorAll('input[name="candidate_checkbox"]');
        checkboxes.forEach(checkbox => {
            if (checkbox !== clickedCheckbox) {
                checkbox.checked = false;
            }
        });
    }
</script>
