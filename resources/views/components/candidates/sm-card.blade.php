@props(['showVotes' => false, 'form' => false, 'votesMap' => [], 'candidateToElectionCandidateMap' => [], 'candidate'])

<a href="{!! route('candidates.show', $candidate->id) !!}"
   class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
    <div class="p-4 flex items-center">
        @if($form)
            <x-candidates.checkbox :id="$candidateToElectionCandidateMap[$candidate->id]"></x-candidates.checkbox>
        @endif
        <x-candidates.info :show-votes="$showVotes" :votes-map="$votesMap" :candidate="$candidate"></x-candidates.info>
    </div>
</a>
