<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Forget Password</title>
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
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Forgot your password?') }}
        </div>

        @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
       
        @if(Session::has('success'))
            <div class="success-message">
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif

    
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
    
        <form method="POST" action="{{ route('admin_forget_password_submit') }}">
            @csrf
    
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
    
            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Email Password Reset Link') }}
                </x-primary-button>
            </div>
        </form>
    </x-guest-layout>
</body>
</html>