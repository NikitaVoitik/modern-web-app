@php use Illuminate\Contracts\Auth\MustVerifyEmail; @endphp
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 ">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 ">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>


    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')


        <div class="flex flex-col items-center space-y-4">
            <!-- Profile Image Preview -->
            <div class="relative">
                <img id="profile-image-preview"
                     class="w-32 h-32 rounded-full shadow-lg border-2 border-gray-300 object-cover"
                     src="{{ asset('storage/images/' . Auth::user()->image) }}"
                     alt="Profile Image">
                <label for="image-upload"
                       class="absolute bottom-0 right-0 bg-blue-500 text-white p-2 rounded-full cursor-pointer shadow-lg hover:bg-blue-600 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M4 3a1 1 0 000 2h12a1 1 0 100-2H4zM3 8a1 1 0 011-1h12a1 1 0 011 1v7a1 1 0 01-1 1H4a1 1 0 01-1-1V8zm8 4a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </label>
                <input id="image-upload" type="file" name="image" class="hidden" accept="image/*">
            </div>
        </div>

        <script>
            // JavaScript for image preview
            document.getElementById('image-upload').addEventListener('change', function (event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        document.getElementById('profile-image-preview').src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        </script>


        {{--        <div>--}}
{{--            <x-input-label for="name" :value="__('name')"/>--}}
{{--            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"--}}
{{--                          :value="old('first_name', $user->first_name)" required autocomplete="given-name"/>--}}
{{--            <x-input-error class="mt-2" :messages="$errors->get('name')"/>--}}
{{--        </div>--}}

        <div>
            <x-input-label for="first_name" :value="__('First Name')"/>
            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full"
                          :value="old('first_name', $user->first_name)" required autocomplete="given-name"/>
            <x-input-error class="mt-2" :messages="$errors->get('first_name')"/>
        </div>

        <div>
            <x-input-label for="last_name" :value="__('Last Name')"/>
            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full"
                          :value="old('last_name', $user->last_name)" required autocomplete="family-name"/>
            <x-input-error class="mt-2" :messages="$errors->get('last_name')"/>
        </div>

        <div>
            <x-input-label for="passport_number" :value="__('Passport Number')"/>
            <x-text-input id="passport_number" name="passport_number" type="text" class="mt-1 block w-full"
                          :value="old('passport_number', $user->passport_number)" required
                          autocomplete="passport-number"/>
            <x-input-error class="mt-2" :messages="$errors->get('passport_number')"/>
        </div>

        <div>
            <x-input-label for="date_of_birth" :value="__('Date of Birth')"/>
            <x-text-input id="date_of_birth" name="date_of_birth" type="date" class="mt-1 block w-full"
                          :value="old('date_of_birth', $user->date_of_birth)" required autocomplete="bday"/>
            <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')"/>
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')"/>
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                          :value="old('email', $user->email)" required autocomplete="username"/>
            <x-input-error class="mt-2" :messages="$errors->get('email')"/>

            @if ($user instanceof MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 ">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                                class="underline text-sm text-gray-600  hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 ">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 "
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
