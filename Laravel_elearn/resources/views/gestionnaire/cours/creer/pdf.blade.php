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
               
                <div class="container text-center">
                    <div class="row align-items-start">
                      <div class="col s12">
                        @if (session('status'))
                            
                        <div class="alert alert-success">
                        {{session('status')}};  
                        </div>
                        @endif
                        <a href="/ajouterCours" class="btn btn-primary">Ajouter un formateur</a>
                        <a href="{{ url('/generate-pdf-vi') }}" class="btn btn-primary">PDF</a>
                        <table>
                            <thead>
                                <tr>
                                    <th>N-</th>
                                    <th>Specialite</th>
                                    <th>Module de Rattachement</th>
                                    <th>intitule cours</th>
                                    <th>code</th>
                                    <th>volume horaire</th>
                                    <th>coefficient</th>
                                    <th>objectif du cours</th>
                                    <th>syllabus</th>
                                </tr>
                            </thead>
                            <tbody>
                              @php
                               $ide = 1; 
                              @endphp
                              @foreach ($courss as $cours)
                                  
                             
                                <tr>
                                    <td>{{$ide}}</td>
                                    <td>{{$cours->specialite->nom}}</td>
                                    <td>{{$cours->moduleRattachement}}</td>
                                    <td>{{$cours->intituleCours}}</td>
                                    <td>{{$cours->code}}</td>
                                    <td>{{$cours->volumeHoraire}}</td>
                                    <td>{{$cours->coefficient}}</td>
                                    <td>{{$cours->observations}}</td>
                                    <td>{{$cours->syllabus}}</td>
                                    
                                </tr>
                                @php
                                $ide += 1;
                                @endphp
                                @endforeach  
                               
                            </tbody>
                
                        </table>
                        {{$courss->links()}}
                      </div>
                    </div>
                  </div>
                <!-- ... -->
            </main>
        </div>
    </div>
    

   
    
</body>

</html>