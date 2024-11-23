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
                    <div class="flex space-x-4 mt-6">
                        <!-- Edit Button -->
                        <a href="{{ route('elections.edit', $election->id) }}"
                           class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg shadow hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 transition ease-in-out duration-150">
                            {{ __('Edit') }}
                        </a>

                        <!-- Remove Button -->
                        <form action="{{ route('elections.destroy', $election->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this election? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-lg shadow hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 transition ease-in-out duration-150">
                                {{ __('Remove') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Candidates Section -->
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-2 overflow-visible">
                @foreach($election->candidates as $candidate)
                    <a href="{{ route('candidates.show', $candidate->id) }}" class="bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                        <div class="p-6">
                            <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                                {{ $candidate->name }}
                            </h4>
                            <p class="mt-2 text-gray-600 dark:text-gray-400">
                                <span class="font-medium">Party:</span> {{ $candidate->party }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
