<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Reset Password</title>
</head>
<body>
    
    <h2>Reset Password</h2>
    @if($errors->any())
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    @endif
    @if(Session::has('error'))
        <li>{{ Session::get('error') }}</li>
    @endif        
    @if(Session::has('success'))
        <li>{{ Session::get('sucsess') }}</li>
    @endif

    <form action="{{ route('admin_reset_password_submit') }}" method="post">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

        <input type="password" name="password" placeholder="Password"><br>
        <input type="password" name="password_confirmation" placeholder="Confirm Password"><br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>