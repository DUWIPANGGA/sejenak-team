@extends('layouts.app')
@section('title', 'Chat with Nemo')

@section('content')
<div class="flex-1 flex w-full h-full p-4 md:p-2 gap-6">
    <div id="chat-list-panel" class="w-full md:w-1/3 bg-white border-2 border-dark rounded-playful-lg flex flex-col overflow-hidden shadow-border-offset-lg mt-4 md:mt-0 z-10">
        <div class="p-4 border-b-2 border-dark flex justify-center bg-white">
            <h2 class="text-xl font-bold font-exo2">Mau Ngobrol sama Siapa Nih?</h2>
        </div>
        <div class="flex flex-col p-2 overflow-y-auto space-y-2">
            <a href="{{ route('chat') }}" class="user-list-item flex items-center p-3 rounded-playful-sm bg-primary border-2 border-dark shadow-border-offset">
                <div class="w-10 h-10 rounded-full bg-dark flex items-center justify-center text-white mr-3">
                    <i class="fas fa-user text-lg"></i>
                </div>
                <div class="flex-1">
                    <h3 class="font-bold text-dark font-exo2">Konseling dengan ahli</h3>
                    <p class="text-xs text-dark">Curahkan semua masalah mu ke ahli</p>
                </div>
            </a>
            <div class="contact flex items-center p-3 rounded-playful-sm bg-primary border-2 border-dark shadow-border-offset cursor-pointer active bg-primary text-white" data-model="friendly-listener">
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

    <div id="chat-window-panel" class="flex-1 hidden md:flex flex-col h-full bg-white border-2 border-dark rounded-playful-lg ml-[-12px] shadow-border-offset-lg mt-4 md:mt-0 p-4 relative">
        <div id="chat-header" class="hidden absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 p-2 bg-white rounded-playful-sm border-2 border-dark shadow-border-offset flex items-center z-20">
            <div class="current-contact-avatar w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white mr-2 border-2 border-dark">
                <i class="fas fa-robot text-lg"></i>
            </div>
            <div class="current-contact-info">
                <h3 class="font-bold text-base font-exo2 text-dark">Nemo</h3>
                <p class="text-xs">Online - Pendengar Ramah</p>
            </div>
            <button id="menuToggle" class="md:hidden ml-4 text-dark">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <div id="messages" class="flex-1 p-4 overflow-y-auto space-y-6 pt-16">
            <div class="flex justify-center items-center h-full">
                <p class="text-gray-500">Pilih percakapan untuk mulai mengobrol</p>
            </div>
        </div>

        <div id="chat-input" class="hidden p-4 border-t-2 border-dark bg-white z-10 flex items-center space-x-2">
            <input id="userInput" type="text" placeholder="Ketik pesan Anda..." class="flex-1 rounded-full py-2 px-4 bg-gray-100 border-2 border-dark focus:outline-none focus:border-primary" onkeypress="handleKeyPress(event)">
            <button onclick="sendMessage()" class="bg-primary text-white p-2 rounded-full w-10 h-10 flex items-center justify-center border-2 border-dark shadow-[2px_3px_0px_#080330] hover:bg-primary-dark transition-transform duration-200 hover:scale-105">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>

    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 hidden"></div>
</div>

<style>
    .msg {
        margin-bottom: 1rem;
        padding: 0.75rem;
        border-radius: 0.5rem;
        border: 2px solid #080330;
        box-shadow: 2px 3px 0px #080330;
        position: relative;
    }
    
    .msg.user {
        margin-left: auto;
        background-color: #4F46E5;
        color: white;
        max-width: 75%;
    }
    
    .msg.assistant {
        background-color: #F3F4F6;
        max-width: 75%;
    }
    
    .msg-info {
        font-size: 0.75rem;
        margin-top: 0.5rem;
        display: flex;
        justify-content: space-between;
        opacity: 0.7;
    }
    
    .psy-badge {
        background-color: #4F46E5;
        color: white;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.75rem;
        margin-bottom: 0.5rem;
        display: inline-block;
    }
    
    .typing-indicator {
        display: flex;
        align-items: center;
        padding: 0.75rem;
        background-color: #F3F4F6;
        border: 2px solid #080330;
        border-radius: 0.5rem;
        box-shadow: 2px 3px 0px #080330;
        margin-bottom: 1rem;
        max-width: 75%;
    }
    
    .typing-dot {
        width: 8px;
        height: 8px;
        background-color: #6B7280;
        border-radius: 50%;
        margin: 0 2px;
        animation: typing-animation 1.4s infinite ease-in-out;
    }
    
    .typing-dot:nth-child(1) {
        animation-delay: 0s;
    }
    
    .typing-dot:nth-child(2) {
        animation-delay: 0.2s;
    }
    
    .typing-dot:nth-child(3) {
        animation-delay: 0.4s;
    }
    
    @keyframes typing-animation {
        0%, 60%, 100% {
            transform: translateY(0);
        }
        30% {
            transform: translateY(-5px);
        }
    }
    
    /* Responsif untuk mobile */
    @media (max-width: 768px) {
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
    }
