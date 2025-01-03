function toggleChat() {
    const chatWindow = document.getElementById('chatWindow');
    chatWindow.style.display = chatWindow.style.display === 'none' || chatWindow.style.display === '' ? 'block' : 'none';
}

function sendMessage() {
    const userInput = document.getElementById('userInput');
    const message = userInput.value;
    if (message.trim() === '') return;

    appendMessage('User ', message);
    userInput.value = '';

    // Simulate bot response
    setTimeout(() => {
        appendMessage('Bot', 'You said: ' + message);
    }, 1000);
}

function sendQuickReply(reply) {
    appendMessage('User ', reply);

    // Simulate bot response
    setTimeout(() => {
        appendMessage('Bot', 'You asked: ' + reply);
    }, 1000);
}

function appendMessage(sender, message) {
    const chatMessages = document.getElementById('chatMessages');
    const messageElement = document.createElement('div');
    messageElement.textContent = `${sender}: ${message}`;
    chatMessages.appendChild(messageElement);
}