<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Apprenants</title>
</head>
<body>
<!-- resources/views/students/pdf.blade.php -->

<table border="1" class="table">
    <thead>
        <tr>
            <th>Numero d'inscription</th>
            <th>Nom</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
            <tr>
                <td>{{ $student->numero_inscription }}</td>
                <td>{{ $student->nom }}</td>
                <td>{{ $student->email }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>    