</style>
<script>
// ... Sisa JavaScript kamu (tidak perlu diubah) ...
document.addEventListener('DOMContentLoaded', function () {
    // --- Elemen UI & Variabel ---
    const chatListPanel = document.getElementById('chat-list-panel');
    const chatWindowPanel = document.getElementById('chat-window-panel');
    const messagesDiv = document.getElementById("messages");
    const contacts = document.querySelectorAll('.contact');
    const userInput = document.getElementById('userInput');
    const sendButton = document.querySelector('.p-4 button');

    let currentModel = "friendly-listener";
    let conversationHistory = [];

    // --- Konfigurasi Psikolog & API ---
    const psychologistConfigs = {
        "friendly-listener": {
            name: "Nemo",
            specialty: "Pendengar Ramah",
            greeting: "Hai! Saya Nemo, teman berbicara yang siap mendengarkan. Kadang kita hanya perlu seseorang untuk diajak bicara. Ada yang ingin diceritakan?",
            promptContext: "Anda adalah seorang pendengar yang ramah dan empatik bernama Nemo. Tugas Anda adalah memberikan ruang aman bagi klien untuk bercerita, mendengarkan tanpa menghakimi, dan memberikan validasi emosional. Bersikaplah seperti teman bicara yang supportive. Jawablah dalam bahasa Indonesia yang santun dan mudah dimengerti. Sesuaikan dengan bahasa gen-Z dan jangan bertele-tele ketika chat seperti remaja saja."
        }
    };
    const GEMINI_API_KEY = "AIzaSyBLma6UUgkYmEIj9Rhvgog_GG5DBgq9ERg"; // PERINGATAN: Tidak aman di frontend!
    const GEMINI_API_URLS = [
        `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=${GEMINI_API_KEY}`,
        `https://us-central1-generativelanguage.googleapis.com/v1/models/gemini-pro:generateContent?key=${GEMINI_API_KEY}`,
        `https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=${GEMINI_API_KEY}`
    ];

    // --- Fungsi Bantuan ---
    const isMobile = () => window.innerWidth < 768;

    // --- EVENT: Pilih Kontak ---
    contacts.forEach(contact => {
        contact.addEventListener('click', function () {
            contacts.forEach(c => c.classList.remove('active', 'bg-primary', 'text-white'));
            this.classList.add('active', 'bg-primary', 'text-white');

            const modelName = this.getAttribute('data-model');
            currentModel = modelName;

            const name = this.querySelector('.contact-name').textContent;
            const specialty = this.querySelector('p').textContent;

            // Update header di chat window
            const headerDiv = document.querySelector('#chat-window-panel .absolute');
            headerDiv.innerHTML = `
                <div class="flex items-center p-2 bg-white rounded-playful-sm border-2 border-dark shadow-border-offset">
                    <button id="back-to-list-button" class="text-dark mr-3 md:hidden"><i class="fas fa-arrow-left"></i></button>
                    <div class="current-contact-avatar w-8 h-8 rounded-full bg-dark flex items-center justify-center text-white mr-2 border-2 border-dark">
                        <i class="fas fa-robot text-lg"></i>
                    </div>
                    <div class="current-contact-info">
                        <h3 class="font-bold text-base font-exo2 text-dark">${name}</h3>
                        <p class="text-xs">Online - ${specialty}</p>
                    </div>
                </div>
            `;
            
            // Reset chat
            messagesDiv.innerHTML = '';
            conversationHistory = [];
            appendMessage("assistant", psychologistConfigs[modelName].greeting, true);

            // Tampilkan header dan input chat
            document.getElementById("chat-header").classList.remove("hidden");
            document.getElementById("chat-input").classList.remove("hidden");

            // Logika ganti panel di mobile
            if (isMobile()) {
                chatListPanel.classList.add('hidden');
                chatWindowPanel.classList.remove('hidden');
                document.getElementById('back-to-list-button').addEventListener('click', () => {
                    chatWindowPanel.classList.add('hidden');
                    chatListPanel.classList.remove('hidden');
                });
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
            conversationHistory.push({ role: "assistant", content: response });
            appendMessage("assistant", response);
        } catch (err) {
            hideTypingIndicator(typingIndicator);
            console.error("Error:", err);
            const fallbackResponse = "⚠️ Maaf, terjadi kendala teknis. Coba lagi nanti ya.";
            conversationHistory.push({ role: "assistant", content: fallbackResponse });
            appendMessage("assistant", fallbackResponse);
        }
    }

    // --- Fungsi API ke Gemini ---
    async function sendMessageToGemini(userMessage, conversationHistory) {
        let lastError = null;
        for (const apiUrl of GEMINI_API_URLS) {
            try {
                const config = psychologistConfigs[currentModel];
                const prompt = `
${config.promptContext}

Riwayat percakapan:
${conversationHistory.map(msg =>
                    `${msg.role === 'user' ? 'Klien' : config.name}: ${msg.content}`
                ).join('\n')}

Pesan terbaru dari klien: "${userMessage}"

Berikan respons sebagai ${config.specialty} dalam bahasa Indonesia maksimal 3 paragraf.
                `;

                const response = await fetch(apiUrl, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        contents: [{ parts: [{ text: prompt }] }],
                        generationConfig: {
                            temperature: 0.7, topK: 40, topP: 0.95, maxOutputTokens: 1024,
                        }
                    })
                });

                if (!response.ok) throw new Error(`HTTP error! ${response.status}`);
                const data = await response.json();
                return data.candidates?.[0]?.content?.parts?.[0]?.text || "Maaf, saya tidak dapat memberikan jawaban saat ini.";
            } catch (error) {
                lastError = error;
                continue;
            }
        }
        throw lastError;
    }

    // --- Fungsi Tambahan ---
    function appendMessage(role, text, isSystem = false) {
        const msg = document.createElement("div");
        msg.className = `msg ${role}`;
        if (role === "assistant" && !isSystem) {
            const badge = document.createElement("div");
            badge.className = "psy-badge";
            badge.textContent = document.querySelector('.current-contact-info h3')?.textContent || 'Asisten';
            msg.appendChild(badge);
        }
        msg.innerHTML += text.replace(/\n/g, '<br>');
        const msgInfo = document.createElement("div");
        msgInfo.className = "msg-info";
        const now = new Date();
        const timeString = `${now.getHours().toString().padStart(2, '0')}:${now.getMinutes().toString().padStart(2, '0')}`;
        msgInfo.innerHTML = `<span>${role === 'user' ? 'Anda' : document.querySelector('.current-contact-info h3')?.textContent || 'Asisten'}</span><span>${timeString}</span>`;
        msg.appendChild(msgInfo);
        messagesDiv.appendChild(msg);
        msg.scrollIntoView({ behavior: "smooth", block: "nearest" });
    }

    function showTypingIndicator() {
        const indicator = document.createElement("div");
        indicator.className = "typing-indicator";
        for (let i = 0; i < 3; i++) {
            const dot = document.createElement("div");
            dot.className = "typing-dot";
            indicator.appendChild(dot);
        }
        messagesDiv.appendChild(indicator);
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
        return indicator;
    }

    function hideTypingIndicator(indicator) {
        if (indicator && indicator.parentNode) {
            indicator.parentNode.removeChild(indicator);
        }
    }

    function handleKeyPress(event) {
        if (event.key === "Enter") sendMessage();
    }

    // --- Inisialisasi Awal ---
    if (isMobile()) {
        chatWindowPanel.classList.add('hidden');
        chatListPanel.classList.remove('hidden');
    }

    // --- Event Listeners Akhir ---
    userInput.addEventListener('keypress', handleKeyPress);
    sendButton.addEventListener('click', sendMessage);
});
</script>
@endsection