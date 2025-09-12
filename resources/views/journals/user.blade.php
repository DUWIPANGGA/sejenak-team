@extends('layouts.app')

@section('title', 'Journaling')
<style>
    /* Tambahan styling untuk memoles detail seperti pada gambar */
    .calendar-day-circle {
        @apply w-6 h-6 md:w-8 md:h-8 flex justify-center items-center rounded-full border-2 border-dark cursor-pointer transition-colors text-xs md:text-sm font-semibold;
    }

    /* Efek hover untuk hari di kalender */
    .calendar-day-circle:hover {
        @apply border-primary text-primary bg-primary/20; /* Warna border dan teks berubah, latar belakang sedikit transparan */
    }

    /* Efek hover khusus untuk hari yang memiliki jurnal */
    .calendar-day-circle.journaled:hover {
        @apply bg-primary/40;
    }

    /* Efek untuk hari yang dipilih/aktif */
    .calendar-day-circle.active {
        @apply border-primary bg-primary text-white shadow-border-offset-accent-alt;
    }

    .calendar-dot {
        @apply w-2 h-2 rounded-full absolute -bottom-1;
    }

    /* Mengatur item aktif Riwayat agar terlihat "tenggelam" */
    .history-item-active {
        @apply bg-primary border-2 border-dark text-white shadow-none transform translate-x-1 translate-y-1;
    }

    /* Efek hover untuk item riwayat */
    .history-item:hover {
        @apply bg-gray-200 shadow-none transform translate-x-1 translate-y-1; /* Menggunakan shadow-none untuk menghilangkan bayangan saat hover */
    }

    /* Styling untuk dropdown format */
    .format-dropdown {
        position: relative;
        display: inline-block;
    }

    .format-dropdown-content {
        display: none;
        position: absolute;
        background-color: white;
        border: 2px solid #333;
        border-radius: 8px;
        min-width: 120px;
        box-shadow: 4px 4px 0 #333;
        z-index: 10;
        bottom: 100%;
        left: 0;
        margin-bottom: 8px;
    }

    .format-dropdown-content button {
        display: block;
        width: 100%;
        padding: 8px 12px;
        text-align: left;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 14px;
        transition: background-color 0.2s;
    }

    .format-dropdown-content button:hover {
        background-color: #f0f0f0;
    }

    .format-dropdown:hover .format-dropdown-content {
        display: block;
    }

    /* Styling untuk color picker */
    .color-dropdown {
        position: relative;
        display: inline-block;
    }

    .color-dropdown-content {
        display: none;
        position: absolute;
        background-color: white;
        border: 2px solid #333;
        border-radius: 8px;
        width: 150px;
        box-shadow: 4px 4px 0 #333;
        z-index: 10;
        bottom: 100%;
        left: 0;
        margin-bottom: 8px;
        padding: 10px;
    }

    .color-option {
        width: 20px;
        height: 20px;
        border: 2px solid #333;
        border-radius: 50%;
        display: inline-block;
        margin: 4px;
        cursor: pointer;
    }

    /* Menambahkan visual untuk warna yang aktif */
    .color-option.active {
        border-width: 4px;
    }

    /* Style untuk format teks di editor */
    #editor-content h1 {
        font-size: 2em;
        font-weight: bold;
        margin: 0.67em 0;
    }

    #editor-content h2 {
        font-size: 1.5em;
        font-weight: bold;
        margin: 0.83em 0;
    }

    #editor-content h3 {
        font-size: 1.17em;
        font-weight: bold;
        margin: 1em 0;
    }

    #editor-content h4 {
        font-size: 1em;
        font-weight: bold;
        margin: 1.33em 0;
    }

    #editor-content h5 {
        font-size: 0.83em;
        font-weight: bold;
        margin: 1.67em 0;
    }

    #editor-content h6 {
        font-size: 0.67em;
        font-weight: bold;
        margin: 2.33em 0;
    }

    #editor-content small {
        font-size: 0.8em;
    }

    /* NEW STYLES: Header dengan warna dan efek shadow */
    .header-journal {
        @apply p-4 rounded-playful-lg;
        background-color: #f0f0f0; /* Warna latar belakang abu-abu terang */
        border: 2px solid #333; /* Border solid */
        box-shadow: 4px 4px 0 #333; /* Offset shadow */
    }

    /* NEW STYLES: Efek hover pada item riwayat */
    .history-item {
        @apply p-3 bg-gray-100 border-2 border-dark rounded-playful-md flex justify-between items-center cursor-pointer shadow-border-offset transition-all;
    }

    .history-item:not(.history-item-active):hover {
        @apply bg-gray-200 transform translate-x-1 translate-y-1 shadow-none;
    }
