 <!-- resources/views/auth/login.blade.php -->

 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IFPCE-authentification</title>
    <link rel="stylesheet" href="{{ asset('css/apprenant.css') }}">
    <style>

.login-container {
    display: flex;
    flex-wrap: wrap;
    max-height: 400px; /* Hauteur maximale pour afficher les éléments */
    overflow-y: auto; /* Ajoute une barre de défilement vertical si nécessaire */
    
}
body {
            overflow: hidden; /* Empêche le défilement de la page */
            
        }
    </style>
</head>
<body>
    <div class="login-container">
        <label>IFPCE</label>
        <img src="{{ asset('images/logo.jpeg') }}" class="logo" alt="Logo">
        <form   action="{{ route('apprenant.store') }}"method="POST" >
            @csrf
            <label for="nom" class="lab">Nom</label>
            <input type="text" name="nom" placeholder="nom" required id="nom" >
            @if ($errors->has('email'))
                        <small class="mb-0 text-danger">{{ $errors->first('email') }}</small>
                    @endif

            <label for="prenom" class="lab" >Prénom </label>
            <input type="text" name="prenom" placeholder="Prénom" required id="prenom">
            @if ($errors->has('password'))
                        <small class="mb-0 text-danger">{{ $errors->first('password') }}</small>
                    @endif

                    <label for="naissance" class="lab">Date de naissance</label>
            <input type="date" name="naissance" placeholder="Date de naissance" required id="naissance" >
            @if ($errors->has('email'))
                        <small class="mb-0 text-danger">{{ $errors->first('email') }}</small>
                    @endif

            <label for="lieu" class="lab" >Lieu de naissance </label>
            <input type="text" name="lieu" placeholder="Lieu de naissance" required id="lieu">
            @if ($errors->has('password'))
                        <small class="mb-0 text-danger">{{ $errors->first('password') }}</small>
                    @endif

                    <label for="pays" class="lab">Pays de residence</label>
            <input type="text" name="pays" placeholder="Pays de résidence" required id="pays" >
            @if ($errors->has('email'))
                        <small class="mb-0 text-danger">{{ $errors->first('email') }}</small>
                    @endif

            <label for="ville" class="lab" >Ville de résidence </label>
            <input type="text" name="ville" placeholder="Ville de résidence " required id="ville">
            @if ($errors->has('password'))
                        <small class="mb-0 text-danger">{{ $errors->first('password') }}</small>
                    @endif

                    <label for="tel" class="lab">Numéro de téléphone</label>
            <input type="number" name="tel" placeholder="Numéro de téléphone" required id="tel" >
            @if ($errors->has('email'))
                        <small class="mb-0 text-danger">{{ $errors->first('email') }}</small>
                    @endif

            <label for="password" class="lab" >Mot de passe </label>
            <input type="password" name="password" placeholder="Password" required id="password">
            @if ($errors->has('password'))
                        <small class="mb-0 text-danger">{{ $errors->first('password') }}</small>
                    @endif

                    <label for="email" class="lab">Adresse e-mail</label>
            <input type="email" name="email" placeholder="Email" required id="email" >
            @if ($errors->has('email'))
                        <small class="mb-0 text-danger">{{ $errors->first('email') }}</small>
                    @endif
                    <label for="cni" class="lab">Numéro de CNI/Passport</label>
            <input type="number" name="cni" placeholder="Numéro de la cni/passport" required id="cni" >
            @if ($errors->has('email'))
                        <small class="mb-0 text-danger">{{ $errors->first('email') }}</small>
                    @endif
                    <label for="specialite" class="lab">Spécialité: </label>
                <select class="js-select2 form-select" id="specialite" name="specialite" >
                                @foreach($specialites as $key => $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            <label for="inscription" class="lab">Numéro de telephone whatsapp</label>
            <input type="number" name="inscription" placeholder="Numéro de telephone whatsapp" required id="inscription" >
            @if ($errors->has('email'))
                        <small class="mb-0 text-danger">{{ $errors->first('email') }}</small>
                    @endif 
            <label for="personne" class="lab" >Nom de la personne àcontacter </label>
            <input type="text" name="personne" placeholder="Nom de la personne a contcter" required id="personne">
            @if ($errors->has('password'))
                        <small class="mb-0 text-danger">{{ $errors->first('password') }}</small>
                    @endif

                    <label for="tel_pers" class="lab">Téléphone de la personne àcontacter</label>
            <input type="number" name="tel_pers" placeholder="Téléphone de la personne à contacter" required id="tel_pers" >
            @if ($errors->has('email'))
                        <small class="mb-0 text-danger">{{ $errors->first('email') }}</small>
                    @endif

            <label for="lien" class="lab" >Lien de parenté </label>
            <input type="text" name="lien" placeholder="Lien de parenté" required id="lien">
            @if ($errors->has('password'))
                        <small class="mb-0 text-danger">{{ $errors->first('password') }}</small>
                    @endif

            <button type="submit" style="margin-top:30px;">Enregister</button>
           
        </form>
    </div>
</body>
</html>
