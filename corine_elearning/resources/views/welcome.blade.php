 <!-- resources/views/auth/login.blade.php -->

 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IFPCE E-LEANING</title>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>
<body>
<div class="login-container">
        <label>IFPCE</label>
        
        
        <a href="{{ route('gestionnaire.log') }}"><button type="button" style="margin-top:20px;">Gestionnaire</button></a>

        <a href="{{ route('apprenant.log') }}"><button type="button" style="margin-top:20px; background-color: green;
    color: white;">Apprenant</button></a>

<a href="{{ route('apprenant.log') }}"><button type="button" style="margin-top:20px; background-color: yellow;
    color: black;">Formateur</button></a>

<a href="{{ route('admin.log') }}"><button type="button" style="margin-top:20px; background-color: red;
    color: black;">Administrateur</button></a>


    </div>
</body>
</html>
