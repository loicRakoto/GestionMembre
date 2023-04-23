<nav class="navbar navbar-expand-lg navbar-dark " style="background:#252129;">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">GESTION DES MEMBRES</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('membre.index') }}">Membres</a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link active" aria-current="page" href="{{ route('activite.index') }}">Activites</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Participation</a>
          </li>
        </ul>
        <form class="d-flex">
          
            <li class="nav-item dropdown dropstart" style="list-style: none">
                <a style="color: white" class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-right-to-bracket"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                  <li><a class="dropdown-item" href="#">S'inscrire</a></li>
                  <li>
                  <a class="dropdown-item" href="{{ route('login.logout') }}">
                  Se deconnecter
                  </a>
                  </li>
                </ul>
              </li>
        </form>
      </div>
    </div>
  </nav>