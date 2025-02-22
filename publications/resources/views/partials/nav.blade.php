<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">Social Network</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <ul class="navbar-nav">
          <li class="nav-item">    
            <a class="nav-link {{ request()->routeIs("homepage")  ? "active fw-bold" : " " }}" href="{{ route('homepage') }}">Acceuil</a>          
          </li>
          {{-- guest : if user is not authentificated   --}}
          @guest
          <li class="nav-item">    
            <a class="nav-link {{ request()->routeIs("login.show")  ? "active fw-bold" : " " }}" href="{{ route('login.show') }}">Se connecter</a>          
          </li>
          @endguest
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs("profiles.index")  ? "active fw-bold" : " " }} " href="{{ route('profiles.index') }}">Tous les profiles</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs("settings.index") ? "active fw-bold" : " " }}" href="{{ route('settings.index') }}">mes info</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs("profiles.create")  ? "active fw-bold" : " " }}" href="{{ route('profiles.create') }}">Ajouter Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs("publications.create")  ? "active fw-bold" : " " }}" href="{{ route('publications.create') }}">Ajouter publication</a>
          </li>
        </ul>
        {{-- auth : if user is authentificated   --}}
        @auth
        <div class="dropdown">
          <button class="btn bg-black text-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ auth()->user()->name }}
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li class="nav-item {{ request()->routeIs("login.logout")  ? "active fw-bold" : " " }}">    
              <a class="dropdown-item" href="{{ route('login.logout') }}">deconnecter</a>          
            </li>
          </ul>
        </div>
        @endauth
      </div>
    </div>
</nav>

{{-- to execute the code just once --}}
@once
    <script>
        // alert('hi')
    </script>
@endonce