$(document).ready(function() {
    // Configuration initiale
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Variables globales
    let currentScenario = 'start';
    const messagesContainer = $('#messages');
    const optionsContainer = $('#options');
    const typingIndicator = $('#typingIndicator');

    // Fonction pour ajouter un message du bot
    function addBotMessage(message) {
        const messageElement = $(`
            <div class="message bot-message">
                <div class="text-gray-800">${message}</div>
            </div>
        `);
        messagesContainer.append(messageElement);
        scrollToBottom();
    }

    // Fonction pour ajouter les options de réponse
    function addOptions(options) {
        optionsContainer.empty();
        Object.entries(options).forEach(([key, text]) => {
            const button = $(`
                <button class="option-button" data-choice="${key}">
                    ${text}
                </button>
            `);
            optionsContainer.append(button);
        });
    }

    // Fonction pour faire défiler jusqu'au dernier message
    function scrollToBottom() {
        messagesContainer.scrollTop(messagesContainer[0].scrollHeight);
    }

    // Fonction pour simuler la frappe du bot
    function showTypingIndicator() {
        typingIndicator.removeClass('hidden');
        scrollToBottom();
    }

    function hideTypingIndicator() {
        typingIndicator.addClass('hidden');
    }

    // Fonction pour envoyer une requête au chatbot
    function sendRequest(choice = null) {
        showTypingIndicator();

        const data = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            scenario: currentScenario
        };

        if (choice) {
            data.choice = choice;
        }
        
        $.ajax({
            url: '/chatbot/query',
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
                setTimeout(() => {
                    hideTypingIndicator();
                    
                    if (response.status === 'success') {
                        addBotMessage(response.message);
                        addOptions(response.options);
                        currentScenario = choice || 'start';
                    } else {
                        addBotMessage("Désolé, une erreur est survenue. Veuillez réessayer.");
                        addOptions({ 'retour_menu': 'Retour au menu principal' });
                    }
                }, 500); // Délai artificiel pour l'effet de frappe
            },
            error: function(xhr, status, error) {
                console.error('Erreur AJAX:', error);
                console.log('Status:', status);
                console.log('Response:', xhr.responseText);
                
                hideTypingIndicator();
                addBotMessage("Désolé, une erreur de communication est survenue. Veuillez réessayer.");
                addOptions({ 'retour_menu': 'Retour au menu principal' });
            }
        });
    }

    // Gestionnaire d'événements pour les boutons d'options
    $(document).on('click', '.option-button', function() {
        const choice = $(this).data('choice');
        optionsContainer.empty(); // Désactive les boutons pendant le traitement
        sendRequest(choice);
    });

    // Animation des boutons
    $(document).on('mouseenter', '.option-button', function() {
        $(this).addClass('transform scale-105');
    }).on('mouseleave', '.option-button', function() {
        $(this).removeClass('transform scale-105');
    });

    // Initialisation du chatbot
    sendRequest();
});
