<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot Éducatif</title>
    <style>
        /* Global Styles */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow: hidden;
        }

        /* Barre de navigation */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 10px 20px;
            z-index: 1000;
        }

        .navbar button {
            background-color: #ff4d4d;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .navbar button:hover {
            background-color: #e63939;
        }

        h1 {
            margin: 60px 0 20px;
            font-size: 3rem;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }

        .chat-container {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            width: 90%;
            max-width: 500px;
            text-align: center;
            animation: fadeInUp 2s ease forwards;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(50px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        input[type="text"] {
            width: 80%;
            padding: 10px 15px;
            border: none;
            border-radius: 25px;
            margin-bottom: 15px;
            font-size: 1rem;
            outline: none;
            color: #333;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s;
        }

        input[type="text"]:focus {
            transform: scale(1.05);
        }

        button {
            background-color: #2575fc;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background-color: #6a11cb;
            transform: scale(1.1);
        }

        p#response {
            margin-top: 20px;
            font-size: 1.2rem;
            background: rgba(255, 255, 255, 0.2);
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            word-wrap: break-word;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
        }

        p#response.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>

<body>
    <!-- Barre de navigation -->
    <div class="navbar">
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit">Déconnexion</button>
        </form>
    </div>

    <!-- Contenu principal -->
    <h1>Bienvenue sur le Chatbot Éducatif</h1>
    <div class="chat-container">
        <input id="question" type="text" placeholder="Pose ta question ici" />
        <button onclick="sendQuestion()">Envoyer</button>
        <p id="response"></p>
    </div>

    <script>
        async function sendQuestion() {
            const question = document.getElementById('question').value;
            const responseElement = document.getElementById('response');

            if (!question.trim()) {
                responseElement.textContent = "Veuillez entrer une question.";
                responseElement.classList.add('show');
                return;
            }

            // Simulate loading
            responseElement.textContent = "Chargement...";
            responseElement.classList.add('show');

            try {
                const response = await fetch('/chatbot/query', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({
                        question
                    }),
                });

                if (response.ok) {
                    const data = await response.json();
                    responseElement.textContent = data.answer || "Aucune réponse disponible.";
                } else {
                    responseElement.textContent = "Erreur lors de la communication avec le serveur.";
                }
            } catch (error) {
                responseElement.textContent = "Une erreur est survenue.";
            }
        }
    </script>
</body>

</html>
