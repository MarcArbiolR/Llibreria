<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Llum de Paraules</title>
    <style>
        /* Estils principals */
        body {
            margin: 0;
            padding: 0;
            background-color: #ADD8E6;
            /* Fons blau clar */
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

        /* Estils per als botons */
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

        .buttons {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            flex-wrap: wrap;
            margin-bottom: 2rem;
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

        /* Estils per als blocs de login i registre */
        .login-register-blocks {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            margin-bottom: 2rem;
        }

        .login-register-block {
            color: black;
            display: inline-block;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #fff;
            padding: 1rem;
            border-radius: 10px;
            width: 200px;
            box-shadow: 0px 14px 34px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        /* Imatges dels blocs de login i registre */
        .login-register-block img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }

        /* Efecte hover sobre els blocs de login i registre */
        .login-register-block:hover {
            transform: translateY(-10px);
            /* Mou els blocs cap amunt */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            /* Augmenta l'ombra */
            text-decoration: underline;
        }

        /* Secció sobre la biblioteca */
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

        /* Peu de pàgina */
        footer {
            margin-top: 3rem;
            font-size: 0.9rem;
            color: #ccc;
        }
    </style>
</head>

<body>
    @if(session('error'))
        <script>
            alert("{{ session('error') }}");
        </script>
    @endif

    <div class="overlay">
        <h1>Biblioteca de Batea</h1>
        <p class="subtitle">Endinsa't en un univers de llibres, coneixement i creativitat. La teva biblioteca digital de
            confiança.</p>

        <div class="buttons">

            <a href="{{ route('crud.index') }}" class="book-button"
                style="background-image: url(img/Categories.jpg);  background-size: 400px auto;">Categories</a>

            @if ($llibreDestacat)
                <a href="{{ route('crud.show', ['id' => $llibreDestacat->id]) }}" class="book-button"
                    style="background: url('{{ $backgroundImage }}'); background-size: 140px auto;">
                    Llibre destacat
                </a>
            @endif
        </div>

        <div class="login-register-blocks">
            <a href="/login" class="login-link">
                <div class="login-register-block" style="text-align: center; margin-top: 35px;">
                    <p>Ja tens un compte? Logeja't aquí!</p>
                    <img src="{{ asset('img/login.png') }}" alt="Login" style="width: 60px; height: 60px;"> <br>
                    <span>Logeja't</span>
                </div>
            </a>

            <a href="/register" class="register-link">
                <div class="login-register-block" style="text-align: center; margin-top: 35px;">
                    <p>No tens compte? Registra't ara!</p>
                    <img src="{{ asset('img/register.jpg') }}" alt="Register" style="width: 60px; height: 60px;"> <br>
                    <span>Registra't</span>
                </div>
            </a>
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