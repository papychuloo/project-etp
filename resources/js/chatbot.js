document.addEventListener('DOMContentLoaded', function() {
    const chatMessages = document.getElementById('chat-messages');
    const chatForm = document.getElementById('chat-form');
    const messageInput = document.getElementById('message-input');
    let currentScenario = 'start';

    // Fonction pour ajouter un message au chat
    function addMessage(message, isUser = false) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${isUser ? 'user-message' : 'bot-message'}`;
        
        const messageContent = document.createElement('p');
        messageContent.textContent = message;
        messageDiv.appendChild(messageContent);
        
        if (!isUser) {
            // Ajouter les boutons de feedback pour les messages du bot
            const feedbackContainer = document.createElement('div');
            feedbackContainer.className = 'feedback-container';
            
            const helpfulButton = document.createElement('button');
            helpfulButton.className = 'feedback-button';
            helpfulButton.textContent = '';
            helpfulButton.onclick = () => markMessageHelpful(messageDiv, helpfulButton);
            
            feedbackContainer.appendChild(helpfulButton);
            messageDiv.appendChild(feedbackContainer);
        }
        
        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Fonction pour marquer un message comme utile
    async function markMessageHelpful(messageDiv, button) {
        try {
            const response = await fetch('/chatbot/mark-helpful', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();
            
            if (data.status === 'success') {
                button.classList.add('active');
                button.disabled = true;
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }

    // Fonction pour ajouter les boutons d'options
    function addOptions(options) {
        const optionsDiv = document.createElement('div');
        optionsDiv.className = 'options-buttons';
        
        Object.entries(options).forEach(([value, text]) => {
            const button = document.createElement('button');
            button.className = 'option-button';
            button.textContent = text;
            button.onclick = () => handleOptionClick(value);
            optionsDiv.appendChild(button);
        });
        
        const messageDiv = document.createElement('div');
        messageDiv.className = 'message bot-message';
        messageDiv.appendChild(optionsDiv);
        
        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Fonction pour gérer le clic sur une option
    async function handleOptionClick(choice) {
        try {
            const response = await fetch('/chatbot/query', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    scenario: currentScenario,
                    choice: choice
                })
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();
            
            if (data.status === 'success') {
                // Ajouter le choix de l'utilisateur comme message
                const selectedOption = document.querySelector(`.option-button[data-value="${choice}"]`)?.textContent || choice;
                addMessage(selectedOption, true);
                
                // Ajouter la réponse du bot
                addMessage(data.message);
                
                // Mettre à jour le scénario actuel
                currentScenario = data.scenario;
                
                // Ajouter les nouvelles options
                if (data.options) {
                    addOptions(data.options);
                }
            } else {
                addMessage("Désolé, une erreur est survenue. Veuillez réessayer.");
            }
        } catch (error) {
            console.error('Error:', error);
            addMessage("Désolé, une erreur est survenue. Veuillez réessayer.");
        }
    }

    // Gérer la soumission du formulaire
    chatForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        const message = messageInput.value.trim();
        
        if (message) {
            addMessage(message, true);
            messageInput.value = '';
            
            try {
                const response = await fetch('/chatbot/query', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        scenario: currentScenario,
                        message: message
                    })
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();
                
                if (data.status === 'success') {
                    addMessage(data.message);
                    if (data.options) {
                        addOptions(data.options);
                    }
                    currentScenario = data.scenario;
                } else {
                    addMessage("Désolé, je n'ai pas compris votre demande. Pouvez-vous reformuler ?");
                }
            } catch (error) {
                console.error('Error:', error);
                addMessage("Désolé, une erreur est survenue. Veuillez réessayer.");
            }
        }
    });

    // Initialiser le chatbot avec le message de bienvenue
    handleOptionClick('start');
});
