@extends('layouts.app')
@section('title', 'Chating')

@section('content')
<div class="flex-1 flex w-full h-full p-3 md:p-2 gap-4 pt-2 pb-20 md:pb-0">
    <!-- Sidebar Kontak -->
    <div id="chat-list-panel" class="w-full md:w-1/3 bg-white border-2 border-dark rounded-playful-lg flex flex-col overflow-hidden shadow-border-offset-lg mt-1 md:mt-0 z-10">
        <div class="p-3 border-b-2 border-dark flex items-center bg-white">
            <h2 class="text-xl font-bold font-exo2">Chating</h2>
        </div>
        <div class="flex flex-col p-2 overflow-y-auto space-y-2">
            <!-- Kontak-kontak psikolog -->
            <a href="{{ route('chat') }}" class="user-list-item flex items-center p-3 rounded-playful-sm bg-primary border-2 border-dark shadow-border-offset">
                <div class="w-10 h-10 rounded-full bg-dark flex items-center justify-center text-white mr-3">
                    <i class="fas fa-user text-lg"></i>
                </div>
                <div class="flex-1">
                    <h3 class="font-bold text-dark font-exo2">Konseling dengan ahli</h3>
                    <p class="text-xs text-dark">Curahkan semua masalah mu ke ahli</p>
                </div>
            </a>
            <div class="contact flex items-center p-3 rounded-playful-sm bg-primary border-2 border-dark shadow-border-offset cursor-pointer" data-model="friendly-listener">
                <div class="w-10 h-10 rounded-full bg-dark flex items-center justify-center text-white mr-3">
                    <i class="fas fa-robot text-lg"></i>
                </div>
                <div class="flex-1">
                    <h3 class="contact-name font-bold text-dark font-exo2">Nemo</h3>
                    <p class="text-xs text-dark">Pendengar Ramah</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Area Chat Utama -->
    <div id="chat-window-panel" class="flex-1 hidden md:flex flex-col bg-white border-2 border-dark rounded-playful-lg flex-col overflow-hidden shadow-border-offset-lg mt-1 md:mt-0 z-10">
        <!-- Header Chat -->
        <div class="p-4 border-b-2 border-dark bg-white flex items-center z-20 sticky top-0">
            <div class="current-contact-avatar w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white mr-3 border-2 border-dark">
                <i class="fas fa-robot text-lg"></i>
            </div>
            <div class="current-contact-info flex-1">
                <h3 class="font-bold text-lg font-exo2 text-dark">Nemo</h3>
                <p class="text-sm text-gray-600">Online - Pendengar Ramah</p>
            </div>
        </div>

        <!-- Area Pesan -->
        <div id="messages" class="flex-1 p-4 overflow-y-auto space-y-4 bg-gray-50">
            <!-- Pesan akan ditambahkan secara dinamis oleh JavaScript -->
        </div>

        <!-- Input Pesan -->
        <div class="p-4 border-t-2 border-dark bg-white z-10 flex items-center space-x-3 chat-input-container">
            <input id="userInput" type="text" placeholder="Ketik pesan Anda..." class="flex-1 rounded-full py-3 px-4 bg-gray-100 border-2 border-dark focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
            <button onclick="sendMessage()" class="bg-primary text-white p-3 rounded-full w-12 h-12 flex items-center justify-center border-2 border-dark shadow-[2px_3px_0px_#080330] hover:bg-primary-dark transition-transform duration-200 hover:scale-105 active:scale-95">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>

    <!-- Overlay untuk Mobile -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 hidden"></div>
</div>

