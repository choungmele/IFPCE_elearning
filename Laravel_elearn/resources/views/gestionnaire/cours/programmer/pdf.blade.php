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
                <a href="/programmer/ajouterProgram" class="btn btn-primary">Ajouter un cours</a>
                <a href="{{ url('/generate-pdf-view') }}" class="btn btn-primary">PDF</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th>N-</th>
                            <th>Session</th>
                            <th>Specialite</th>
                            <th>intitule cours</th>
                            <th>code</th>
                            <th>Nom formateur</th>
                            <th>Nom formateur 2</th>
                            <th>volume horaire</th>
                            <th>Debut seance</th>
                            <th>Fin seance</th>
                            <th>observations</th>
                        </tr>
                    </thead>
                    <tbody>
                      @php
                       $ide = 1; 
        
        
                      @endphp
                      @foreach ( $programmations as  $programmationCours)
                          
                     
                        <tr>
                            <td>{{$ide}}</td>
                            <td>{{$programmationCours->session->nom}}</td>
                            <td>{{$programmationCours->specialite->nom}}</td>
                            <td>{{$programmationCours->intituleCours}}</td>
                            <td>{{$programmationCours->code}}</td>
                            <td>{{$programmationCours->formateur}}</td>
                            <td>{{$programmationCours->formateurs}}</td>
                            <td>{{$programmationCours->volumeHoraire}}</td>
                            <td>{{$programmationCours->debut}}</td>
                            <td>{{$programmationCours->fin}}</td>
                            <td>{{$programmationCours->observations}}</td>
                            <td>
                                <a href="/programmer/updateProgram-programmationCours/{{ $programmationCours->id }}" class="btn btn-info">Update</a>
                                <a href="/programmer/deleteProgram-programmationCours/{{  $programmationCours->id }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @php
                        $ide += 1;
                        @endphp
                        @endforeach  
                       
                    </tbody>
        
                </table>
                {{$programmations->links()}}
              </div>
            </div>
          </div>
        <!-- ... -->
    </main>
</div>
</div>
        </div>
    </div>
    

   
    
</body>

</html>