</style>

@section('content')

<div class="flex flex-col md:flex-row w-full h-full gap-2 md:gap-4 p-2 md:p-4 rounded-playful-lg overflow-scroll md:overflow-hidden">

    <div class="flex flex-col w-full md:w-[350px] min-w-[280px] h-full gap-4">

        <div class="p-4 bg-white border-2 border-dark rounded-playful-lg shadow-border-offset">
            <h2 class="text-3xl font-extrabold text-dark text-center mb-6">Desember</h2>
            <div class="grid grid-cols-7 gap-2 text-center">
                @php
                    $daysInMonth = 31;
                    // Asumsi hari pertama bulan Desember adalah hari Jumat (indeks 4)
                    $startDay = 5; 
                    // Data dummy untuk hari yang diisi (misal: tanggal 3, 5, 8)
                    $journaledDays = [3, 4, 5, 8, 9, 10]; 
                @endphp
                
                @for ($i = 0; $i < $startDay; $i++)
                    <div></div>
                @endfor
                
                @for ($day = 1; $day <= $daysInMonth; $day++)
                    @php
                        $isJournaled = in_array($day, $journaledDays);
                        $isActive = ($day == 3); // Hari dengan lingkaran hijau
                    @endphp
                    <div class="relative flex justify-center items-center">
                        <div class="calendar-day-circle {{ $isJournaled ? ($isActive ? 'border-primary bg-white' : 'border-dark bg-white') : 'bg-white border-gray-300' }} hover:border-primary hover:text-primary">
                            {{ $day }}
                        </div>
                        {{-- Dot indikator jurnal --}}
                        @if ($isJournaled)
                            <div class="calendar-dot bg-primary"></div>
                        @endif
                    </div>
                @endfor
            </div>
        </div>

        <div class="flex-1  bg-white border-2 border-dark rounded-playful-lg shadow-border-offset flex flex-col overflow-hidden">
            <h3 class="text-xl font-bold border-b-2 border-dark text-center text-white mb-4 p-2 bg-primary">Riwayat</h3>
            <div class="flex-1 space-y-3 overflow-y-auto pr-2 p-4 m-0">
                @php
                    $historyItems = [
                        ['title' => 'Bros...', 'date' => '28 Okt 2024', 'active' => false],
                        ['title' => "We're SOOO back", 'date' => '28 Okt 2024', 'active' => false],
                        ['title' => 'Its SOOO over', 'date' => '28 Okt 2024', 'active' => false],
                        ['title' => 'Bros...', 'date' => '28 Okt 2024', 'active' => false],
                        ['title' => 'WERE BACK', 'date' => '28 Okt 2024', 'active' => false],
                        ['title' => 'ITS OVER', 'date' => '28 Okt 2024', 'active' => true], // Item Aktif
                        ['title' => 'My first day', 'date' => '27 Okt 2024', 'active' => false],
                        ['title' => 'Thinking about life', 'date' => '27 Okt 2024', 'active' => false],
                        ['title' => 'What a day', 'date' => '26 Okt 2024', 'active' => false],
                    ];
                @endphp

                @foreach ($historyItems as $item)
                    <div class="p-3 bg-gray-100 border-2 border-dark rounded-playful-md flex justify-between items-center cursor-pointer shadow-border-offset hover:shadow-none hover:translate-x-0.5 hover:translate-y-0.5 transition-all
                        {{ $item['active'] ? 'history-item-active' : '' }}">
                        <p class="text-sm font-medium">{{ $item['title'] }}</p>
                        <span class="text-xs {{ $item['active'] ? 'text-white/80' : 'text-gray-500' }}">{{ $item['date'] }}</span>
                    </div>
                @endforeach
            </div>

            <div class="mt-4 flex justify-between items-center px-4 pb-4">
                <div class="py-2 px-4 bg-secondary border-2 border-dark rounded-full shadow-border-offset-accent flex items-center gap-2 cursor-pointer hover:bg-secondary/90">
                    <span class="text-white text-xs font-semibold">Notebook1</span>
                    <i class="fas fa-chevron-down text-white text-xs"></i>
                </div>
                <div class="py-2 px-4 bg-gray-200 border-2 border-dark rounded-full cursor-pointer hover:bg-gray-300 transition-colors shadow-border-offset">
                    <span class="text-dark text-xs font-semibold">New</span>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col flex-1 h-full bg-white border-2 border-dark rounded-playful-lg shadow-border-offset p-6  min-w-[300px]">
        
        <div class="flex justify-between items-start mb-4 pb-2 border-b-2 border-dark">
            <div class="flex flex-col">
                <input type="text" value="Judul Baru" class="text-2xl md:text-3xl font-bold text-dark mb-1 bg-transparent focus:outline-none border-none p-0"/>
                <p class="text-sm text-gray-500">New Note</p>
            </div>
            <div class="flex flex-col items-end text-sm text-gray-500">
                <span class="text-sm">10:24</span>
                <span class="text-sm">29 Oktober, 2024</span>
            </div>
        </div>
        
        <div class="flex-1 overflow-y-auto p-2">
            {{-- Menggunakan div dengan contenteditable untuk editor gaya WYSIWYG --}}
            <div id="editor-content" contenteditable="true"
                class="w-full h-full p-0 bg-transparent focus:outline-none text-dark text-base md:text-lg min-h-[50vh]"
                placeholder="Tulis jurnal Anda di sini...">
                {{-- Konten awal bisa ditaruh di sini --}}
                <p>Mulai menulis jurnalmu hari ini...</p>
            </div>
        </div>

        <div class="flex items-center justify-between p-3 mt-4 border-t-2 border-dark">
            <div class="flex space-x-4 text-xl text-dark">
                <div class="format-dropdown">
                    <button class="toolbar-btn" title="Format Teks">
                        <i class="fas fa-heading"></i>
                    </button>
                    <div class="format-dropdown-content">
                        <button data-command="formatBlock" data-value="h1">Heading 1</button>
                        <button data-command="formatBlock" data-value="h2">Heading 2</button>
                        <button data-command="formatBlock" data-value="h3">Heading 3</button>
                        <button data-command="formatBlock" data-value="h4">Heading 4</button>
                        <button data-command="formatBlock" data-value="h5">Heading 5</button>
                        <button data-command="formatBlock" data-value="h6">Heading 6</button>
                        <button data-command="formatBlock" data-value="p">Paragraf</button>
                        <button data-command="formatBlock" data-value="small">Kecil</button>
                    </div>
                </div>
                
                <div class="color-dropdown hidden">
                    <button class="toolbar-btn" id="color-btn" title="Warna Teks">
                        <i class="fas fa-palette"></i>
                    </button>
                    <div class="color-dropdown-content">
                        <div class="color-option" style="background-color: #FF0000;" data-value="#FF0000"></div>
                        <div class="color-option" style="background-color: #FF6600;" data-value="#FF6600"></div>
                        <div class="color-option" style="background-color: #FFCC00;" data-value="#FFCC00"></div>
                        <div class="color-option" style="background-color: #00CC00;" data-value="#00CC00"></div>
                        <div class="color-option" style="background-color: #0066FF;" data-value="#0066FF"></div>
                        <div class="color-option" style="background-color: #6600CC;" data-value="#6600CC"></div>
                        <div class="color-option" style="background-color: #000000;" data-value="#000000"></div>
                        <div class="color-option" style="background-color: #666666;" data-value="#666666"></div>
                        <div class="color-option" style="background-color: #999999;" data-value="#999999"></div>
                        <div class="color-option" style="background-color: #FFFFFF; border: 2px solid #333;" data-value="#FFFFFF"></div>
                    </div>
                </div>
                
                <button class="toolbar-btn" data-command="bold" id="btn-bold" title="Bold"><i class="fas fa-bold"></i></button>
                <button class="toolbar-btn" data-command="italic" id="btn-italic" title="Italic"><i class="fas fa-italic"></i></button>
                <button class="toolbar-btn" data-command="underline" id="btn-underline" title="Underline"><i class="fas fa-underline"></i></button>
                <button class="toolbar-btn" data-command="strikeThrough" id="btn-strike" title="Strikethrough"><i class="fas fa-strikethrough"></i></button>
                <button class="toolbar-btn" data-command="insertHorizontalRule" title="Horizontal Rule"><i class="fas fa-minus"></i></button>
            </div>
            
            <button class="w-12 h-12 flex justify-center items-center bg-primary border-2 border-dark rounded-full shadow-border-offset-accent hover:bg-primary/80 transition-colors">
                <i class="fas fa-check text-dark text-xl"></i>
            </button>
        </div>
    </div>
