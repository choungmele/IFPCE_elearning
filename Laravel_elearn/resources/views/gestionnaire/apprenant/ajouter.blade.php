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
                <div class="container">
                    <div class="row align-items-start">
                      <div class="col s12">
                        <h1>ajouter un apprenant</h1>
                        <hr>
                        
                        @if (session('status'))
                            
                        <div class="alert alert-success">
                        {{session('status')}};  
                        </div>
                        @endif
                        <ul>
                          @foreach($errors->all() as $error)
                            <li class="alert alert-danger">{{$error}}</li>
                          @endforeach
                        </ul>
                      
                
                        <form action="/ajouter/trait" method="POST" class="form-group">
                            @csrf
                            <div class="form-group">
                                <label for="Nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="Nom" name="nom">
                            </div>
                        
                            <div class="form-group">
                                <label for="Prenom" class="form-label">Prenom</label>
                                <input type="text" class="form-control" id="Prenom" name="prenom">
                            </div>
                        
                            <div class="form-group">
                                <label for="Email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="Email" name="email">
                            </div>
                        
                            <div class="form-group">
                                <label for="Session" class="form-label">Session</label>
                                <select class="form-control" id="Session" name="session">
                                    @foreach ($sessions as $session)
                                        <option value="{{ $session->id }}">{{ $session->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        
                            <!-- Nouveaux champs ajoutés -->
                            <div class="form-group">
                                <label for="DateNaissance" class="form-label">Date de Naissance</label>
                                <input type="date" class="form-control" id="DateNaissance" name="date_naissance">
                            </div>
                        
                            <div class="form-group">
                                <label for="Specialite" class="form-label">Specialite</label>
                                <select class="form-control" id="Specialite" name="specialite">
                                    @foreach ($specialites as $specialite)
                                        <option value="{{ $specialite->id }}">{{ $specialite->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        <!--
                            <div class="form-group">
                                <label for="Matricule" class="form-label">Matricule</label>
                                <input type="text" class="form-control" id="Matricule" name="matricule">
                            </div>
                        -->
                            <div class="form-group">
                                <label for="NumeroCNI" class="form-label">Numero CNI</label>
                                <input type="text" class="form-control" id="NumeroCNI" name="numero_cni">
                            </div>
                        
                            <div class="form-group">
                                <label for="DateDelivrance" class="form-label">Date de Delivrance</label>
                                <input type="date" class="form-control" id="DateDelivrance" name="date_delivrance">
                            </div>
                        
                            <div class="form-group">
                                <label for="Telephone" class="form-label">Telephone</label>
                                <input type="text" class="form-control" id="Telephone" name="telephone">
                            </div>
                        <!--
                            <div class="form-group">
                                <label for="NumeroInscription" class="form-label">Numero Inscription</label>
                                <input type="text" class="form-control" id="NumeroInscription" name="numero_inscription">
                            </div>
                        -->
                            <div class="form-group">
                                <label for="NomPersonneContact" class="form-label">Nom Personne à Contacter</label>
                                <input type="text" class="form-control" id="NomPersonneContact" name="nom_personne_contact">
                            </div>
                        
                            <div class="form-group">
                                <label for="NumeroPersonneContact" class="form-label">Numero Personne à Contacter</label>
                                <input type="text" class="form-control" id="NumeroPersonneContact" name="numero_personne_contact">
                            </div>
                            <!-- Fin des nouveaux champs -->
                             <br>
                            <button type="submit" class="btn btn-primary">Ajouter un apprenant</button>
                            <br><br>
                            <a href="/liste" class="btn btn-danger">Revenir à la liste des apprenants</a>
                        </form>
                        
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