
<!-------------------------------------------------------------------------
   _       _    _   _____     _    _____   _       ______   __  __
  | |     | |  | | |  __ \   (_)  |  ___| | |     |  ____|  \ \/ /
  | |     | |  | | | |  \ \   _   | |__   | |     | |__      \  /
  | |     | |  | | | |   | | | |  |  __|  | |     |  __|     /  \
  | |____ | |__| | | |__/ /  | |  | |     | |____ | |____   / /\ \
  |______||______| |_____/   |_|  |_|     |______||______| /_/  \_\
 
 ----------------------------------------------------------------------->
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/login.css">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">
    <title>Login</title>
</head>
<body>
    <div class="wrapper">
        <div class="container main">
            <div class="row">
                <div class="col-md-6 side-image">
                    <!-------Image-------->
                    <img src="image/login1.png" alt="">
                    
                    <div class="text">
                      
                    </div>
                </div>
                <div class="col-md-6 right">
                     <div class="input-box">
                        <header>Se connecter</header>
                        <div>
                            @foreach ($errors->all() as $item)
                                {{ $item }}
                            @endforeach
                        </div>
                        <form action="{{ route('login.authenticate') }}" method="post">
                            @csrf
                            <div class="input-field">
                                <input name="email" type="text" class="input" id="email" >
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field">
                                <input name="password" type="password" class="input" id="password" >
                                <label for="password">Password</label>
                            </div>
                            <div class="input-field">
                                <input type="submit" class="submit" value="Log in">   
                            </div>
                        </form>
                        <div class="signin">
                            <span>You dont have an account? <a href="#">Sign in here</a></span>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>