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
    max-height: 400px; /* Hauteur maximale pour afficher les éléments */
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
               




            <h2 style="text-align:center;">Entrez les informations de l'apprenant ici</h2>
            @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <div class="container">
        <form   action="{{ route('apprenant.store') }}"method="POST" id="formApp" name="formApp">
            @csrf

            <div class="form-group">
            <label for="nom" class="lab">Nom</label>
            <input type="text" name="nom" class="form-control" placeholder="nom" required id="nom" >
            @if ($errors->has('email'))
                        <small class="mb-0 text-danger">{{ $errors->first('email') }}</small>
                    @endif
                    </div>

                    <div class="form-group">

            <label for="prenom" class="lab" >Prénom </label>
            <input type="text" name="prenom" class="form-control" placeholder="Prénom" required id="prenom">
            @if ($errors->has('password'))
                        <small class="mb-0 text-danger">{{ $errors->first('password') }}</small>
                    @endif
    </div>

    <div class="form-group">
                    <label for="naissance" class="lab">Date de naissance</label>
            <input type="date" name="naissance" class="form-control" placeholder="Date de naissance" required id="naissance" >
            @if ($errors->has('email'))
                        <small class="mb-0 text-danger">{{ $errors->first('email') }}</small>
                    @endif
    </div>

    <div class="form-group">
            <label for="lieu" class="lab" >Lieu de naissance </label>
            <input type="text" name="lieu" class="form-control" placeholder="Lieu de naissance" required id="lieu">
            @if ($errors->has('password'))
                        <small class="mb-0 text-danger">{{ $errors->first('password') }}</small>
                    @endif
    </div>

    <div class="form-group">

                    <label for="pays" class="lab">Pays de residence</label>
            <input type="text" name="pays" class="form-control" placeholder="Pays de résidence" required id="pays" >
            @if ($errors->has('email'))
                        <small class="mb-0 text-danger">{{ $errors->first('email') }}</small>
                    @endif
    </div>

    <div class="form-group">
            <label for="ville" class="lab" >Ville de résidence </label>
            <input type="text" name="ville" class="form-control" placeholder="Ville de résidence " required id="ville">
            @if ($errors->has('password'))
                        <small class="mb-0 text-danger">{{ $errors->first('password') }}</small>
                    @endif
    </div>

    <div class="form-group">
                    <label for="tel" class="lab">Numéro de téléphone</label>
            <input type="number" name="tel" class="form-control" placeholder="Numéro de téléphone" required id="tel" >
            @if ($errors->has('email'))
                        <small class="mb-0 text-danger">{{ $errors->first('email') }}</small>
                    @endif
    </div>

    <div class="form-group">

            <label for="password" class="lab" >Mot de passe </label>
            <input type="password" name="password" class="form-control" placeholder="Password" required id="password">
            @if ($errors->has('password'))
                        <small class="mb-0 text-danger">{{ $errors->first('password') }}</small>
                    @endif
    </div>

    <div class="form-group">

                    <label for="email" class="lab">Adresse e-mail</label>
            <input type="email" name="email" class="form-control" placeholder="Email" required id="email" >
            @if ($errors->has('email'))
                        <small class="mb-0 text-danger">{{ $errors->first('email') }}</small>
                    @endif
    </div>

    <div class="form-group">
                    <label for="cni" class="lab">Numéro de CNI/Passport</label>
            <input type="number" name="cni" class="form-control" placeholder="Numéro de la cni/passport" required id="cni" >
            @if ($errors->has('email'))
                        <small class="mb-0 text-danger">{{ $errors->first('email') }}</small>
                    @endif
    </div>

    <div class="form-group">
                    <label for="specialite" class="lab">Spécialité: </label>
                <select class="js-select2 form-select" id="specialite" name="specialite" >
                                @foreach($specialites as $key => $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
    </div>

    <div class="form-group">
                            <label for="inscription" class="lab">Numéro de telephone whatsapp</label>
            <input type="number" name="inscription" class="form-control" placeholder="Numéro de telephone whatsapp" required id="inscription" >
            @if ($errors->has('email'))
                        <small class="mb-0 text-danger">{{ $errors->first('email') }}</small>
                    @endif 
    </div>

    <div class="form-group">
            <label for="personne" class="lab" >Nom de la personne àcontacter </label>
            <input type="text" name="personne" class="form-control" placeholder="Nom de la personne a contcter" required id="personne">
            @if ($errors->has('password'))
                        <small class="mb-0 text-danger">{{ $errors->first('password') }}</small>
                    @endif
    </div>

<div class="form-group">
                    <label for="tel_pers" class="lab">Téléphone de la personne àcontacter</label>
            <input type="number" name="tel_pers" class="form-control" placeholder="Téléphone de la personne à contacter" required id="tel_pers" >
            @if ($errors->has('email'))
                        <small class="mb-0 text-danger">{{ $errors->first('email') }}</small>
                    @endif
    </div>


<div class="form-group">
            <label for="lien" class="lab" >Lien de parenté </label>
            <input type="text" name="lien" placeholder="Lien de parenté" class="form-control" required id="lien">
            @if ($errors->has('password'))
                        <small class="mb-0 text-danger">{{ $errors->first('password') }}</small>
                    @endif
    </div>

    <button type="submit" class="btn btn-primary" style=" display: block;
    margin: 0 auto; margin-bottom:50px; margin-top:50px;">Enregistrer</button>           
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