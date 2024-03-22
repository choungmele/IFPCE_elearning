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
            overflow: hidden; /* Empêche le défilement de la page */
            
        }
  

        .container {
    display: flex;
    flex-wrap: wrap;
    max-height: 500px; /* Hauteur maximale pour afficher les éléments */
    overflow-y: auto; /* Ajoute une barre de défilement vertical si nécessaire */
    
}

        .sidebar {
            background-color: blue;
            color: #ffffff;
            height: 493px;
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
  
        .form-control{

            width: 700px;
        }
     
    </style>
</head>
<body>
    <img src="{{ asset('images/brochure.jpg') }}" alt="brochure" width="100%" height="200px" display: block;/>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
          
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
            <i class="fa fa-bell" aria-hidden="true"></i>
          </form>
        </div>
      </nav>
      <div class="container-fluid">
        <div class="row">
        <nav class="col-md-2 d-none d-md-block sidebar">
                <div class="sidebar-sticky">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4" style="margin-top:20px;">
                                <h3>Bienvenue</h3>
                                <h4 style="color: black; font-size: 24px; font-weight: bold; text-decoration: underline; text-transform: uppercase; margin-botom:30px;"> 
                                {{ $m = Session::get('manager_name'); }}
                                {{ $prenom = Session::get('manager_prenom'); }}                                  
    </h4>
                            </div>
                        </div>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-check icon"></i> Session
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('session.create') }}"><i class="fa fa-graduation-cap" aria-hidden="true"></i>creer une session</a></li>
                                <li><a class="dropdown-item" href="{{ route('session.liste') }}"><i class="fa fa-list" aria-hidden="true"></i>liste des sessions</a></li>   
                             </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-check icon"></i> Spécialité
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('specialite.create') }}"><i class="fa fa-graduation-cap" aria-hidden="true"></i>creer une spécialité</a></li>
                                <li><a class="dropdown-item" href="{{ route('specialite.liste') }}"><i class="fa fa-list" aria-hidden="true"></i>liste des spécialité</a></li>   
                             </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-check icon"></i> Domaine de compétence
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('domaine.create') }}"><i class="fa fa-graduation-cap" aria-hidden="true"></i>creer un domaine de compétence</a></li>
                                <li><a class="dropdown-item" href="{{ route('domaine.liste') }}"><i class="fa fa-list" aria-hidden="true"></i>liste des compétences</a></li>   
                             </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user icon"></i> Apprenant
                            </a>
                            <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('apprenant.postulants') }}"><i class="fa fa-list" aria-hidden="true"></i>Liste des postulants</a></li>

                               <li><a class="dropdown-item" href="{{ route('apprenant.liste') }}"><i class="fa fa-list" aria-hidden="true"></i>Liste Apprenant</a></li>
                               <li><a class="dropdown-item" href="{{ route('apprenant.liste_desactiver') }}"><i class="fa fa-list" aria-hidden="true"></i>Liste des comptes desactivés</a></li>

                               <li><a class="dropdown-item" href="{{ route('apprenant.register2') }}"><i class="fa fa-user-plus" aria-hidden="true"></i>Ajouter Apprenant</a></li>   
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-chalkboard-teacher icon"></i> Formateur
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('formateur.liste') }}"><i class="fa fa-list" aria-hidden="true"></i>Liste des Formateurs</a></li>
                                <li><a class="dropdown-item" href="{{ route('formateur.create') }}"><i class="fa fa-user-plus" aria-hidden="true"></i>Ajouter Formateur</a></li>   
                             </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-book icon"></i>cours
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('cours.liste') }}"><i class="fas fa-book icon"></i>liste des cours</a></li>
                                <li><a class="dropdown-item" href="{{ route('cours.create') }}">creer un cours</a></li>
                                <li><a class="dropdown-item" href="{{ route('cours.liste' )}}">programme cours</a></li>
                                <li><a class="dropdown-item" href="{{ url('/programmer/ajouterProgram') }}">programmer un cours</a></li>
                                
                                <li><a class="dropdown-item" href="{{ route('cours.liste_publier') }}">liste des cours publier</a></li>
                                <li><a class="dropdown-item" href="#">planifier un cours</a></li>
                              </ul>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-poll icon"></i> Evaluations
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('quizz.create') }}"><i class="fas fa-book icon"></i>Creer un Quizz</a></li>
                                <li><a class="dropdown-item" href="{{ route('quizz.liste') }}">liste des quizz créés</a></li>
                                <li><a class="dropdown-item" href="{{ route('quizz.liste2') }}">liste des quizz publiés</a></li>
                                <li><a class="dropdown-item" href="#">Rattrapage</a></li>
                              </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-poll icon"></i> Examen
                            </a>
                            <ul class="dropdown-menu">
                               
                                <li><a class="dropdown-item" href="{{ route('examen.create') }}">Créer un examen</a></li>
                                <li><a class="dropdown-item" href="{{ route('examen.liste') }}">Liste des examens crées</a></li>
                                <li><a class="dropdown-item" href="{{ route('examen.liste_publier') }}">Liste des examens publiés</a></li>
                            </ul>
                        </li>
                       
                        <li class="nav-item">
                            <a class="nav-link" href="logout">
                                <i class="fas fa-sign-out-alt icon"></i> Se Déconnecter
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
    
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
               




            <h2>Creer un nouveau cours</h2>

<div class="container">
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form  action="{{ route('cours.do_add_file',$cour->id) }}" method="POST" enctype="multipart/form-data" id="formFormateur" name="formFormateur">
            @csrf
            

            <div class="form-group">
                <label for="photo">Sélectionner un fichier :</label>
                <input type="file" name="photo" id="photo" class="form-control-file" required style="display: block;
    width: 100%; margin-bottom: 50px;">
            </div>
            <button type="submit" class="btn btn-primary" style=" display: block;
    margin: 0 auto; margin-bottom:100px;">Enregistrer</button>
        </form>
    </div>


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
   
    
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</html>