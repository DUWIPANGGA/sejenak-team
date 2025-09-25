@extends('layouts.app')
@section('title', 'chat')

@section('content')
<div class="flex-1 flex w-full h-full p-4 md:p-2 gap-6">
    <!-- Sidebar Kontak -->
    <div id="sidebar" class="w-full md:w-1/3 bg-white border-2 border-dark rounded-playful-lg flex flex-col overflow-hidden shadow-border-offset-lg mt-4 md:mt-0 z-10">
        <div class="p-4 border-b-2 border-dark flex items-center bg-white">
            <h2 class="text-xl font-bold font-exo2">Chat</h2>
        </div>
        <div class="flex flex-col p-2 overflow-y-auto space-y-2">
            <!-- Kontak-kontak psikolog -->
            <a href="{{ route('user.konseling') }}" class="user-list-item flex items-center p-3 rounded-playful-sm bg-primary border-2 border-dark shadow-border-offset">
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
            
            <div class="contact flex items-center p-3 rounded-playful-sm bg-white border-2 border-dark shadow-border-offset cursor-pointer hover:bg-gray-100 transition-colors" data-model="clinical-psychologist">
                <div class="w-10 h-10 rounded-full bg-blue-500 border-2 border-dark flex items-center justify-center text-white mr-3">
                    <i class="fas fa-user-md text-lg"></i>
                </div>
                <div class="flex-1">
                    <h3 class="contact-name font-bold font-exo2">Dr. Andini</h3>
                    <p class="text-xs">Psikolog Klinis</p>
                </div>
            </div>
            
            <div class="contact flex items-center p-3 rounded-playful-sm bg-white border-2 border-dark shadow-border-offset cursor-pointer hover:bg-gray-100 transition-colors" data-model="cognitive-therapist">
                <div class="w-10 h-10 rounded-full bg-green-500 border-2 border-dark flex items-center justify-center text-white mr-3">
                    <i class="fas fa-brain text-lg"></i>
                </div>
                <div class="flex-1">
                    <h3 class="contact-name font-bold font-exo2">Dr. Bima</h3>
                    <p class="text-xs">Terapis Kognitif</p>
                </div>
            </div>
            
            <div class="contact flex items-center p-3 rounded-playful-sm bg-white border-2 border-dark shadow-border-offset cursor-pointer hover:bg-gray-100 transition-colors" data-model="mindfulness-coach">
                <div class="w-10 h-10 rounded-full bg-purple-500 border-2 border-dark flex items-center justify-center text-white mr-3">
                    <i class="fas fa-spa text-lg"></i>
                </div>
                <div class="flex-1">
                    <h3 class="contact-name font-bold font-exo2">Mbak Rara</h3>
                    <p class="text-xs">Pelatih Mindfulness</p>
                </div>
            </div>
            
            <div class="contact flex items-center p-3 rounded-playful-sm bg-white border-2 border-dark shadow-border-offset cursor-pointer hover:bg-gray-100 transition-colors" data-model="wisdom-mentor">
                <div class="w-10 h-10 rounded-full bg-orange-500 border-2 border-dark flex items-center justify-center text-white mr-3">
                    <i class="fas fa-lightbulb text-lg"></i>
                </div>
                <div class="flex-1">
                    <h3 class="contact-name font-bold font-exo2">Pak Wisnu</h3>
                    <p class="text-xs">Pembimbing Bijak</p>
                </div>
            </div>
            
            <!-- Selector Model untuk Mobile -->
            <div class="p-3 bg-white border-2 border-dark rounded-playful-sm md:hidden">
                <label for="modelSelector" class="block text-sm font-medium mb-1">Pilih Psikolog:</label>
                <select id="modelSelector" class="w-full p-2 border-2 border-dark rounded-playful-sm focus:outline-none focus:border-primary">
                    <option value="friendly-listener">Nemo - Pendengar Ramah</option>
                    <option value="clinical-psychologist">Dr. Andini - Psikolog Klinis</option>
                    <option value="cognitive-therapist">Dr. Bima - Terapis Kognitif</option>
                    <option value="mindfulness-coach">Mbak Rara - Pelatih Mindfulness</option>
                    <option value="wisdom-mentor">Pak Wisnu - Pembimbing Bijak</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Area Chat Utama -->
    <div class="flex-1 flex flex-col bg-white border-2 border-dark rounded-playful-lg ml-[-12px] shadow-border-offset-lg mt-4 md:mt-0 p-4 relative">
        <!-- Header Chat -->
        <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 p-2 bg-white rounded-playful-sm border-2 border-dark shadow-border-offset flex items-center z-20">
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

        <!-- Area Pesan -->
        <div id="messages" class="flex-1 p-4 overflow-y-auto space-y-6 pt-16">
            <!-- Pesan akan ditambahkan secara dinamis oleh JavaScript -->
        </div>

        <!-- Input Pesan -->
        <div class="p-4 border-t-2 border-dark sticky bottom-0 bg-white z-10 flex items-center space-x-2">
            <input id="userInput" type="text" placeholder="Ketik pesan Anda..." class="flex-1 rounded-full py-2 px-4 bg-gray-100 border-2 border-dark focus:outline-none focus:border-primary" onkeypress="handleKeyPress(event)">
            <button onclick="sendMessage()" class="bg-primary text-white p-2 rounded-full w-10 h-10 flex items-center justify-center border-2 border-dark shadow-[2px_3px_0px_#080330] hover:bg-primary-dark transition-transform duration-200 hover:scale-105">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>

    <!-- Overlay untuk Mobile -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 hidden"></div>
