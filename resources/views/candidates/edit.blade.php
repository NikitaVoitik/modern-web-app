<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Candidate') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4">
                        {{ __('Candidate Information') }}
                    </h3>

                    <form method="POST" action="{{ route('candidates.update', $candidate->id) }}">
                        @csrf
                        @method('PATCH')

                        <!-- Candidate Name -->
                        <div class="mb-6">
                            <x-label for="name" :value="__('Name')" class="text-lg font-medium text-gray-800 dark:text-gray-200" />
                            <x-input id="name" class="block mt-2 w-full" type="text" name="name" value="{{ $candidate->name }}" required autofocus />
                        </div>

                        <div class="mb-6">
                            <x-label for="party" :value="__('Party')" class="text-lg font-medium text-gray-800 dark:text-gray-200" />
                            <x-input id="party" class="block mt-2 w-full" type="text" name="party" value="{{ $candidate->party }}" required :autofocus="false"/>
                        </div>

                        <!-- Elections -->
                        <div class="mb-6">
                            <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                                {{ __('Associated Elections') }}
                            </h4>
                            <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($elections as $election)
                                    <label class="block bg-gray-100 dark:bg-gray-700 rounded-lg shadow p-4">
                                        <div class="flex items-center">
                                            <input
                                                type="checkbox"
                                                name="elections[]"
                                                value="{{ $election->id }}"
                                                {{ $candidate->elections->contains($election->id) ? 'checked' : '' }}
                                                class="mr-2 rounded-md"
                                            >
                                            <span class="text-gray-800 dark:text-gray-200 p-2">
                                                <b>{{ $election->election_date }} </b> <br>
                                                Presidential Elections
                                            </span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex justify-end mt-6">
                            <x-button class="ml-4">
                                {{ __('Save Changes') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
