@props(['showVotes' => false, 'form' => false, 'votesMap' => [], 'candidateToElectionCandidateMap' => [], 'election'])

<div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6 p-2 overflow-visible">
    @foreach($election->candidates as $candidate)
        <x-candidates.sm-card
            :show-votes="$showVotes" :form="$form" :votes-map="$votesMap"
            :candidate-to-election-candidate-map="$candidateToElectionCandidateMap" :candidate="$candidate"
        ></x-candidates.sm-card>
    @endforeach
</div>
