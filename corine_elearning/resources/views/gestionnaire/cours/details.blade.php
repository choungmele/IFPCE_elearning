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
            /*overflow-x: hidden;  Empêcher le défilement horizontal de la page */
            min-height: 100vh;	
            /*overflow: hidden;  Empêche le défilement de la page */

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

            width: 300px;
        }

        .photo {
            width: calc(100% / 3); /* Pour afficher trois éléments par ligne */
    padding: 10px;
    box-sizing: border-box; /* Pour inclure le padding dans la largeur définie */
    border-radius: 30px; /* Bordures arrondies */
    box-shadow: 20px 20px 5px rgba(10, 10, 10, 0.1); /* Ombre légère */
    width: 400px;
    margin:5px;
    height:630px;
    margin-bottom:30px;
    align-items: stretch;
}


.sup{
    background-color:red;
    border-radius:10px;
    margin-left:20px:
}
.mod{
    background-color:yellow;
    border-radius:10px;
    
}
.cadre {
    display: flex;
    flex-wrap: wrap;
    max-height: 550px; /* Hauteur maximale pour afficher les éléments */
    overflow-y: auto; /* Ajoute une barre de défilement vertical si nécessaire */
    
}

.b {
  display: flex; /* Utiliser le modèle de boîte flexible pour disposer les éléments */
  justify-content: space-between; /* Espace équitablement les éléments dans le conteneur */
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
                                <li><a class="dropdown-item" href="#"><i class="fa fa-graduation-cap" aria-hidden="true"></i>creer une session</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fa fa-list" aria-hidden="true"></i>liste des sessions</a></li>   
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
                                <li><a class="dropdown-item" href="{{ route('formateur.liste') }}"><i class="fa fa-list" aria-hidden="true"></i>Liste Formateur</a></li>
                                <li><a class="dropdown-item" href="{{ route('formateur.create') }}"><i class="fa fa-user-plus" aria-hidden="true"></i>Ajouter Formateur</a></li>   
                             </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-book icon"></i>cours
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ url('/creer/listeCours') }}"><i class="fas fa-book icon"></i>liste des cours</a></li>
                                <li><a class="dropdown-item"  href="{{ route('cours.create') }}">creer un cours</a></li>
                                <li><a class="dropdown-item" href="{{ url('/programmer/listeProgram') }}">programme cours</a></li>
                                <li><a class="dropdown-item" href="{{ url('/programmer/ajouterProgram') }}">programmer un cours</a></li>
                                <li><a class="dropdown-item" href="{{ url('/publier/upload') }}">publier un cours</a></li>
                                <li><a class="dropdown-item" href="{{ url('/publier/documents') }}">liste des cours publier</a></li>
                                <li><a class="dropdown-item" href="#">planifier un cours</a></li>
                              </ul>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-poll icon"></i> Evaluations
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-book icon"></i>Creer un Quizz</a></li>
                                <li><a class="dropdown-item" href="#">Examen</a></li>
                                <li><a class="dropdown-item" href="#">Rattrapage</a></li>
                                <li><a class="dropdown-item" href="#">liste des sujets</a></li>
                              </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-chart-line icon"></i> Suivi Progrès
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i>
                                    Tableau de bord cours</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i>
                                    Tableau de bord examen</a></li>
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
               




            




            <!-- Affichage de la liste des fichiers avec des liens de téléchargement -->
<h1>Détails du Cours</h1>
<p>Titre:{{ $cour->titre }}</p>
<p>Specialité:{{ $cour->specialite }}</p>
<p>Nom du formateur:{{ $cour->formateur }}</p>
<p>Coefficient:{{ $cour->coef }}</p>
<p>Date de début:{{ $cour->date_debut }}</p>
<p>Date de fin:{{ $cour->date_fin }}</p>

<h2>Fichiers associés</h2>
<ul>
    @foreach($fichiers as $fichier)
        <li>
            <a href="{{ Storage::url($fichier) }}" download>{{ basename($fichier) }}</a>
        </li>
    @endforeach
</ul>

            
            
        

    
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