<!-- Styling untuk pesan dan indikator mengetik -->
<style>
    .message-container {
        display: flex;
        margin-bottom: 1rem;
        clear: both;
    }

    .message-container.user {
        justify-content: flex-end;
    }

    .message-container.assistant {
        justify-content: flex-start;
    }

    .message-bubble {
        max-width: 70%;
        padding: 12px 16px;
        border-radius: 18px;
        border: 2px solid #080330;
        box-shadow: 2px 3px 0px #080330;
        position: relative;
        word-wrap: break-word;
    }

    .message-bubble.user {
        background: linear-gradient(135deg, #8FD14F, #7BC043);
        color: white;
        border-bottom-right-radius: 6px;
    }

    .message-bubble.assistant {
        background: white;
        color: #080330;
        border-bottom-left-radius: 6px;
    }

    .message-sender {
        font-weight: bold;
        font-size: 0.8rem;
        margin-bottom: 4px;
        display: block;
    }

    .message-sender.user {
        text-align: right;
        color: rgba(255,255,255,0.9);
    }

    .message-sender.assistant {
        text-align: left;
        color: #604CC3;
    }

    .message-content {
        font-size: 0.95rem;
        line-height: 1.4;
        margin-bottom: 6px;
    }

    .message-time {
        font-size: 0.7rem;
        opacity: 0.7;
        text-align: right;
        display: block;
    }

    .assistant-badge {
        background: #604CC3;
        color: white;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 0.7rem;
        font-weight: bold;
        margin-bottom: 6px;
        display: inline-block;
        border: 1px solid #080330;
    }

    .typing-indicator {
        display: flex;
        align-items: center;
        padding: 12px 16px;
        background: white;
        border: 2px solid #080330;
        border-radius: 18px;
        box-shadow: 2px 3px 0px #080330;
        margin-bottom: 1rem;
        max-width: 120px;
        border-bottom-left-radius: 6px;
    }

    .typing-dot {
        width: 8px;
        height: 8px;
        background-color: #6B7280;
        border-radius: 50%;
        margin: 0 2px;
        animation: typing-animation 1.4s infinite ease-in-out;
    }

    .typing-dot:nth-child(1) { animation-delay: 0s; }
    .typing-dot:nth-child(2) { animation-delay: 0.2s; }
    .typing-dot:nth-child(3) { animation-delay: 0.4s; }

    @keyframes typing-animation {
        0%, 60%, 100% { transform: translateY(0); }
        30% { transform: translateY(-5px); }
    }

    /* Mobile specific fixes */
    @media (max-width: 768px) {
        #messages {
            padding-bottom: 20px;
        }

        .message-bubble {
            max-width: 85%;
        }

        #sidebar {
            position: fixed;
            left: -100%;
            top: 0;
            bottom: 0;
            width: 80%;
            max-width: 300px;
            transition: left 0.3s ease;
            z-index: 30;
        }

        #sidebar.active {
            left: 0;
        }

        #overlay.active {
            display: block;
        }

        .chat-input-container {
            padding-bottom: 20px;
            background: white;
        }
    }

    /* Custom scrollbar */
    #messages::-webkit-scrollbar {
        width: 6px;
    }

    #messages::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    #messages::-webkit-scrollbar-thumb {
        background: #8FD14F;
        border-radius: 10px;
    }

    #messages::-webkit-scrollbar-thumb:hover {
        background: #7BC043;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // --- Elemen UI & Variabel ---
    const chatListPanel = document.getElementById('chat-list-panel');
    const chatWindowPanel = document.getElementById('chat-window-panel');
    const messagesDiv = document.getElementById("messages");
    const contacts = document.querySelectorAll('.contact');
    const userInput = document.getElementById('userInput');
    const sendButton = document.querySelector('#chat-window-panel .chat-input-container button');

    let currentModel = "friendly-listener";
    let conversationHistory = [];

    // --- Konfigurasi Psikolog ---
    const psychologistConfigs = {
        "friendly-listener": {
            name: "Nemo",
            specialty: "Pendengar Ramah",
            greeting: "Hai! Saya Nemo, teman berbicara yang siap mendengarkan. Kadang kita hanya perlu seseorang untuk diajak bicara. Ada yang ingin diceritakan?",
            promptContext: "Anda adalah Nemo, pendengar yang ramah dan empatik. Berikan respons singkat, santai, dan suportif dalam bahasa Indonesia seperti chat dengan teman. Maksimal 2-3 kalimat."
        }
    };

    // --- Helper ---
    const isMobile = () => window.innerWidth < 768;

    // --- EVENT: Pilih Kontak ---
    contacts.forEach(contact => {
        contact.addEventListener('click', function () {
            // hapus aktif sebelumnya
            contacts.forEach(c => c.classList.remove('active', 'bg-accent'));
            this.classList.add('active', 'bg-accent');

            const modelName = this.getAttribute('data-model');
            currentModel = modelName;

            const name = this.querySelector('.contact-name').textContent;
            const specialty = this.querySelector('p').textContent;

            // update header chat
            const headerDiv = document.querySelector('#chat-window-panel .current-contact-info');
            headerDiv.innerHTML = `
                <h3 class="font-bold text-lg font-exo2 text-dark">${name}</h3>
                <p class="text-sm text-gray-600">Online - ${specialty}</p>
            `;

            // reset pesan
            messagesDiv.innerHTML = '';
            conversationHistory = [];
            appendMessage("assistant", psychologistConfigs[modelName].greeting, true);

            if (isMobile()) {
                chatListPanel.classList.add('hidden');
                chatWindowPanel.classList.remove('hidden');
                chatWindowPanel.classList.add('flex');
                chatWindowPanel.classList.remove('hidden');
            }
        });
    });

    // --- Kirim Pesan ---
    async function sendMessage() {
        const text = userInput.value.trim();
        if (!text) return;

        appendMessage("user", text);
        userInput.value = "";

        conversationHistory.push({ role: "user", content: text });

        const typingIndicator = showTypingIndicator();

        try {
            const response = await sendMessageToGemini(text, conversationHistory);
            hideTypingIndicator(typingIndicator);
            
            // Clean response - remove markdown and extra spaces
            const cleanResponse = response.replace(/\*\*/g, '').replace(/\*/g, '').trim();
            conversationHistory.push({ role: "assistant", content: cleanResponse });
            appendMessage("assistant", cleanResponse);
        } catch (err) {
            hideTypingIndicator(typingIndicator);
            console.error("Error:", err);

            const fallbackResponses = {
                "friendly-listener": [
                    "Wah, aku ngerti kok rasanya. Kadang memang berat ya.",
                    "Terima kasih udah cerita. Aku di sini dengerin kamu.",
                    "Tenang aja, aku di sini buat kamu. Mau cerita apa aja, boleh banget!"
                ]
            };
            const responses = fallbackResponses[currentModel];
            const randomResponse = responses[Math.floor(Math.random() * responses.length)];
            conversationHistory.push({ role: "assistant", content: randomResponse });
            appendMessage("assistant", randomResponse);
        }
    }

    // --- Fungsi API Gemini ---
    async function sendMessageToGemini(userMessage, conversationHistory) {
        const GEMINI_API_KEY = "AIzaSyBLma6UUgkYmEIj9Rhvgog_GG5DBgq9ERg";
        const GEMINI_API_URL = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=${GEMINI_API_KEY}`;

        try {
            const config = psychologistConfigs[currentModel];
            
            // Build conversation history for prompt
            let historyText = "";
            conversationHistory.forEach(msg => {
                const speaker = msg.role === 'user' ? 'User' : config.name;
                historyText += `${speaker}: ${msg.content}\n`;
            });

            const prompt = `
                ${config.promptContext}

                Riwayat percakapan:
                ${conversationHistory.map(msg =>
                                    `${msg.role === 'user' ? 'Klien' : config.name}: ${msg.content}`
                                ).join('\n')}

                Pesan terbaru dari klien: "${userMessage}"

                Berikan respons sebagai ${config.specialty} dalam bahasa Indonesia maksimal 3 paragraf.`;

            const response = await fetch(GEMINI_API_URL, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    contents: [{ parts: [{ text: prompt }] }],
                    generationConfig: {
                        temperature: 0.8,
                        topK: 40,
                        topP: 0.95,
                        maxOutputTokens: 150,
                    }
                })
            });

            if (!response.ok) throw new Error(`HTTP error! ${response.status}`);
            const data = await response.json();

            return data.candidates?.[0]?.content?.parts?.[0]?.text || "Maaf, saya tidak dapat memberikan jawaban saat ini.";
        } catch (error) {
            throw error;
        }
    }

    // --- Fungsi UI ---
    function appendMessage(role, text, isSystem = false) {
        const messageContainer = document.createElement("div");
        messageContainer.className = `message-container ${role}`;

        const messageBubble = document.createElement("div");
        messageBubble.className = `message-bubble ${role}`;

        // Sender name (for assistant messages)
        if (role === "assistant" && !isSystem) {
            const sender = document.createElement("span");
            sender.className = `message-sender ${role}`;
            sender.textContent = document.querySelector('.current-contact-info h3')?.textContent || 'Nemo';
            messageBubble.appendChild(sender);
        }

        // Message content
        const content = document.createElement("div");
        content.className = "message-content";
        content.innerHTML = text.replace(/\n/g, '<br>');
        messageBubble.appendChild(content);

        // Message time
        const time = document.createElement("span");
        time.className = "message-time";
        const now = new Date();
        const timeString = `${now.getHours().toString().padStart(2, '0')}:${now.getMinutes().toString().padStart(2, '0')}`;
        time.textContent = timeString;
        messageBubble.appendChild(time);

        messageContainer.appendChild(messageBubble);
        messagesDiv.appendChild(messageContainer);
        
        // Scroll to bottom
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
    }

    function showTypingIndicator() {
        const messageContainer = document.createElement("div");
        messageContainer.className = "message-container assistant";

        const indicator = document.createElement("div");
        indicator.className = "typing-indicator";
        
        for (let i = 0; i < 3; i++) {
            const dot = document.createElement("div");
            dot.className = "typing-dot";
            indicator.appendChild(dot);
        }
        
        messageContainer.appendChild(indicator);
        messagesDiv.appendChild(messageContainer);
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
        
        return { container: messageContainer, indicator: indicator };
    }

    function hideTypingIndicator(typingObj) {
        if (typingObj && typingObj.container && typingObj.container.parentNode) {
            typingObj.container.parentNode.removeChild(typingObj.container);
        }
    }

    function handleKeyPress(event) {
        if (event.key === "Enter") {
            sendMessage();
        }
    }

    // --- Inisialisasi Awal ---
    // Event listeners
    userInput.addEventListener('keypress', handleKeyPress);
    if (sendButton) {
        sendButton.addEventListener('click', sendMessage);
    }

    // Focus input field (jika chat window terbuka)
    if (!chatWindowPanel.classList.contains('hidden')) {
        userInput.focus();
    }

    // Event listeners
    userInput.addEventListener('keypress', handleKeyPress);
    if (sendButton) {
        sendButton.addEventListener('click', sendMessage);
    }

    // Focus input field
    userInput.focus();
});
</script>
@endsection