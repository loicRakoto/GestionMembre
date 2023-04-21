
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/login.css">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">
    <script src="{{ asset('/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('/jquery/JQuery.js') }}"></script>
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
                        <header class="head-formu-cnct">Se connecter</header>
                        <div class="afferror" style="display: none">
                    
                           
                                <div class="toast show" style="position: absolute; z-index: 10; top: 15px; right: 15px;">
                                <div class="toast-header">
                                  <strong class="me-auto">Information</strong>
                                  <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                                </div>
                                <div class="toast-body">
                                   
                                </div>
                                </div>
                                
                        </div>
                        <div class="form-connection">
                            <form id="formcnct" action="{{ route('login.authenticate') }}" method="post">
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
                        </div>
                        <div class="form-inscription" style="display: none">
                            <form id="formInscr" action="{{ route('user.store') }}" method="post">
                                @csrf
                                <div class="input-field">
                                    <input name="pseudoInscr" type="text" class="input" id="pseudo" >
                                    <label for="pseudo">Pseudo</label>
                                </div>
                                <div class="input-field">
                                    <input name="emailInscr" type="text" class="input" id="emailInscr" >
                                    <label for="email">Email</label>
                                </div>
                                <div class="input-field">
                                    <input name="passwordInscr" type="password" class="input" id="passwordInscr" >
                                    <label for="passwordInscr">Password</label>
                                </div>
                                <div class="input-field">
                                    <input name="confirmpasswordInscr" type="password" class="input" id="confirmpasswordInscr" >
                                    <label for="confirmpasswordInscr">Confirm Password</label>
                                </div>
                                <div class="input-field">
                                    <input type="submit" class="submit" value="Sign up">   
                                </div>
                            </form>
                        </div>

                        <div class="signin">
                            <span class="inscr">Vous avez n'avez pas encore un compte ? <a href="#">Inscrivez vous ici</a></span>
                            <span class="connect" style="display:none" class="connect">Vous avez déja un compte ? <a href="#"> Se connecter </a></span>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/loginPubic.js"></script>
 
</body>
</html>