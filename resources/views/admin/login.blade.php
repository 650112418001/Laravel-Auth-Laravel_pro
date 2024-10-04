<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
    <style>
        .error-message {
            color: #ff0000; /* Red color for error messages */
            font-weight: bold;
            margin-bottom: 10px;
        }
        .success-message {
            color: #008000; /* Green color for success messages */
            font-weight: bold;
            margin-bottom: 10px;
        }

    </style>
</head>
<body>
    <x-guest-layout>
        <h2 style="color: white; font-weight: bold; text-align: center; font-size:25px;">Admin Login</h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        @if(Session::has('success'))
            <div class="success-message">
                <li>{{ Session::get('success') }}</li>
            </div>
        @endif


        <form method="POST" action="{{ route('admin_login_submit') }}">
            @csrf

            <!-- Admin Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>


            @if($errors->any())
                <div class="error-message">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            @endif

            @if(Session::has('error'))
                <div class="error-message">
                    <li>{{ Session::get('error') }}</li>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('admin_forget_password'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('admin_forget_password') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ms-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
        
    </x-guest-layout>
</body>
</html>