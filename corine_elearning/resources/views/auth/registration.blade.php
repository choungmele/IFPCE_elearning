<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>IFPCE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4" style="margin-top:20px;">
                <h4>FORMULAIRE D'INSCRIPTION</h4>
                <hr>
                <form action="{{route('register-user')}}" method="POST">
                    @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    @csrf
                    <div class="form-group">
                        <label for="name">Nom</label>
                        <input type="text" class="form-control" placeholder="enter full name"
                        name="name" value="{{old('name')}}">
                        <span class="text-danger">@error('name'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="surname">Prenom</label>
                        <input type="text" class="form-control" placeholder="enter full surname"
                        name="surname" value="{{old('surname')}}">
                        <span class="text-danger">@error('surname'){{$message}}@enderror</span>
                    </div>  
                    <div class="form-group">
                        <label for="birth">Date de Naissance</label>
                        <input type="date" class="form-control" placeholder="enter full surname"
                        name="birth" value="{{old('birth')}}">
                        <span class="text-danger">@error('date'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="contact">Telephone</label>
                        <input type="text" class="form-control" placeholder="numero de telephone"
                        name="contact" value="{{old('contact')}}">
                        <span class="text-danger">@error('contact'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="contacts">WhatsApp</label>
                        <input type="text" class="form-control" placeholder="numero de telephone"
                        name="contacts" value="{{old('contacts')}}">
                        <span class="text-danger">@error('contacts'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="pays">Pays de Residence</label>
                        <input type="text" class="form-control" placeholder="enter full surname"
                        name="pays" value="{{old('pays')}}">
                        <span class="text-danger">@error('pays'){{$message}}@enderror</span>
                    </div> 
                    <div class="form-group">
                        <label for="email">email</label>
                        <input type="text" class="form-control" placeholder="enter your email"
                        name="email" value="{{old('email')}}">
                        <span class="text-danger">@error('email'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="password">password</label>
                        <input type="password" class="form-control" placeholder="enter your password"
                        name="password" value="{{old('password')}}">
                        <span class="text-danger">@error('password'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="occupation">Profession</label>
                        <input type="text" class="form-control" placeholder="enter full surname"
                        name="occupation" value="{{old('occupation')}}">
                        <span class="text-danger">@error('occupation'){{$message}}@enderror</span>
                    </div> 
                    <div class="form-group">
                        <label for="cni">Numero CNI</label>
                        <input type="text" class="form-control" placeholder="enter full surname"
                        name="cni" value="{{old('cni')}}">
                        <span class="text-danger">@error('cni'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="delivrance">Date de Delivrance</label>
                        <input type="date" class="form-control" placeholder="enter full surname"
                        name="delivrance" value="{{old('delivrance')}}">
                        <span class="text-danger">@error('delivrance'){{$message}}@enderror</span>
                    </div>  
                    <br>
                    <div class="form-group">
                        <button class="btn btn-block btn-primary" type="submit">Register</button>
                    </div>
                    <br>
                    <a href="login">Already register!! Login Here</a>
                </form>
            </div>
        </div>
    </div>
    
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</html>