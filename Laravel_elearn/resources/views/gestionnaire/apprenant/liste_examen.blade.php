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
            overflow-x: hidden; /* Empêcher le défilement horizontal de la page */
            min-height: 100vh;	
            overflow: hidden; /* Empêche le défilement de la page */
           

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


.container {
    display: flex;
    flex-wrap: wrap;
    max-height: 400px; /* Hauteur maximale pour afficher les éléments */
    overflow-y: auto; /* Ajoute une barre de défilement vertical si nécessaire */
    
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
                                  Nom: {{$apprenant->nom}}
                                  Email: {{$apprenant->email}}
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
                               <li><a class="dropdown-item" href="{{ url('/ajouterA' ,$apprenant->id) }}"><i class="fa fa-list" aria-hidden="true"></i>M'Enroller</a></li>
                               <li><a class="dropdown-item" href="{{ url('/updateA' ,$apprenant->id) }}"><i class="fa fa-user-plus" aria-hidden="true"></i>Modifier Profil</a></li>   
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
                                <li><a class="dropdown-item" href="{{ route('apprenant.ressources', $apprenant->id) }}"><i class="fas fa-book icon"></i>Mes Ressources</a></li>
                                <li><a class="dropdown-item" href="{{ route('apprenant.liste_cours', $apprenant->id) }}"><i class="fas fa-book icon"></i>liste des cours</a></li>
                                <li><a class="dropdown-item" href=""></a></li>
                              </ul>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-poll icon"></i> Evaluations
                            </a>
                            <ul class="dropdown-menu">
                                
                            <li><a class="dropdown-item" href="{{ route('apprenant.liste_quizz', $apprenant->id ) }}"><i class="fas fa-book icon"></i>Mes Quizz</a></li>
                                <li><a class="dropdown-item" href="{{ route('apprenant.liste_examen', $apprenant->id ) }}">Examen</a></li>
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
    
    
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
               




            
<h1 style="text-align:center">Liste des examens en cours</h1>


@if (session('message') )
<div style="font-size: 24px; font-weight: bold;">
    <p><span style="color: blue;">{{ session('message') }}</span></p>
</div>
@endif
<div class="container">
    <h1>Liste des Examens</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nom du Fichier</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($examens as $examen)
                <tr>
                    <td>{{ $examen->filename }}</td>
                    <td>
                        <a href="{{ route('examens.download', $examen->id) }}" class="btn btn-success">Télécharger</a> 
                        
                        
                        <form  action="{{ route('examen.do_rendre',['id_app' => $apprenant->id, 'id_examen' => $examen->id]) }}" method="POST" enctype="multipart/form-data" id="formFormateur" name="formFormateur">
            @csrf
            

            <div class="form-group">
                <input type="file" name="photo" id="photo" class="form-control-file" required >
                <button type="submit" class="btn btn-primary" style=" display: block;
    margin: 0 auto; margin-bottom:10px;">Rendre</button>
            </div>
            
        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
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