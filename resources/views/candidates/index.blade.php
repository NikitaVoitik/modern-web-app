<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Candidates') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @foreach ($candidates as $candidate)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <a href="{{ route('candidates.show', $candidate->id) }}">
                        <h3 class="text-lg font-semibold text-gray-800">
                            Candidate: {{ $candidate->name }}
                        </h3>
                        <p class="text-sm text-gray-500">
                            Party: {{ $candidate->party }}
                        </p>
                    </a>
                    <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($candidate->elections as $election)
                            <a href="{{ route('elections.show', $election->id) }}" class="bg-gray-100 rounded-lg shadow p-4">
                                <h5 class="font-medium text-gray-800">
                                    Election: {{ $election->id }} - Presidential
                                </h5>
                                <p class="text-sm text-gray-500">
                                    Date: {{ $election->election_date }}
                                </p>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
