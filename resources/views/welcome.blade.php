<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">
    <title>Biblioteca Llum de Paraules</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Open+Sans:wght@400;600&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            color: #fff;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            background-attachment: fixed;
        }

        .navbar {
            background: rgba(0, 0, 0, 0.9) !important;
            padding: 1rem 2rem;
        }

        .navbar-brand {
            font-family: 'Poppins', sans-serif;
            font-size: 1.8rem;
            color: #ffd700 !important;
        }

        .nav-link,
        .btn-nav {
            color: #fff !important;
            font-size: 1rem;
            margin-left: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .btn-nav {
            background: #ffd700;
            color: #000 !important;
            border: none;
        }

        .nav-link:hover,
        .btn-nav:hover {
            background: #ffd700;
            color: #000 !important;
        }

        .hero-section {
            background: rgba(0, 0, 0, 0.7);
            padding: 4rem 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 3.5rem;
            color: #ffd700;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
            animation: fadeInDown 1s ease;
        }

        .subtitle {
            font-size: 1.3rem;
            max-width: 700px;
            margin: 1rem auto 2rem;
            color: #e0e0e0;
            animation: fadeInUp 1s ease 0.3s;
            animation-fill-mode: both;
        }

        .book-button {
            width: 160px;
            height: 220px;
            background-size: cover;
            background-position: center;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            text-decoration: none;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 1.1rem;
            text-shadow: 1px 1px 3px #000;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .book-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            transition: background 0.3s ease;
        }

        .book-button:hover::before {
            background: rgba(0, 0, 0, 0.2);
        }

        .book-button:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(255, 215, 0, 0.5);
        }

        .login-register-card {
            width: 100%;
            max-width: 250px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
            color: #333;
            margin: 0 auto;
        }

        .login-register-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        .login-register-card .card-body p {
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        .login-register-card .card-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: #ffd700;
            font-size: 1.2rem;
        }

        .library-info {
            background: #fff;
            color: #333;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            animation: fadeInUp 1s ease 0.5s;
            animation-fill-mode: both;
        }

        .library-info h2 {
            font-family: 'Poppins', sans-serif;
            color: #1a1a2e;
            margin-bottom: 1rem;
        }

        footer {
            margin-top: 3rem;
            font-size: 0.9rem;
            color: #ccc;
            text-align: center;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
            }

            .subtitle {
                font-size: 1.1rem;
            }

            .book-button {
                width: 240px;
                height: 220px;
            }

            .login-register-card {
                max-width: 280px;
            }
        }

        @media (max-width: 480px) {
            .navbar {
                flex-direction: column;
                gap: 1rem;
            }

            .navbar-brand {
                font-size: 1.5rem;
            }

            h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    @if(session('error'))
        <script>
            alert("{{ session('error') }}");
        </script>
    @endif

    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Biblioteca de Gandesa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-nav">
                            <i class="fas fa-sign-out-alt"></i> Tanca sessió ({{ Auth::user()->name }})
                        </button>
                    </form>
                @else
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/login"><i class="fas fa-sign-in-alt"></i> Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/registar"><i class="fas fa-user-plus"></i> Register</a>
                        </li>
                    </ul>
                @endauth
            </div>
        </div>
    </nav>

    <div class="hero-section">
        <div class="container">
            <h1 class="text-center">Biblioteca de Bta</h1>
            <p class="subtitle text-center">Endinsa't en un univers de llibres, coneixement i creativitat. La teva
                biblioteca digital de confiança.</p>

            <div class="row g-4">
                <!-- Botons de llibres -->
                <div class="col-lg-6 d-flex justify-content-center">
                    <div class="d-flex flex-wrap gap-3 justify-content-center">
                        <a href="{{ route('crud.index') }}" class="book-button"
                            style="background-image: url(img/Categories.jpg);">Llibres</a>
                        @if (Auth::check('auth') && Auth::user()->email === 'admin@admin.es')
                            <a href="{{ route('category.manage') }}" class="book-button"
                                style="background-image: url(img/Categories.jpg);">Categories</a>
                        @endif
                        @if ($llibreDestacat)
                            <a href="{{ route('crud.show', ['id' => $llibreDestacat->id]) }}" class="book-button"
                                style="background: url('{{ $backgroundImage }}'); background-size: cover;">Llibre
                                destacat</a>
                        @endif
                    </div>
                </div>

                <!-- Blocs de login/register -->
                <div class="col-lg-6 d-flex justify-content-center">
                    <div class="d-flex flex-row gap-3 align-items-center">
                        <a href="/login" class="login-link text-decoration-none">
                            <div class="login-register-card card shadow-sm" style="border: 2px solid #ffd700;">
                                <div class="card-body text-center" style="width: 200px;">
                                    <p class="mb-2">Ja tens un compte? Logeja't aquí!</p>
                                    <h5 class="card-title" style="color: #ffd700;">Logeja't</h5>
                                </div>
                            </div>
                        </a>
                        <a href="/registar" class="register-link text-decoration-none">
                            <div class="login-register-card card shadow-sm" style="border: 2px solid #ffd700;">
                                <div class="card-body text-center" style="width: 200px;">
                                    <p class="mb-2">No tens compte? Registra't ara!</p>
                                    <h5 class="card-title" style="color: #ffd700;">Registra't</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Informació de la biblioteca -->
                <div class="col-12">
                    <div class="library-info">
                        <h2 class="text-center">Sobre la Biblioteca</h2>
                        <p>La Biblioteca Llum de Paraules és un lloc on podràs explorar una gran varietat de llibres
                            digitals, des de clàssics fins a novetats. El nostre objectiu és proporcionar-te accés fàcil
                            a un món de coneixement i creativitat. Si t'agrada llegir, aquí trobaràs el teu refugi.</p>
                    </div>
                </div>
            </div>

            <footer class="mt-5">
                © {{ date('Y') }} Biblioteca Llum de Paraules · On cada llibre és una nova aventura
            </footer>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>