<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Simulador de Crédito</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">

            {{-- LOGO / HOME --}}
            <a class="navbar-brand fw-bold" href="#">
                ValCredit
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                {{-- MENÚ IZQUIERDA --}}
                <ul class="navbar-nav me-auto">

                    {{-- Link público / según rol --}}
                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{ auth()->check()
                                ? (auth()->user()->role === 'admin'
                                    ? route('admin.dashboard')
                                    : route('dashboard'))
                                : route('simulator') }}">
                            Inicio
                        </a>
                    </li>


                    {{-- SOLO ADMIN --}}
                    @auth
                        @if (auth()->user()->role === 'admin')
                            <li class="nav-item">
                                <a class="navbar-brand fw-bold"
                                    href="{{ auth()->check()
                                        ? (auth()->user()->role === 'admin'
                                            ? route('admin.dashboard')
                                            : route('simulator'))
                                        : route('login') }}">
                                </a>

                            </li>
                        @endif
                    @endauth

                </ul>

                {{-- MENÚ DERECHA --}}
                <ul class="navbar-nav ms-auto">

                    {{-- INVITADO --}}
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @endguest

                    {{-- USUARIO LOGUEADO --}}
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                👤 {{ auth()->user()->name }}
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item text-danger">
                                            Cerrar sesión
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth

                </ul>
            </div>
        </div>
    </nav>



    <div class="container">
        @yield('content')
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- JS opcional del simulador --}}
    @if (file_exists(public_path('js/simulator.js')))
        <script src="{{ asset('js/simulator.js') }}"></script>
    @endif

    @yield('scripts')

</body>

</html>