</div>

<!-- Styling untuk pesan dan indikator mengetik -->
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
    // Kode JavaScript Anda di sini (tetap sama seperti yang Anda berikan)
    const messagesDiv = document.getElementById("messages");
    const contacts = document.querySelectorAll('.contact');
    const currentContactInfo = document.querySelector('.current-contact-info');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const menuToggle = document.getElementById('menuToggle');
    const modelSelector = document.getElementById('modelSelector');
    let currentModel = "friendly-listener";
    
    const psychologistConfigs = {
      "clinical-psychologist": {
        name: "Dr. Andini",
        specialty: "Psikolog Klinis",
        greeting: "Halo! Saya Dr. Andini, psikolog digital Anda. Saya di sini untuk mendengarkan dan membantu Anda memahami perasaan serta pikiran yang sedang Anda alami. Bagaimana perasaan Anda hari ini?",
        promptContext: "Anda adalah seorang psikolog klinis profesional yang bernama Dr. Andini. Tugas Anda adalah memberikan dukungan emosional, mendengarkan dengan empati, dan membantu klien memahami perasaan serta pikiran mereka. Gunakan pendekatan yang profesional namun hangat. Jawablah dalam bahasa Indonesia yang santun dan mudah dimengerti."
      },
      "cognitive-therapist": {
        name: "Dr. Bima",
        specialty: "Terapis Kognitif",
        greeting: "Selamat datang! Saya Dr. Bima, terapis kognitif. Saya membantu orang memahami hubungan antara pikiran, perasaan, dan perilaku. Ada yang ingin Anda diskusikan hari ini?",
        promptContext: "Anda adalah seorang terapis kognitif profesional yang bernama Dr. Bima. Tugas Anda adalah membantu klien mengidentifikasi pola pikir yang tidak sehat, menantang distorsi kognitif, dan mengembangkan pola pikir yang lebih adaptif. Gunakan teknik cognitive restructuring dan pendekatan yang edukatif. Jawablah dalam bahasa Indonesia yang santun dan mudah dimengerti."
      },
      "mindfulness-coach": {
        name: "Mbak Rara",
        specialty: "Pelatih Mindfulness",
        greeting: "Hai! Saya Rara, pelatih mindfulness. Saya di sini untuk membantu Anda hadir sepenuhnya di momen sekarang. Apa yang membawa Anda ke sini hari ini?",
        promptContext: "Anda adalah seorang pelatih mindfulness yang bernama Rara. Tugas Anda adalah membimbing klien untuk hadir di momen saat ini, menerima pengalaman tanpa penghakiman, dan mengembangkan kesadaran penuh. Gunakan teknik pernapasan, body scan, dan meditasi singkat. Jawablah dalam bahasa Indonesia yang santun dan mudah dimengerti."
      },
      "friendly-listener": {
        name: "Nemo",
        specialty: "Pendengar Ramah",
        greeting: "Hai! Saya Nemo, teman berbicara yang siap mendengarkan. Kadang kita hanya perlu seseorang untuk diajak bicara. Ada yang ingin diceritakan?",
        promptContext: "Anda adalah seorang pendengar yang ramah dan empatik bernama Nemo. Tugas Anda adalah memberikan ruang aman bagi klien untuk bercerita, mendengarkan tanpa menghakimi, dan memberikan validasi emosional. Bersikaplah seperti teman bicara yang supportive. Jawablah dalam bahasa Indonesia yang santun dan mudah dimengerti. sesuaikan dengan bahasa gen-Z dan jangan bertele tele ketika chat seperti remaja saja"
      },
      "wisdom-mentor": {
        name: "Pak Wisnu",
        specialty: "Pembimbing Bijak",
        greeting: "Salam. Saya Wisnu, pembimbing bijak. Saya berbagi perspektif dan kebijaksanaan untuk membantu Anda melihat tantangan hidup dengan cara baru. Ada yang mengganggu pikiran Anda?",
        promptContext: "Anda adalah seorang mentor bijak yang bernama Wisnu. Tugas Anda adalah memberikan perspektif baru, kebijaksanaan hidup, dan pandangan yang lebih luas tentang masalah yang dihadapi klien. Gunakan analogi, cerita inspiratif, dan filosofi yang relevan. Jawablah dalam bahasa Indonesia yang santun dan mudah dimengerti."
      }
    };

    // Konfigurasi Gemini API
    const GEMINI_API_KEY = "AIzaSyBLma6UUgkYmEIj9Rhvgog_GG5DBgq9ERg";
    const GEMINI_API_URLS = [
        `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=${GEMINI_API_KEY}`,
        `https://us-central1-generativelanguage.googleapis.com/v1/models/gemini-pro:generateContent?key=${GEMINI_API_KEY}`,
        `https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=${GEMINI_API_KEY}`
    ];

    // Event listeners untuk kontak
    contacts.forEach(contact => {
      contact.addEventListener('click', function() {
        contacts.forEach(c => c.classList.remove('active', 'bg-primary', 'text-white'));
        this.classList.add('active', 'bg-primary', 'text-white');
        
        const modelName = this.getAttribute('data-model');
        currentModel = modelName;
        modelSelector.value = modelName;
        
        const name = this.querySelector('.contact-name').textContent;
        const specialty = this.querySelector('p').textContent;
        
        currentContactInfo.querySelector('h3').textContent = name;
        currentContactInfo.querySelector('p').textContent = `Online - ${specialty}`;
        
        // Update avatar di header
        const avatarIcon = this.querySelector('i').className;
        const avatarDiv = this.querySelector('div:first-child');
        const bgColor = window.getComputedStyle(avatarDiv).backgroundColor;
        
        document.querySelector('.current-contact-avatar').style.backgroundColor = bgColor;
        document.querySelector('.current-contact-avatar i').className = avatarIcon;
        
        // Tambahkan pesan sistem tentang perubahan model
        appendMessage("assistant", `Sekarang Anda berbicara dengan ${name} (${specialty}). ${psychologistConfigs[modelName].greeting}`, true);
        
        // Di mobile, tutup sidebar setelah memilih kontak
        if (window.innerWidth < 768) {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        }
      });
    });

    // Event listener untuk selector model
    modelSelector.addEventListener('change', function() {
      currentModel = this.value;
      const contact = document.querySelector(`.contact[data-model="${currentModel}"]`);
      if (contact) {
        contacts.forEach(c => c.classList.remove('active', 'bg-primary', 'text-white'));
        contact.classList.add('active', 'bg-primary', 'text-white');
        
        const name = contact.querySelector('.contact-name').textContent;
        const specialty = contact.querySelector('p').textContent;
        
        currentContactInfo.querySelector('h3').textContent = name;
        currentContactInfo.querySelector('p').textContent = `Online - ${specialty}`;
        
        // Update avatar di header
        const avatarIcon = contact.querySelector('i').className;
        const avatarDiv = contact.querySelector('div:first-child');
        const bgColor = window.getComputedStyle(avatarDiv).backgroundColor;
        
        document.querySelector('.current-contact-avatar').style.backgroundColor = bgColor;
        document.querySelector('.current-contact-avatar i').className = avatarIcon;
        
        // Tambahkan pesan sistem tentang perubahan model
        appendMessage("assistant", `Sekarang Anda berbicara dengan ${name} (${specialty}). ${psychologistConfigs[currentModel].greeting}`, true);
      }
    });

    // Toggle sidebar di mobile
    menuToggle.addEventListener('click', function() {
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
    });

    overlay.addEventListener('click', function() {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
    });

    // Fungsi untuk mengirim pesan ke Gemini API dengan fallback URL
    async function sendMessageToGemini(userMessage, conversationHistory) {
      let lastError = null;
      
      // Coba semua URL yang mungkin
      for (const apiUrl of GEMINI_API_URLS) {
        try {
          const config = psychologistConfigs[currentModel];
          
          // Siapkan prompt dengan konteks dan riwayat percakapan
          const prompt = `
            ${config.promptContext}
            
            Riwayat percakapan:
            ${conversationHistory.map(msg => 
              `${msg.role === 'user' ? 'Klien' : config.name}: ${msg.content}`
            ).join('\n')}
            
            Pesan terbaru dari klien: "${userMessage}"
            
            Berikan respons yang sesuai dengan peran Anda sebagai ${config.specialty}. 
            Jawablah dengan empati, profesionalisme, dan dalam bahasa Indonesia.
            Batasi respons maksimal 3 paragraf.
          `;
          
          const response = await fetch(apiUrl, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify({
              contents: [{
                parts: [{
                  text: prompt
                }]
              }],
              generationConfig: {
                temperature: 0.7,
                topK: 40,
                topP: 0.95,
                maxOutputTokens: 1024,
              }
            })
          });
          
          if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}, URL: ${apiUrl}`);
          }
          
          const data = await response.json();
          
          if (data.candidates && data.candidates[0] && data.candidates[0].content) {
            return data.candidates[0].content.parts[0].text;
          } else {
            throw new Error('Format respons API tidak sesuai');
          }
        } catch (error) {
          console.error(`Error with URL ${apiUrl}:`, error);
          lastError = error;
          continue;
        }
      }
      
      throw lastError;
    }

    // Menyimpan riwayat percakapan
    let conversationHistory = [];

    async function sendMessage() {
      const input = document.getElementById("userInput");
      const text = input.value.trim();
      if (!text) return;

      appendMessage("user", text);
      input.value = "";

      // Tambahkan ke riwayat percakapan
      conversationHistory.push({ role: "user", content: text });

      const typingIndicator = showTypingIndicator();
      
      try {
        // Kirim pesan ke Gemini API
        const response = await sendMessageToGemini(text, conversationHistory);
        
        hideTypingIndicator(typingIndicator);

        // Tambahkan respons ke riwayat percakapan
        conversationHistory.push({ role: "assistant", content: response });
        
        appendMessage("assistant", response);

      } catch (err) {
        hideTypingIndicator(typingIndicator);
        console.error("Error:", err);
        
        // Fallback ke respons statis jika API error
        const fallbackResponses = {
          "clinical-psychologist": [
            "Saya memahami perasaan Anda. Dapatkah Anda menceritakan lebih detail tentang apa yang memicu perasaan tersebut?",
            "Terima kasih telah membagikan perasaan Anda. Ini adalah langkah penting dalam proses memahami diri sendiri.",
            "Dari yang Anda ceritakan, sepertinya Anda sedang mengalami tekanan. Apakah ada strategi coping yang sudah Anda coba?"
          ],
          "cognitive-therapist": [
            "Pikiran kita sangat mempengaruhi bagaimana kita merasa. Dapatkah Anda mengidentifikasi pikiran spesifik yang muncul saat itu?",
            "Terkadang kita terjebak dalam pola pikir yang tidak membantu. Mari kita lihat apakah ada distorsi kognitif dalam pola pikir Anda.",
            "Bagaimana jika kita mencoba menantang pikiran otomatis yang muncul dengan bukti yang lebih seimbang?"
          ],
          "mindfulness-coach": [
            "Mari kita coba latihan pernapasan singkat bersama-sama. Tarik napas dalam... dan hembuskan perlahan...",
            "Coba perhatikan sensasi di tubuh Anda saat ini tanpa menghakimi. Apa yang Anda rasakan?",
            "Mindfulness adalah tentang menerima pengalaman apa adanya, tanpa berusaha mengubahnya."
          ],
          "friendly-listener": [
            "Wah, saya bisa memahami perasaan kamu. Terkadang hidup memang terasa berat ya.",
            "Terima kasih sudah mau berbagi dengan saya. Itu menunjukkan bahwa kamu adalah pribadi yang kuat.",
            "Saya di sini untuk kamu, tanpa penilaian. Ceritakan saja apa yang ada di hati dan pikiran kamu."
          ],
          "wisdom-mentor": [
            "Dalam kehidupan, terkadang kita perlu menerima hal-hal yang tidak dapat kita ubah, dan mengubah hal-hal yang dapat kita ubah.",
            "Kebijaksanaan kuno mengajarkan bahwa badai tidak berlangsung selamanya. Ini pun akan berlalu.",
            "Pertumbuhan seringkali terjadi justru di saat-saat yang paling menantang."
          ]
        };
        
        const responses = fallbackResponses[currentModel];
        const randomResponse = responses[Math.floor(Math.random() * responses.length)];
        
        // Tambahkan ke riwayat percakapan
        conversationHistory.push({ role: "assistant", content: randomResponse });
        
        appendMessage("assistant", "⚠️ Maaf, terjadi kendala teknis. Berikut respons dari sistem: " + randomResponse);
      }
    }

    function appendMessage(role, text, isSystem = false) {
      const msg = document.createElement("div");
      msg.className = `msg ${role}`;
      
      if (role === "assistant" && !isSystem) {
        const badge = document.createElement("div");
        badge.className = "psy-badge";
        badge.textContent = document.querySelector('.current-contact-info h3').textContent;
        msg.appendChild(badge);
      }
      
      msg.innerHTML += text.replace(/\n/g, '<br>');
      
      // Tambahkan info pesan
      const msgInfo = document.createElement("div");
      msgInfo.className = "msg-info";
      
      const now = new Date();
      const timeString = now.getHours().toString().padStart(2, '0') + ':' + 
                        now.getMinutes().toString().padStart(2, '0');
      
      const name = role === 'user' ? 'Anda' : document.querySelector('.current-contact-info h3').textContent;
      msgInfo.innerHTML = `<span>${name}</span><span>${timeString}</span>`;
      
      msg.appendChild(msgInfo);
      messagesDiv.appendChild(msg);

      // Scroll ke pesan terakhir
      msg.scrollIntoView({ behavior: "smooth", block: "nearest" });
    }

    function showTypingIndicator() {
      const indicator = document.createElement("div");
      indicator.className = "typing-indicator";
      indicator.id = "typing-indicator";
      
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
      if (event.key === "Enter") {
        sendMessage();
      }
    }

    document.addEventListener('DOMContentLoaded', function() {
      console.log("PsyMind AI initialized with Gemini API integration");
      
      const config = psychologistConfigs[currentModel];
      appendMessage("assistant", config.greeting, true);
      
      conversationHistory.push({ role: "assistant", content: config.greeting });
    });
</script>
@endsection