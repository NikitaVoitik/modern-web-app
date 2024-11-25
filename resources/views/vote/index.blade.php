<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Live Elections') }}
        </h2>
    </x-slot>
    @foreach($elections as $election)
        <div class="py-12">
            <form action="{{ route('vote.store') }}" method="POST">
                @csrf
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
                                    class="px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded-lg shadow hover:bg-green-700 transition ease-in-out duration-150">
                                {{ __('Vote') }}
                            </button>
                        </div>
                    </div>

                    <x-candidates.list :form="true" :election="$election" :candidateToElectionCandidateMap="$candidateToElectionCandidateMap"/>
                </div>
            </form>
        </div>
    @endforeach
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
