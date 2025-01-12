<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Accueil</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        header {
            position: absolute;
            top: 10px;
            right: 20px;
        }

        header a {
            text-decoration: none;
            color: #fff;
            padding: 10px 20px;
            border: 2px solid #fff;
            border-radius: 25px;
            transition: background 0.3s, color 0.3s;
        }

        header a:hover {
            background: #fff;
            color: #4facfe;
        }

        h1 {
            font-size: 3rem;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        .buttons {
            display: flex;
            gap: 20px;
        }

        .buttons a {
            text-decoration: none;
            background: #4facfe;
            color: #fff;
            padding: 10px 20px;
            border: 2px solid #fff;
            border-radius: 25px;
            font-size: 1rem;
            font-weight: bold;
            transition: background 0.3s, transform 0.3s;
        }

        .buttons a:hover {
            background: #fff;
            color: #4facfe;
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <header>
        <a href="{{ route('login') }}">Connexion</a>
    </header>
    <main>
        <h1>Bienvenue</h1>
        <p>Découvrez notre chatbot éducatif et trouvez rapidement des réponses à vos questions académiques.</p>
        <div class="buttons">
            <a href="{{ route('register') }}">S'inscrire</a>
        </div>
    </main>
</body>
</html>
