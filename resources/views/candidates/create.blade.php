<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Candidate') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('candidates.store') }}">
                        @csrf

                        <!-- Candidate Name -->
                        <div class="mb-4">
                            <x-label for="name" :value="__('Name')" />
                            <x-input
                                id="name"
                                class="block w-full mt-1"
                                type="text"
                                name="name"
                                :value="old('name')"
                                :required="true"
                                :autofocus="true"
                            />
                        </div>

                        <!-- Party -->
                        <div class="mb-4">
                            <x-label for="party" :value="__('Party')" />
                            <x-input
                                id="party"
                                class="block w-full mt-1"
                                type="text"
                                name="party"
                                :value="old('party')"
                                :required="true"
                                :autofocus="false"
                            />
                        </div>

{{--                        <!-- Age -->--}}
{{--                        <div class="mb-4">--}}
{{--                            <x-label for="age" :value="__('Age')" />--}}
{{--                            <x-input--}}
{{--                                id="age"--}}
{{--                                class="block w-full mt-1"--}}
{{--                                type="number"--}}
{{--                                name="age"--}}
{{--                                :value="old('age')"--}}
{{--                                :required="true"--}}
{{--                                :autofocus="false"--}}
{{--                            />--}}
{{--                        </div>--}}

{{--                        <!-- Biography -->--}}
{{--                        <div class="mb-4">--}}
{{--                            <x-label for="bio" :value="__('Biography')" />--}}
{{--                            <textarea--}}
{{--                                id="bio"--}}
{{--                                name="bio"--}}
{{--                                class="block w-full mt-1 p-2 text-gray-800 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:ring-opacity-50"--}}
{{--                                rows="5"--}}
{{--                                required--}}
{{--                            >{{ old('bio') }}</textarea>--}}
{{--                        </div>--}}

                        <!-- Elections -->
                        <div class="mb-4">
                            <x-label for="elections" :value="__('Elections')" />
                            @foreach($elections as $election)
                                <div class="flex items-center mt-2">
                                    <input
                                        id="election_{{ $election->id }}"
                                        type="checkbox"
                                        name="elections[]"
                                        value="{{ $election->id }}"
                                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                                    >
                                    <label for="election_{{ $election->id }}" class="ml-2 text-gray-800 dark:text-gray-200">
                                        {{ $election->election_date }} - Presidential Elections
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-6">
                            <x-button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                                {{ __('Save') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
