<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img class="w-20 h-20 " src="{{ asset('img/logo.svg')}} " alt="Logo">
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf


            <!-- Name -->
            <div class="mt-4">
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus oninput="capitalize(this)" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Phone -->
            <div class="mt-4">
                <x-label for="phone" :value="__('Phone Number')" />

                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
            </div>

            <!-- Name -->
            <div class="mt-4">
                <x-label for="username" :value="__('Username')" />

                <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>



            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('
                Confirm your password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            </div>

            <!-- Group -->
            <div class="mt-4">
                <x-label for="group_id" :value="__('Role')" />
                <select id="group_id" name="group_id" class="block mt-1 w-full" required onchange="toggleAddressField(this)">
                    <option value="" disabled selected>-- Select Role --</option>
                    @foreach($groups as $group)
                    <option value="{{ $group->id }}" data-address="{{ $group->id == 3 ? 'true' : 'false' }}">{{ $group->user_Cat }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Address -->
            <div id="addressField" class="mt-4" style="display: none;">
                <x-label for="address" :value="__('Address')" />
                <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" />
            </div>



            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-3 bg-blue-500 text-white font-bold rounded-md my-3 py-3 px-4 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:bg-blue-500 hover:scale-105 duration-300 ease-in-out">
                    {{ __('Register') }}
                </x-button>


            </div>



        </form>
    </x-auth-card>
</x-guest-layout>


<script>
    function capitalize(input) {

        let words = input.value.split(' ');


        for (let i = 0; i < words.length; i++) {
            words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1).toLowerCase();
        }


        input.value = words.join(' ');
    }
</script>

<script>
    function toggleAddressField(select) {
        var addressField = document.getElementById('addressField');
        var selectedOption = select.options[select.selectedIndex];
        var showAddress = selectedOption.getAttribute('data-address') === 'true';

        if (showAddress) {
            addressField.style.display = 'block';
        } else {
            addressField.style.display = 'none';
        }
    }
</script>