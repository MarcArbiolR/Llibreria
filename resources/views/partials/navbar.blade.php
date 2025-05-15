<!-- filepath: c:\xampp\htdocs\DWES\AEA2\Llibreria\resources\views\partials\navbar.blade.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/" style="color:#777"><span style="font-size:15pt">&#128214;</span> Llibreria</a>
        <a href="/llibres" style="color: grey"> Inici </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        @php
            $categories = \App\Models\Category::all();
        @endphp
        @if(Auth::check())

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <!-- Dropdown de Categories -->
                    <div class="dropdown">
                        <button class="btn btn-link nav-link dropdown-toggle" type="button" id="userDropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Categories
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <ul style="list-style-type:none; padding:0; margin:0;">
                                <li>
                                    <a class="dropdown-item" href="{{ route('crud.index') }}">
                                        Tots els llibres
                                    </a>
                                <li>
                                    @foreach($categories as $category)

                                        <a class="dropdown-item"
                                            href="{{ route('crud.index', ['categoria' => $category->id]) }}">
                                            {{ $category->name }}
                                        </a>

                                    @endforeach
                                </li>

                            </ul>
                        </div>
                    </div>

                    <!-- Opcions per a l'admin -->
                    @if (Auth::user()->email == 'admin@admin.es')
                        <div class="dropdown">
                            <button class="btn btn-link nav-link dropdown-toggle" type="button" id="adminDropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Administració
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="adminDropdown">
                                <a class="dropdown-item {{ Request::is('/create') ? 'active' : ''}}"
                                    href="{{ url('/llibre/create') }}">
                                    <span>&#10010;</span> Nou llibre
                                </a>
                                <a class="dropdown-item {{ Request::is('category/create') ? 'active' : ''}}"
                                    href="{{ url('/category/create') }}">
                                    <span>&#10010;</span> Nova categoria
                                </a>
                                <a class="dropdown-item {{ Request::is('/categories/gestio') ? 'active' : ''}}"
                                    href="{{ url('/categories/gestio') }}">
                                    <span>&#9881;</span> Gestionar categories
                                </a>
                                <a class="dropdown-item {{ Request::is('/categories/gestio') ? 'active' : ''}}"
                                    href="{{ url('/users/gestio') }}">
                                    <span>&#9881;</span> Gestió d'usuaris
                                </a>
                            </div>
                        </div>
                    @endif
                </ul>
                @if(Auth::check())
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <div class="dropdown">
                            <button class="btn btn-link nav-link dropdown-toggle" type="button" id="userDropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Benvingut, {{ Auth::user()->name }}
                            </button>
                            <!-- Afegim la classe 'dropdown-menu-right' per alinear el dropdown a la dreta -->
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                <!-- Botó de Perfil -->
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Perfil') }}</a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                                    @csrf
                                    <button class="dropdown-item" type="submit">{{ __('Tancar sessió') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>

                @endif



            </div>
        @endif
    </div>
</nav>