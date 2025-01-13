<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot Éducatif</title>
    <link rel="stylesheet" href="css/style.css">
   
</head>

<body>
   
    <div class="navbar">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Déconnexion</button>
        </form>
        <button class="theme-toggle" onclick="toggleTheme()">Thème</button>
    </div>

   
    <h1>Chatbot Éducatif</h1>

    
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
