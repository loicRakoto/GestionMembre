<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h5>L'utilisateur {{ auth()->user()->name }} est connecter</h5>
    
    <form action="{{ route('login.logout') }}" method="POST">
        @csrf
    <button type="submit">Se deconnecter</button>
    </form>

</body>
</html>