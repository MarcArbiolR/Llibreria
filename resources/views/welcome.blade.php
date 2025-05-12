<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Llum de Paraules</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url("img/Fons.jpg");
            font-family: 'Georgia', serif;
            color: #fff;
            text-align: center;
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.6);
            min-height: 100vh;
            padding: 4rem 1rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        h1 {
            font-size: 3rem;
            margin-bottom: 0.5rem;
        }

        p.subtitle {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .book-button {
            width: 140px;
            height: 200px;
            background-size: cover;
            border: none;
            color: #fff;
            font-weight: bold;
            font-size: 1rem;
            text-shadow: 1px 1px 2px #000;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            text-decoration: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .book-button:hover {
            transform: scale(1.05);
            box-shadow: 0 0 10px #fff;
        }

        .main-content {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .left-section {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            flex-wrap: wrap;
            margin-top: 25px;
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }

        .right-section {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            min-width: 300px;
        }

        .login-register-blocks {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            align-items: stretch;
            margin-bottom: 2rem;
        }

        .login-register-block.large {
            width: 250px;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            text-align: center;
            background-color: #fff;
            color: black;
            border-radius: 10px;
            box-shadow: 0px 14px 34px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-register-block.large img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }

        .login-register-block.large:hover {
            transform: translateY(-10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            text-decoration: underline;
        }

        .library-info {
            background-color: white;
            color: black;
            padding: 2rem;
            border-radius: 10px;
            margin-top: 2rem;
            text-align: left;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        footer {
            margin-top: 3rem;
            font-size: 0.9rem;
            color: #ccc;
        }

        @media (max-width: 768px) {
            .main-content {
                flex-direction: column;
                align-items: center;
            }

            .left-section,
            .right-section {
                flex: unset;
                width: 100%;
                justify-content: center;
            }

            .buttons {
                justify-content: center;
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
    <nav
        style="background-color: rgba(0,0,0,0.8); padding: 1rem; display: flex; justify-content: space-between; align-items: center;">
        <div style="font-size: 1.5rem; color: white; font-weight: bold;">
            Biblioteca de Batea
        </div>

        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    style="background-color: #fff; color: black; border: none; padding: 0.5rem 1rem; border-radius: 5px; cursor: pointer;">
                    Tanca sessió ({{ Auth::user()->name }})
                </button>
            </form>
        @else
            <div>
                <a href="/login" style="color: white; margin-right: 1rem;">Login</a>
                <a href="/register" style="color: white;">Register</a>
            </div>
        @endauth
    </nav>

    <div class="overlay">
        <h1>Biblioteca de Batea</h1>
        <p class="subtitle">Endinsa't en un univers de llibres, coneixement i creativitat. La teva biblioteca digital de
            confiança.</p>

        <div class="main-content">
            <div class="left-section">
                <div class="buttons">
                    <a href="{{ route('crud.index') }}" class="book-button"
                        style="background-image: url(img/Categories.jpg); background-size: 400px auto;">Llibres</a>

                    @if (Auth::check('auth') && Auth::user()->email === 'admin@admin.es')
                        <a href="{{ route('category.manage') }}" class="book-button"
                            style="background-image: url(img/Categories.jpg); background-size: 400px auto;">Categories</a>
                    @endif

                    @if ($llibreDestacat)
                        <a href="{{ route('crud.show', ['id' => $llibreDestacat->id]) }}" class="book-button"
                            style="background: url('{{ $backgroundImage }}'); background-size: 140px auto;">
                            Llibre destacat
                        </a>
                    @endif
                </div>
            </div>

            <div class="right-section">
                <div class="login-register-blocks">
                    <a href="/login" class="login-link">
                        <div class="login-register-block large">
                            <p>Ja tens un compte? Logeja't aquí!</p>
                            <img src="{{ asset('img/login.png') }}" alt="Login">
                            <span>Logeja't</span>
                        </div>
                    </a>
                    <a href="/register" class="register-link">
                        <div class="login-register-block large">
                            <p>No tens compte? Registra't ara!</p>
                            <img src="{{ asset('img/register.jpg') }}" alt="Register">
                            <span>Registra't</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="library-info">
            <h2 style="text-align: center">Sobre la Biblioteca</h2>
            <p>La Biblioteca Llum de Paraules és un lloc on podràs explorar una gran varietat de llibres digitals, des
                de clàssics fins a novetats. El nostre objectiu és proporcionar-te accés fàcil a un món de coneixement i
                creativitat. Si t'agrada llegir, aquí trobaràs el teu refugi.</p>
        </div>

        <footer>
            &copy; {{ date('Y') }} Biblioteca Llum de Paraules · On cada llibre és una nova aventura
        </footer>
    </div>
</body>

</html>