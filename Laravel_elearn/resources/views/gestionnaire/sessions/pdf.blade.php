<!-- resources/views/votre_vue_pdf.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Apprenants</title>
</head>
<body>
    
    @if(isset($apprenants))
        <h2>Apprenants de la session sélectionnée :</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Date de Naissance</th>
                    <th>Spécialité</th>
                    <th>Matricule</th>
                    <th>Numéro CNI</th>
                    <th>Date de délivrance</th>
                    <th>Téléphone</th>
                    <th>Numéro Inscription</th>
                    <th>Nom personne à contacter</th>
                    <th>Numéro personne à contacter</th>
                </tr>
            </thead>
            <tbody>
                @foreach($apprenants as $apprenant)
                    <tr>
                        <td>{{ $apprenant->nom }}</td>
                        <td>{{ $apprenant->prenom }}</td>
                        <td>{{ $apprenant->email }}</td>
                        <td>{{$apprenant->date_naissance}}</td>
                    <td>{{$apprenant->specialite}}</td>
                    <td>{{$apprenant->matricule}}</td>
                    <td>{{$apprenant->numero_cni}}</td>
                    <td>{{$apprenant->date_delivrance}}</td>
                    <td>{{$apprenant->telephone}}</td>
                    <td>{{$apprenant->numero_inscription}}</td>
                    <td>{{$apprenant->nom_personne_contact}}</td>
                    <td>{{$apprenant->numero_personne_contact}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</body>
</html>
