<template>
  <div class="chatbot-container">
    <div class="chat-messages" ref="messagesContainer">
      <div v-for="(message, index) in messages" :key="index" 
           :class="['message', message.type]">
        <div class="message-content">{{ message.text }}</div>
      </div>
    </div>
    <div class="chat-input">
      <input type="text" v-model="userInput" 
             @keyup.enter="sendMessage" 
             placeholder="Tapez votre message ici..."
             :disabled="isLoading">
      <button @click="sendMessage" 
              :disabled="isLoading || !userInput.trim()">
        {{ isLoading ? '...' : 'Envoyer' }}
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Chatbot',
  data() {
    return {
      messages: [
        { 
          type: 'bot', 
          text: 'Bonjour! Je suis votre assistant. Comment puis-je vous aider?' 
        }
      ],
      userInput: '',
      isLoading: false
    }
  },
  methods: {
    async sendMessage() {
      if (!this.userInput.trim() || this.isLoading) return;

      const userMessage = this.userInput.trim();
      this.messages.push({ type: 'user', text: userMessage });
      this.userInput = '';
      this.isLoading = true;

      try {
        const response = await fetch('/api/chatbot/query', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify({ message: userMessage })
        });

        const data = await response.json();

        if (data.status === 'success') {
          this.messages.push({ type: 'bot', text: data.response });
        } else {
          throw new Error(data.message || 'Une erreur est survenue');
        }
      } catch (error) {
        this.messages.push({ 
          type: 'error', 
          text: 'Désolé, je ne peux pas répondre pour le moment. Veuillez réessayer.' 
        });
        console.error('Chatbot error:', error);
      } finally {
        this.isLoading = false;
        this.$nextTick(() => {
          this.scrollToBottom();
        });
      }
    },
    scrollToBottom() {
      const container = this.$refs.messagesContainer;
      container.scrollTop = container.scrollHeight;
    }
  },
  mounted() {
    this.scrollToBottom();
  }
}
</script>

<style scoped>
.chatbot-container {
  max-width: 600px;
  margin: 20px auto;
  border: 1px solid #ddd;
  border-radius: 8px;
  background: #fff;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.chat-messages {
  height: 400px;
  overflow-y: auto;
  padding: 20px;
  background: #f8f9fa;
}

.message {
  margin-bottom: 15px;
  max-width: 80%;
  padding: 10px 15px;
  border-radius: 15px;
  line-height: 1.4;
}

.message.user {
  margin-left: auto;
  background: #007bff;
  color: white;
  border-bottom-right-radius: 5px;
}

.message.bot {
  margin-right: auto;
  background: white;
  border: 1px solid #ddd;
  border-bottom-left-radius: 5px;
}

.message.error {
  margin-right: auto;
  background: #dc3545;
  color: white;
  border-bottom-left-radius: 5px;
}

.chat-input {
  display: flex;
  padding: 15px;
  background: white;
  border-top: 1px solid #ddd;
}

input {
  flex: 1;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 4px;
  margin-right: 10px;
}

button {
  padding: 10px 20px;
  background: #007bff;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background 0.2s;
}

button:hover:not(:disabled) {
  background: #0056b3;
}

button:disabled {
  background: #ccc;
  cursor: not-allowed;
}
</style>
