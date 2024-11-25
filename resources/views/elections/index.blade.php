<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Elections') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @foreach ($elections as $election)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <a href="{{ route('elections.show', $election->id) }}">
                        <h3 class="text-lg font-semibold text-gray-800 ">
                            Election: {{ $election->id }} - Presidential Election
                        </h3>
                        <p class="text-sm text-gray-500">
                            Date: {{ $election->election_date }}
                        </p>
                    </a>
                    <x-candidates.list :election="$election"/>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
