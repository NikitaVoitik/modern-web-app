<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Elections') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @foreach ($elections as $election)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                            Election: {{ $election->id }} - Presidential Election
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Date: {{ $election->election_date }}
                        </p>

                        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($election->candidates as $candidate)
                                <div class="bg-gray-100 dark:bg-gray-700 rounded-lg shadow p-4">
                                    <p class="font-medium text-gray-800 dark:text-gray-100">
                                        {{ $candidate->name }}
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-300">
                                        Party: {{ $candidate->party }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
