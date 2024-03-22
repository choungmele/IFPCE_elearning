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
    <img src="{{ asset('images/brochure.jpg') }}" alt="brochure" class="img-fluid" />
    
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <!-- Contenu de la page -->
                <h2>Contenu de la page</h2>
                <div class="container text-center">
                    <div class="row align-items-start">
                      <div class="col s12">
                        @if (session('status'))
                            
                        <div class="alert alert-success">
                        {{session('status')}};  
                        </div>
                        @endif
                        
                        <a href="/ajouter" class="btn btn-primary">Ajouter un formateur</a>
                        <a href="{{ url('/generate-pdf-v') }}" class="btn btn-primary">PDF</a>
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Email</th>
                                    <th>Date de Naissance</th>
                                    <th>Numéro de Téléphone</th>
                                    <th>Cours Dispensé</th>
                                    <th>Numéro CNI</th>
                                    <th>Date de Délivrance</th>
                                </tr>
                            </thead>
                            <tbody>
                              @php
                               $ide = 1; 
                
                
                              @endphp
                              @foreach ($formateurs as $formateur)
                                  
                             
                                <tr>
                                    <td>{{$ide}}</td>
                                    <td>{{$formateur->nom}}</td>
                                    <td>{{$formateur->prenom}}</td>
                                    <td>{{$formateur->email}}</td>
                                    <td>{{$formateur->date_naissance}}</td>
                                    <td>{{$formateur->telephone}}</td>
                                    <td>{{$formateur->cours_dispense}}</td>
                                    <td>{{$formateur->numero_cni}}</td>
                                    <td>{{$formateur->date_delivrance}}</td>
                                   
                                </tr>
                                @php
                                $ide += 1;
                                @endphp
                                @endforeach  
                               
                            </tbody>
                
                        </table>
                        {{$formateurs->links()}}
                      </div>
                    </div>
                  </div>
                <!-- ... -->
            </main>
        </div>
    </div>
    

   
    
</body>

</html>