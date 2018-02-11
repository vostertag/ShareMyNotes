<nav class="navbar navbar-expand-lg navbar-dark bg-dark header fixed-top">
  <button class="navbar-toggler btn-toggle" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="{{ route('home') }}">
    <img src="/images/bbLogo.png" width="30" height="30" class="d-inline-block align-top" alt="">
    ShareMyNotes
  </a>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('account') }}"><i class="fas fa-user-circle fa-lg"></i> My account</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt fa-lg"></i> Log out</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="{{ route('searchNote') }}" method='POST'>
      {{ csrf_field() }}
      <input name="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>