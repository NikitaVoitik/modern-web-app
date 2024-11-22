<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Election Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Election Card -->
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
                </div>
            </div>

            <!-- Candidates Section -->
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-2 overflow-visible">
                @foreach($election->candidates as $candidate)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                        <div class="p-6">
                            <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                                {{ $candidate->name }}
                            </h4>
                            <p class="mt-2 text-gray-600 dark:text-gray-400">
                                <span class="font-medium">Party:</span> {{ $candidate->party }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
