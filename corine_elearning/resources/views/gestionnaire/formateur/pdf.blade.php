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
    background-color: #c93305;
    color: white;
 }  
</style>   
<body>

    
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
                        <a href="{{ url('/generate-pdf-view') }}" class="btn btn-primary">PDF</a>
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Classe</th>
                                    <th>Actions</th>
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
                                    <td>{{$formateur->classe}}</td>
                                    <td>
                                        <a href="/update-apprenant/{{ $formateur->id }}" class="btn btn-info">Update</a>
                                        <a href="/delete-apprenant/{{ $formateur->id }}" class="btn btn-danger">Delete</a>
                                    </td>
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