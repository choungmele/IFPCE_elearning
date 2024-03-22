<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>IFPCE E-LEARNING</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="icon" href="{{ asset('images/ifpce.jpg') }}" type="image/x-icon">
   
</head>
  </head>
  <body>
    <nav class="navbar bg-primary" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand">IFPCE</a>
        <img src="{{ asset('images/ifpce.jpg') }}" alt="brochure" class="img-fluid" />
        <form class="d-flex" role="search">
          <a href="{{url('/login')}}">Se connecter</a>
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        
        
      </div>
    </nav>
   
 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>