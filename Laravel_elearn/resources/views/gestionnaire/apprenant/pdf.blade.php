<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>IFPCE</title>

</head>
<style>
    table{
       border-collapse: collapse;
       widows: 100%;
    } 
    th,td{
       text-align: left;
       padding: 8px
    } 
    th{
       background-color: #1b23b5;
       color: white;
    }  
   </style>    
<body>
    
   
           
                
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Prenom</th>
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
                                @php
                                $ide = 1;
                                @endphp
                                @foreach ($apprenants as $apprenant)            
                                <tr>
                                    <td>{{$ide}}</td>
                                    <td>{{$apprenant->nom}}</td>
                                    <td>{{$apprenant->prenom}}</td>
                                    <td>{{$apprenant->email}}</td>
                                    
                                    <td>{{$apprenant->date_naissance}}</td>
                                    <td>{{$apprenant->specialite->nom}}</td>
                                    <td>{{$apprenant->matricule}}</td>
                                    <td>{{$apprenant->numero_cni}}</td>
                                    <td>{{$apprenant->date_delivrance}}</td>
                                    <td>{{$apprenant->telephone}}</td>
                                    <td>{{$apprenant->numero_inscription}}</td>
                                    <td>{{$apprenant->nom_personne_contact}}</td>
                                    <td>{{$apprenant->numero_personne_contact}}</td>
                                   
                                </tr> 
                                @php
                                $ide += 1;
                                @endphp
                                @endforeach 
                            </tbody>
                
                        </table>
                       
     
    

   
    
</body>

</html>