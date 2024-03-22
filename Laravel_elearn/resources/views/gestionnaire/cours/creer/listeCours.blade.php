<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>IFPCE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    rel="stylesheet">
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
                    <ul class="nav flex-column">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="{{ url('/gestionnaire/dashboard') }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-check icon"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-check icon"></i> Session
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ url('/create-session-form') }}"><i class="fa fa-graduation-cap" aria-hidden="true"></i>creer une session</a></li>
                                <li><a class="dropdown-item" href="{{ url('/apprenants-par-session') }}"><i class="fa fa-list" aria-hidden="true"></i>liste des sessions</a></li>   
                             </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-check icon"></i> Spécialité
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ url('/create-specialite-form') }}"><i class="fa fa-graduation-cap" aria-hidden="true"></i>creer une specialite</a></li>
                                <li><a class="dropdown-item" href="{{ url('/apprenants-par-specialite') }}"><i class="fa fa-list" aria-hidden="true"></i>liste des specialites</a></li>   
                             </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-check icon"></i> Module de Ratachement
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ url('/create') }}"><i class="fa fa-graduation-cap" aria-hidden="true"></i>creer un module</a></li>
                                <li><a class="dropdown-item" href="{{ url('/list') }}"><i class="fa fa-list" aria-hidden="true"></i>liste des modules</a></li>   
                             </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-check icon"></i>Numero Inscription
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ url('/form') }}"><i class="fa fa-graduation-cap" aria-hidden="true"></i>creer numero inscription</a></li>
                                <li><a class="dropdown-item" href="{{ url('/edit') }}"><i class="fa fa-list" aria-hidden="true"></i>liste des inscription</a></li>   
                             </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user icon"></i> Apprenant
                            </a>
                            <ul class="dropdown-menu">
                               <li><a class="dropdown-item" href="{{ url('/liste') }}"><i class="fa fa-list" aria-hidden="true"></i>Liste Apprenant</a></li>
                               <li><a class="dropdown-item" href="{{ url('/ajouter') }}"><i class="fa fa-user-plus" aria-hidden="true"></i>Ajouter Apprenant</a></li>   
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-chalkboard-teacher icon"></i> Formateur
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ url('/listeF') }}"><i class="fa fa-list" aria-hidden="true"></i>Liste Formateur</a></li>
                                <li><a class="dropdown-item" href="{{ url('/ajouterF') }}"><i class="fa fa-user-plus" aria-hidden="true"></i>Ajouter Formateur</a></li>   
                             </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-book icon"></i>cours
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item"  href="{{ url('/creer/ajouterCours') }}">creer un cours</a></li>
                                <li><a class="dropdown-item" href="{{ url('/creer/listeCours') }}"><i class="fas fa-book icon"></i>liste des cours</a></li>
                                <li><a class="dropdown-item" href="{{ url('/programmer/ajouterProgram') }}">programmer un cours</a></li>
                                <li><a class="dropdown-item" href="{{ url('/programmer/listeProgram') }}">liste des cours programmes</a></li>
                                <li><a class="dropdown-item" href="{{ url('/planification/form') }}">planifier un cours</a></li>
                                <li><a class="dropdown-item" href="{{ url('/planification/view') }}">lister cours planifier</a></li>
                                <li><a class="dropdown-item" href="{{ url('/publier/upload') }}">publier un cours</a></li>
                                <li><a class="dropdown-item" href="{{ url('/publier/documents') }}">liste des cours publier</a></li>
                              </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-poll icon"></i> Evaluations
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ url('/quizz/create') }}"><i class="fas fa-book icon"></i>Creer un Quizz</a></li>
                                <li><a class="dropdown-item" href="{{ url('/examens/index') }}">Creer un Examen</a></li>
                                <li><a class="dropdown-item" href="{{ url('/rattrapages/create') }}">Creer un rattrapage</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-poll icon"></i> Devoir et Examen Apprenant
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-book icon"></i>Examen Apprenant</a></li>
                                <li><a class="dropdown-item" href="#">Rattrapage Apprenant</a></li>
                                <li><a class="dropdown-item" href="#">Devoir Apprenant</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-chart-line icon"></i> Suivi Progrès
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ url('/planification/synthese') }}"><i class="fa fa-bar-chart" aria-hidden="true"></i>
                                    Tableau de bord cours</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i>
                                    Tableau de bord examen</a></li>
                              </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-chart-line icon"></i> Administration
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ url('/planification/synthese') }}"><i class="fa fa-bar-chart" aria-hidden="true"></i>
                                    publication d'un communique</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i>
                                    visualiser message recu</a></li>
                              </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('gestionnaire/logout') }}">
                                <i class="fas fa-sign-out-alt icon"></i> Se Déconnecter
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
    
            <main role="main" class="col-lg-10 col-md-8 col-sm-12 ml-sm-auto px-md-4">
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
                        <a href="/creer/ajouterCours" class="btn btn-primary">Ajouter un cours</a>
                        <a href="{{ url('/generate-pdf-vi') }}" class="btn btn-primary">PDF</a>
                        <table class="table">
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
                              @foreach ( $courss as  $cours)
                                  
                             
                                <tr>
                                    <td>{{$ide}}</td>
                                    <td>
                                        @if ($cours->specialite)
                                            @foreach ($cours->specialite as $specialite)
                                                {{$specialite->nom}}<br>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>{{$cours->moduleRattachement}}</td>
                                    <td>{{$cours->intituleCours}}</td>
                                    <td>{{$cours->code}}</td>
                                    <td>{{$cours->volumeHoraire}}</td>
                                    <td>{{$cours->coefficient}}</td>
                                    <td>{{$cours->observations}}</td>
                                    <td>{{$cours->syllabus}}</td>
                                    <td>
                                        <a href="/creer/updateCours-cours/{{ $cours->id }}" class="btn btn-info">Update</a>
                                        <a href="/creer/deleteCours-cours/{{  $cours->id }}" class="btn btn-danger">Delete</a>
                                    </td>
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