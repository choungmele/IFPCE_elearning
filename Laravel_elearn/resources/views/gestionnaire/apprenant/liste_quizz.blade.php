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
            min-height: 100vh;	

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





            <h1 style="text-align:center">Mes quizz</h1>




<div class="container">

@if (session('score') && session('titre'))
<div style="font-size: 24px; font-weight: bold;">
    <p><span style="color: black;">Titre du Quizz :</span> <span style="color: blue;">{{ session('titre') }}</span></p>
    <p><span style="color: black;">Votre score :</span> <span style="color: red;">{{ session('score') }}</span><span style="color: black;">/</span><span style="color: black;">{{ session('nombre') }}</span></p>
</div>
@endif

            <table id="table" data-toggle="table" data-pagination="true" data-show-columns="true"
      data-key-events="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId"
      data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar" data-search="true"
      data-dismiss="true" class="block block-rounded table table-bordered table-striped table-vcenter ">


          {{-- <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons"> --}}

          {{-- <table id="table" class="table table-striped table-responsive mt-3 col-lg-12 bg-white fs-sm"
              style="width:100%; border:0.8px solid #fffff !important " data-search="true" data-toggle="table"> --}}

              {{-- <table id="table" class="table table-striped p-4  col-lg-12 bg-white b-table-no-border-collapse "
                style="width:100%;" data-search="true" data-toggle="table"> --}}
              <thead class="bg-black-10">
                  <tr class="text-uppercase text-center ">
                      <th class="fw-medium">#</th>
                      <th class="fw-medium">Titre</th>
                      <th class="fw-medium">Nombre de question</th>
                      <th class="fw-medium">Date de fin</th>
                  </tr>
              </thead>
              <tbody style="font-size: 14px;font-weight: 500">
                  @foreach ($quizz as $item)
                      <tr style="border: 0.2px solid #ececec; padding: 5px">
                          <td>{{ $loop->iteration }} </td>
                         
                          <td class="text-center">
                              {{ $item->titre }}
                              
                          </td>
                          <td class="text-center">
                              {{ $item->nombre }}
                              
                          </td>
                          <td class="text-center">
                              <span class="">{{ $item->delais }}</span>
                          </td>
                         
                        


                          <td class="text-center">

                              <div class="btn-group">
                                 

                                  <a href="{{ route('apprenant.composer', ['id' => $item->id, 'id_app' => $apprenant->id] ) }}">
                                      <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip"
                                          title="Composer">
                                          <i class="fa fa-book" aria-hidden="true"></i>

                                      </button>

                                  </a>&nbsp;

                              </div>
                          </td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
            
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