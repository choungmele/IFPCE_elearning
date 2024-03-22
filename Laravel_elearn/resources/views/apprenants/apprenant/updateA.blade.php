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
                                  Nom: {{$apprenants->nom}}
                                  Email: {{$apprenants->email}}
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
                               <li><a class="dropdown-item" href="{{ url('/ajouterA' ,$apprenants->id) }}"><i class="fa fa-list" aria-hidden="true"></i>M'Enroller</a></li>
                               <li><a class="dropdown-item" href="{{ url('/updateA' ,$apprenants->id) }}"><i class="fa fa-user-plus" aria-hidden="true"></i>Modifier Profil</a></li>   
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
                                <li><a class="dropdown-item" href="{{ route('apprenant.ressources', $apprenants->id) }}"><i class="fas fa-book icon"></i>Mes Ressources</a></li>
                                <li><a class="dropdown-item" href="{{ route('apprenant.liste_cours', $apprenants->id) }}"><i class="fas fa-book icon"></i>liste des cours</a></li>
                                <li><a class="dropdown-item" href=""></a></li>
                              </ul>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-poll icon"></i> Evaluations
                            </a>
                            <ul class="dropdown-menu">
                                
                            <li><a class="dropdown-item" href="{{ route('apprenant.liste_quizz', $apprenants->id ) }}"><i class="fas fa-book icon"></i>Mes Quizz</a></li>
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
    
            <main role="main" class="col-lg-10 col-md-8 col-sm-12 ml-sm-auto px-md-4">
                <!-- Contenu de la page -->
                <h2>Contenu de la page</h2>
                <div class="container">
                    <div class="row align-items-start">
                      <div class="col s12">
                        <h1>modifier mes informations</h1>
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
                      
                
                        <form action="/update/traitement" method="POST" method="post" class="form-group">
                          @csrf
                          <input type="text" name="id" style="display:none; " value="{{$apprenants->id}}">
                          <div class="form-group">
                            <label for="Nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="Nom" name="nom" value="{{$apprenants->nom}}">
                          </div>  
                         
                          <div class="form-group">
                            <label for="Prenom" class="form-label">Prenom</label>
                            <input type="text" class="form-control" id="Prenom" name="prenom"  value="{{$apprenants->prenom}}">
                          </div> 
                
                          <div class="form-group">
                            <label for="Email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="Email" name="email"  value="{{$apprenants->email}}">
                          </div> 
                          <div class="form-group">
                            <label for="Session" class="form-label">Session</label>
                            <select class="form-control" id="Session" name="session">
                                @foreach ($sessions as $session)
                                    <option value="{{ $session->id }}" {{ $apprenants->session_id == $session->id ? 'selected' : '' }}>
                                        {{ $session->nom }}
                                    </option>
                                @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="DateNaissance" class="form-label">Date de Naissance</label>
                            <input type="date" class="form-control" id="DateNaissance" name="date_naissance" value="{{ $apprenants->date_naissance }}">
                        </div>
                        
                        <div class="form-group">
                            <label for="Specialite" class="form-label">Specialite</label>
                            <select class="form-control" id="Specialite" name="specialite">
                                @foreach ($specialites as $specialite)
                                    <option value="{{ $specialite->id }}" {{ $apprenants->specialite_id == $specialite->id ? 'selected' : '' }}>
                                        {{ $specialite->nom }}
                                    </option>
                                @endforeach
                            </select>
                          </div>
                    
                        <div class="form-group">
                            <label for="Matricule" class="form-label">Matricule</label>
                            <input type="text" class="form-control" id="Matricule" name="matricule" value="{{ $apprenants->matricule }}">
                        </div>
                    
                        <div class="form-group">
                            <label for="NumeroCNI" class="form-label">Numero CNI</label>
                            <input type="text" class="form-control" id="NumeroCNI" name="numero_cni" value="{{ $apprenants->numero_cni }}">
                        </div>
                    
                        <div class="form-group">
                            <label for="DateDelivrance" class="form-label">Date de Delivrance</label>
                            <input type="date" class="form-control" id="DateDelivrance" name="date_delivrance" value="{{ $apprenants->date_delivrance }}">
                        </div>
                    
                        <div class="form-group">
                            <label for="Telephone" class="form-label">Telephone</label>
                            <input type="text" class="form-control" id="Telephone" name="telephone" value="{{ $apprenants->telephone }}">
                        </div>
                    
                        <div class="form-group">
                            <label for="NomPersonneAContacter" class="form-label">Nom Personne à Contacter</label>
                            <input type="text" class="form-control" id="NomPersonneAContacter" name="nom_personne_contact" value="{{ $apprenants->nom_personne_contact }}">
                        </div>
                    
                        <div class="form-group">
                            <label for="NumeroPersonneAContacter" class="form-label">Numero Personne à Contacter</label>
                            <input type="text" class="form-control" id="NumeroPersonneAContacter" name="numero_personne_contact" value="{{ $apprenants->numero_personne_contact }}">
                        </div>
                          <button type="submit" class="btn btn-primary">modifier mes informations</button>
                          <br><br>
                          
                        </form>
                      </div>
                    </div>
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
   
</div>   
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</html>