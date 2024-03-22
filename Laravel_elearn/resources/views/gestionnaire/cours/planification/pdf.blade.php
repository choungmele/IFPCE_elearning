<!-- resources/views/gestionnaire/cours/planification/pdf.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planification PDF</title>
    <style>
        /* Your CSS styles go here */
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    
    <h1>Planification Details</h1>

    <table>
        <tr>
            <th>Séance</th>
            <th>Cours</th>
            <th>Formateur</th>
            <th>Formateur Assistant</th>
            <th>Site</th>
            <th>Jour</th>
            <th>Heure de début</th>
            <th>Heure de fin</th>
        </tr>
        <tr>
            <td>{{ $coursPlanification->seance }}</td>
            <td>{{ $coursPlanification->cours }}</td>
            <td>{{ $coursPlanification->formateur }}</td>
            <td>{{ $coursPlanification->formateur_assistant }}</td>
            <td>{{ $coursPlanification->site }}</td>
            <td>{{ $coursPlanification->jour }}</td>
            <td>{{ $coursPlanification->heure_debut }}</td>
            <td>{{ $coursPlanification->heure_fin }}</td>
        </tr>
    </table>

</body>
</html>
