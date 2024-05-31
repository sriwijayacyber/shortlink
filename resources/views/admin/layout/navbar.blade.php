<nav class="navbar navbar-expand-lg navbar-dark bg-success py-4 px-4">
  <div class="d-flex align-items-center">
      <h2 class="fs-2 m-0 fw-bold text-warning">Affiliate Dashboard</h2>
  </div>
  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
   
  </ul>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
          aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Short Link
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="/shorturl">Short Url</a></li>
            <li><a class="dropdown-item" href="/listshort">List Shortlink</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Iklan</a>
        </li>

          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
              role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fas fa-user me-2"></i>
                  {{ Auth::user()->name }}
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Profile</a></li>
                  <li><a class="dropdown-item" href="#">Settings</a></li>
                  <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                      {{ __('Logout') }} 
                    </a>
                  
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                      </form>
                  </li>
              </ul>
          </li>
      </ul>
  </div>
</nav>