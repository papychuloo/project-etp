<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #1fa2ff, #12d8fa, #a6ffcb);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        .register-container {
            background: rgba(0, 0, 0, 0.6);
            padding: 20px 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            text-align: center;
            width: 90%;
            max-width: 400px;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 2rem;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 25px;
            outline: none;
            font-size: 1rem;
        }

        button {
            background-color: #6a11cb;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }

        button:hover {
            background-color: #2575fc;
        }

        .error {
            background: rgba(255, 0, 0, 0.1);
            color: #ff0000;
            padding: 5px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h1>Inscription</h1>

        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Nom complet" required />
            <input type="email" name="email" placeholder="Adresse e-mail" required />
            <input type="password" name="password" placeholder="Mot de passe" required />
            <input type="password" name="password_confirmation" placeholder="Confirme ton mot de passe" required />
            <button type="submit">S'inscrire</button>
        </form>
        <p>Tu as déjà un compte ? <a href="{{ route('login') }}" style="color: #00f;">Connecte-toi ici</a>.</p>
    </div>
</body>
</html>
