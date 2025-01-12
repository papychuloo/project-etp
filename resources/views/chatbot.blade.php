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
            background: var(--background-color);
            color: var(--text-color);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        :root {
            --background-color: #ffffff;
            --text-color: #333333;
            --chat-bg: #f0f0f0;
            --button-bg: #2575fc;
            --button-hover: #6a11cb;
        }

        .dark-mode {
            --background-color: #1c1c1c;
            --text-color: #ffffff;
            --chat-bg: #333333;
            --button-bg: #6a11cb;
            --button-hover: #2575fc;
        }

        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
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

        .theme-toggle {
            background-color: #2575fc;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            border: none;
            transition: background-color 0.3s ease;
        }

        .theme-toggle:hover {
            background-color: #6a11cb;
        }

        h1 {
            margin: 100px 0 20px;
            font-size: 2.5rem;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }

        .chat-container {
            background: var(--chat-bg);
            padding: 20px;
            border-radius: 15px;
            width: 90%;
            max-width: 500px;
            text-align: center;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        .chat-bubble {
            display: flex;
            align-items: center;
            margin: 10px 0;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #2575fc;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            margin-right: 10px;
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
        }

        button {
            background-color: var(--button-bg);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background-color: var(--button-hover);
        }

        p#response {
            margin-top: 20px;
            font-size: 1.2rem;
            background: rgba(255, 255, 255, 0.2);
            padding: 10px;
            border-radius: 10px;
            word-wrap: break-word;
        }

        .loading {
            animation: fade-in-out 1s infinite;
        }

        @keyframes fade-in-out {
            0%, 100% {
                opacity: 0.5;
            }
            50% {
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <!-- Barre de navigation -->
    <div class="navbar">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Déconnexion</button>
        </form>
        <button class="theme-toggle" onclick="toggleTheme()">Thème</button>
    </div>

    <!-- Titre principal -->
    <h1>Chatbot Éducatif</h1>

    <!-- Conteneur du chatbot -->
    <div class="chat-container">
        <div class="chat-bubble">
            <div class="avatar">🤖</div>
            <p id="response" class="loading">Le chatbot est prêt à répondre !</p>
        </div>
        <input id="question" type="text" placeholder="Posez votre question ici 😊" aria-label="Entrez votre question" />
        <button onclick="sendQuestion()">Envoyer</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // Basculer entre thème clair et sombre
        function toggleTheme() {
            document.body.classList.toggle('dark-mode');
        }

        async function sendQuestion() {
            const question = document.getElementById('question').value;
            const responseElement = document.getElementById('response');

            if (!question.trim()) {
                responseElement.textContent = "Veuillez entrer une question.";
                return;
            }

            responseElement.textContent = "Chargement...";
            responseElement.classList.add('loading');

            try {
                const response = await axios.post('/chatbot/query', {
                    question: question
                }, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                responseElement.classList.remove('loading');

                if (response.data.answer) {
                    responseElement.textContent = response.data.answer;
                } else {
                    responseElement.textContent = "Je ne connais pas encore la réponse à cette question.";
                }
            } catch (error) {
                responseElement.classList.remove('loading');
                responseElement.textContent = "Une erreur est survenue. Veuillez réessayer.";
            }
        }
    </script>
</body>


</html>
