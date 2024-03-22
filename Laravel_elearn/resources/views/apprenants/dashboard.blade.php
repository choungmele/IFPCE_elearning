<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>IFPCE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    rel="stylesheet">
    <link rel="icon" href="{{ asset('images/ifpce.jpg') }}" type="image/x-icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
  
        .sidebar {
            background-color: #343a40;
            color: #ffffff;
        }
  
        .nav-link {
            color: #ffffff;
        }
  
        .nav-link:hover {
            color: #007bff;
        }
  
        .nav-item.active {
            background-color: #007bff;
        }
  
        .submenu {
            background-color: #495057;
        }
  
        .submenu a {
            color: #ffffff;
        }
  
        .submenu a:hover {
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <img src="{{ asset('images/brochure.jpg') }}" alt="brochure" class="img-fluid" />
    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand">IFPCE</a>
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
            <i class="fa fa-bell" aria-hidden="true"></i>
          </form>
        </div>
      </nav>
      <div class="container-fluid">
        <div class="row">
            <nav class="col-lg-2 col-md-4 col-sm-12 sidebar">
                <div class="sidebar-sticky">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4" style="margin-top:20px;">
                                <h4>Welcome To Dashboard</h4>
                                <hr> 
                                  Nom: {{$data->name}}
                                  Email: {{$data->email}}
                            </div>
                        </div>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="{{ url('/apprenants/dashboard') }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-check icon"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user icon"></i> Apprenant
                            </a>
                            <ul class="dropdown-menu">
                               <li><a class="dropdown-item" href="{{ url('/ajouterA' ,$data->id) }}"><i class="fa fa-list" aria-hidden="true"></i>M'Enroller</a></li>
                               <li><a class="dropdown-item" href="{{ url('/updateA' ,$data->id) }}"><i class="fa fa-user-plus" aria-hidden="true"></i>Modifier Profil</a></li>   
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-chalkboard-teacher icon"></i> Administration
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href=""><i class="fa fa-list" aria-hidden="true"></i>Voir Note</a></li>
                                <li><a class="dropdown-item" href=""><i class="fa fa-user-plus" aria-hidden="true"></i>Envoyer Courrier</a></li>   
                             </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-book icon"></i>Mes cours
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('apprenant.ressources', $data->id) }}"><i class="fas fa-book icon"></i>Mes Ressources</a></li>
                                <li><a class="dropdown-item" href="{{ route('apprenant.liste_cours', $data->id) }}"><i class="fas fa-book icon"></i>liste des cours</a></li>
                                <li><a class="dropdown-item" href=""></a></li>
                              </ul>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-poll icon"></i> Evaluations
                            </a>
                            <ul class="dropdown-menu">
                                
                            <li><a class="dropdown-item" href="{{ route('apprenant.liste_quizz', $data->id ) }}"><i class="fas fa-book icon"></i>Mes Quizz</a></li>
                                <li><a class="dropdown-item" href="{{ route('apprenant.liste_examen', $data->id ) }}">Examen</a></li>
                                <li><a class="dropdown-item" href="#">Rattrapage</a></li>
                            </ul>
                        </li>
                     
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('apprenants/logout') }}">
                             <i class="fas fa-sign-out-alt icon"></i>Se Déconnecter 
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
    
            <main role="main" class="col-lg-10 col-md-8 col-sm-12 ml-sm-auto px-md-4">
                <!-- Contenu de la page -->
                <h2>Contenu de la page</h2>
                <h3>Liste des cours programmer</h3>
                <div class="container text-center">
                    <div class="row align-items-start">
                      <div class="col s12">
                        @if (session('status'))
                            
                        <div class="alert alert-success">
                        {{session('status')}};  
                        </div>
                        @endif
                       
                
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
                                    <th>Debut</th>
                                    <th>Fin</th>
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
                                 
                                </tr>
                                @php
                                $ide += 1;
                                @endphp
                              
                              @endforeach  
                            </tbody>
                
                        </table>
                        
                      </div>
                    </div>
                  </div>
                  <!--planification d'un cours-->
                  
<h2>Liste des planifications de cours</h2>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table table-bordered">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Séance</th>
            <th scope="col">Cours</th>
            <th scope="col">Formateur</th>
            <th scope="col">Formateur Assistant</th>
            <th scope="col">Site</th>
            <th scope="col">Jour</th>
            <th scope="col">Heure de début</th>
            <th scope="col">Heure de fin</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($coursPlanifications as $CoursPlanification)
            <tr>
                <td>{{ $CoursPlanification->seance }}</td>
                <td>{{ $CoursPlanification->cours }}</td>
                <td>{{ $CoursPlanification->formateur }}</td>
                <td>{{ $CoursPlanification->formateur_assistant }}</td>
                <td>{{ $CoursPlanification->site }}</td>
                <td>{{ $CoursPlanification->jour }}</td>
                <td>{{ $CoursPlanification->heure_debut }}</td>
                <td>{{ $CoursPlanification->heure_fin }}</td>
           
            </tr>
        @endforeach
    </tbody>
</table>
            </main>
        </div>
    </div>
    
    <!-- Inclure les scripts Bootstrap nécessaires -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Inclure les scripts Font Awesome nécessaires -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    
  
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
   
</div>   
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</html>