</div>

@endsection


@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editorContent = document.getElementById('editor-content');
        const toolbarButtons = document.querySelectorAll('.toolbar-btn');
        const formatDropdown = document.querySelector('.format-dropdown');
        const formatButtons = document.querySelectorAll('.format-dropdown-content button');
        const colorDropdown = document.querySelector('.color-dropdown');
        const colorOptions = document.querySelectorAll('.color-option');
        const checkButton = document.querySelector('.fa-check').closest('button');
        const colorBtn = document.getElementById('color-btn');

        // Helper function to execute a command and refocus
        const executeCommand = (command, value = null) => {
            document.execCommand('styleWithCSS', false, true);
            document.execCommand(command, false, value);
            editorContent.focus(); 
        };

        // Helper function to close all dropdowns
        const closeAllDropdowns = () => {
            document.querySelectorAll('.format-dropdown-content, .color-dropdown-content').forEach(dropdown => {
                dropdown.style.display = 'none';
            });
        };

        // Toggle dropdowns on click
        formatDropdown.querySelector('.toolbar-btn').addEventListener('click', (e) => {
            e.stopPropagation();
            const dropdownContent = formatDropdown.querySelector('.format-dropdown-content');
            closeAllDropdowns();
            dropdownContent.style.display = 'block';
        });

        colorDropdown.querySelector('.toolbar-btn').addEventListener('click', (e) => {
            e.stopPropagation();
            const dropdownContent = colorDropdown.querySelector('.color-dropdown-content');
            closeAllDropdowns();
            dropdownContent.style.display = 'block';
        });

        // Add event listeners for format buttons
        formatButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const command = this.getAttribute('data-command');
                const value = this.getAttribute('data-value');
                if (command) {
                    executeCommand(command, value);
                }
                closeAllDropdowns();
            });
        });

        // Add event listeners for color options
        colorOptions.forEach(option => {
            option.addEventListener('click', function(e) {
                e.preventDefault();
                const value = this.getAttribute('data-value');
                executeCommand('foreColor', value);
                closeAllDropdowns();
                updateToolbarState(); // Perbarui status toolbar setelah memilih warna
            });
        });

        // Event listeners for toolbar buttons (bold, italic, etc.)
        toolbarButtons.forEach(button => {
            const command = button.getAttribute('data-command');
            if (command && command !== 'formatBlock' && command !== 'foreColor') {
                button.addEventListener('click', (e) => {
                    e.preventDefault(); 
                    executeCommand(command);
                });
            }
        });

        // Update toolbar state based on cursor position
        const updateToolbarState = () => {
            // Update bold, italic, underline state
            toolbarButtons.forEach(button => {
                const command = button.getAttribute('data-command');
                if (command && document.queryCommandSupported(command)) {
                    if (document.queryCommandState(command)) {
                        button.classList.add('text-primary');
                    } else {
                        button.classList.remove('text-primary');
                    }
                }
            });

            // Update color button state
            const currentColor = document.queryCommandValue('foreColor').toLowerCase();
            const hexColor = rgbToHex(currentColor);
            
            // Hapus class 'active' dari semua opsi warna
            colorOptions.forEach(option => option.classList.remove('active'));

            // Tambahkan class 'active' ke opsi warna yang cocok
            const activeOption = document.querySelector(`.color-option[data-value="${hexColor.toUpperCase()}"]`);
            if (activeOption) {
                activeOption.classList.add('active');
                colorBtn.style.color = hexColor;
            } else {
                colorBtn.style.color = 'initial'; // Reset ke warna default jika tidak ada kecocokan
            }
        };

        // Helper function to convert RGB to Hex
        function rgbToHex(rgb) {
            if (rgb.indexOf('rgb') === -1) {
                return rgb;
            }
            const match = /rgb\((\d+),\s*(\d+),\s*(\d+)\)/.exec(rgb);
            if (!match) return rgb;
            const r = parseInt(match[1]).toString(16).padStart(2, '0');
            const g = parseInt(match[2]).toString(16).padStart(2, '0');
            const b = parseInt(match[3]).toString(16).padStart(2, '0');
            return `#${r}${g}${b}`.toUpperCase();
        }

        editorContent.addEventListener('keyup', updateToolbarState);
        editorContent.addEventListener('mouseup', updateToolbarState);
        editorContent.addEventListener('focus', updateToolbarState);
        
        // Close dropdowns when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.format-dropdown') && !e.target.closest('.color-dropdown')) {
                closeAllDropdowns();
            }
        });

        // Optional: Add a simple click handler for the save button
        checkButton.addEventListener('click', () => {
            const journalTitle = document.querySelector('input[type="text"]').value;
            const journalContent = editorContent.innerHTML;
            console.log("Journal Title:", journalTitle);
            console.log("Journal Content:", journalContent);
            alert("Journal saved! (Check console for data)");
        });
        
        // Initial state update
        updateToolbarState();
    });
</script>
@endsection