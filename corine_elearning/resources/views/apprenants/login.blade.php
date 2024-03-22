 <!-- resources/views/auth/login.blade.php -->

 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IFPCE-authentification</title>
    <link rel="stylesheet" href="{{ asset('css/apprenant.css') }}">
</head>
<body>
    <div class="login-container">
        <label>IFPCE</label>

        @if ($errors->has('status'))
    <div class="alert alert-danger">
        <p style="color:red">{{ $errors->first('status') }}</p>
    </div>
@endif

        <img src="{{ asset('images/logo.jpeg') }}" class="logo" alt="Logo">
        <form   action="{{ route('apprenant.login') }}"method="POST" >
            @csrf
            <label for="email" class="lab">Adresse e-mail</label>
            <input type="email" name="email" placeholder="Email" required id="email" >
            @if ($errors->has('email'))
                        <small class="mb-0 text-danger">{{ $errors->first('email') }}</small>
                    @endif

            <label for="email" class="lab" >Mot de passe </label>
            <input type="password" name="password" placeholder="Password" required id="password">
            @if ($errors->has('password'))
                        <small class="mb-0 text-danger">{{ $errors->first('password') }}</small>
                    @endif

            <button type="submit">Login</button>
            <p>Pas encore de compte?<a href="{{ route('apprenant.register') }}">S'enregistrer</a></p>
        </form>
    </div>
</body>
</html>
