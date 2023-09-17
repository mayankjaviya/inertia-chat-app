<div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container-fluid">
          <a class="navbar-brand fs-3" href="#">InertiaChat</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a @class(['nav-link fs-5','active' => request()->is('/') ]) aria-current="page" href="/">Welcome</a>
              </li>
              @auth
                <li class="nav-item">
                    <a @class(['nav-link fs-5','active' => request()->is('chat*') ]) aria-current="page" href="{{  route('chat.index') }}">Chat</a>
                </li>
                @endauth
            </ul>
            <div class="d-flex">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if(auth()->check()) <span>Login as <strong>{{ currentLoginUser()->name }}</strong></span> @else Login @endif
                    </a>
                    <ul class="dropdown-menu login-dropdown" aria-labelledby="navbarDropdown" style="left:unset !important; right: 0;">
                        @foreach (AllUsers() as $user)
                            <li><a class="dropdown-item" href="/login/{{ $user['id'] }}">{{ $user['name'] }}</a></li>
                        @endforeach
                    </ul>
                  </li></ul>
              </div>
          </div>
        </div>
      </nav>
</div>
