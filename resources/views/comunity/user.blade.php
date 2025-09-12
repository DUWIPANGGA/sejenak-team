@extends('layouts.app')

@section('content')
<div class="w-full min-h-full flex flex-col md:flex-row gap-6 p-8 justify-center items-start relative overflow-auto">

    <div class="w-full md:hidden mb-6">
        <div class="relative w-full">
            <input type="text" placeholder="Pencarian..." class="w-full p-4 pl-12 rounded-playful-lg border-2 border-dark shadow-border-offset font-lexend focus:outline-none">
            <img src="https://www.svgrepo.com/show/511048/search.svg" alt="Pencarian" class="absolute left-4 top-1/2 -translate-y-1/2 w-6 h-6 text-gray-400">
        </div>
    </div>

    <aside class="left-sidebar hidden md:block w-full md:w-1/4 lg:w-1/5 flex-shrink-0">
        <div class="bg-white p-6 rounded-playful-lg border-2 border-dark shadow-border-offset">
            <h2 class="font-bold text-xl font-exo2 text-dark mb-4">Community</h2>
            <nav class="space-y-2">
                <a href="#" class="flex items-center gap-2 p-2 rounded-playful-lg font-medium font-lexend text-dark hover:bg-gray-100 transition-all">
                    <img src="https://www.svgrepo.com/show/532367/home-solid.svg" alt="Homepage" class="w-6 h-6">
                    Homepage
                </a>
                <a href="#" class="flex items-center gap-2 p-2 rounded-playful-lg font-medium font-lexend text-dark hover:bg-gray-100 transition-all">
                    <img src="https://www.svgrepo.com/show/522194/fire.svg" alt="Popular" class="w-6 h-6">
                    Populer
                </a>
                <a href="#" class="flex items-center gap-2 p-2 rounded-playful-lg font-medium font-lexend text-dark hover:bg-gray-100 transition-all">
                    <img src="https://www.svgrepo.com/show/521360/star.svg" alt="Terbaru" class="w-6 h-6">
                    Terbaru
                </a>
                <a href="#" class="flex items-center gap-2 p-2 rounded-playful-lg font-medium font-lexend text-dark hover:bg-gray-100 transition-all">
                    <img src="https://www.svgrepo.com/show/511048/search.svg" alt="Pencarian" class="w-6 h-6">
                    Pencarian
                </a>
                <a href="#" class="flex items-center gap-2 p-2 rounded-playful-lg font-medium font-lexend text-dark hover:bg-gray-100 transition-all">
                    <img src="https://www.svgrepo.com/show/503460/bell.svg" alt="Notifikasi" class="w-6 h-6">
                    Notifikasi
                </a>
            </nav>
        </div>
    </aside>

    <main class="main-content w-full md:w-2/4 lg:w-1/2 flex-grow flex flex-col items-center gap-6">
        <h1 class="font-bold text-3xl font-exo2 text-dark text-shadow-h1">Homepage</h1>
        <div class="post-card w-full max-w-2xl bg-white p-6 rounded-playful-lg border-2 border-dark shadow-border-offset">
            <div class="flex items-center mb-4">
                <img src="https://www.svgrepo.com/show/382109/male-avatar-boy-person-user.svg" alt="User Profile" class="w-10 h-10 rounded-full border-2 border-dark shadow-border-offset mr-3">
                <div class="flex-1">
                    <h3 class="font-bold font-lexend text-dark text-lg">User 1</h3>
                    <p class="text-sm text-gray-500 font-lexend">@user1 • 1 jam yang lalu</p>
                </div>
            </div>
            <div class="w-full h-auto rounded-playful-lg mb-4 border-2 border-dark overflow-hidden shadow-border-offset">
                <img src="https://images.unsplash.com/photo-1543877087-dec747f54695?q=80&w=1788&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Post Image" class="w-full h-full object-cover">
            </div>
            <p class="font-medium font-lexend text-dark mb-4">Guys cara buat ngilangin self doubts gimana ya :(</p>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <button class="flex items-center gap-1 text-dark hover:text-red-500 transition-colors">
                        <img src="https://www.svgrepo.com/show/511051/heart-fill.svg" alt="Like" class="w-6 h-6">
                        <span class="font-lexend text-sm">52</span>
                    </button>
                    <button class="flex items-center gap-1 text-dark hover:text-blue-500 transition-colors" onclick="openCommentModal()">
                        <img src="https://www.svgrepo.com/show/513554/comment-fill.svg" alt="Comment" class="w-6 h-6">
                        <span class="font-lexend text-sm">12</span>
                    </button>
                </div>
                <button class="bg-orange text-white px-4 py-2 rounded-playful-lg border-2 border-dark font-lexend text-sm shadow-border-offset hover:bg-orange/80 transition-all active:shadow-[1px_2px_0px_#1A1A40] active:translate-x-0.5 active:translate-y-0.5">
                    Ikuti
                </button>
            </div>
        </div>
    </main>

    <aside class="right-sidebar w-full md:w-1/4 lg:w-1/5 flex-shrink-0 ">
        <div class="bg-white p-6 rounded-playful-lg border-2 border-dark shadow-border-offset">
            <h2 class="font-bold text-xl font-exo2 text-dark mb-4">Community</h2>
            <div class="space-y-4">
                <div class="flex items-center gap-4">
                    <img src="https://www.svgrepo.com/show/382109/male-avatar-boy-person-user.svg" alt="User 1" class="w-10 h-10 rounded-full border-2 border-dark shadow-border-offset">
                    <div>
                        <p class="font-lexend font-bold text-dark">User 1</p>
                        <p class="font-lexend text-sm text-gray-500">Ahli #1</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <img src="https://www.svgrepo.com/show/382109/male-avatar-boy-person-user.svg" alt="User 2" class="w-10 h-10 rounded-full border-2 border-dark shadow-border-offset">
                    <div>
                        <p class="font-lexend font-bold text-dark">User 2</p>
                        <p class="font-lexend text-sm text-gray-500">Ahli #1</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <img src="https://www.svgrepo.com/show/382109/male-avatar-boy-person-user.svg" alt="User 3" class="w-10 h-10 rounded-full border-2 border-dark shadow-border-offset">
                    <div>
                        <p class="font-lexend font-bold text-dark">User 3</p>
                        <p class="font-lexend text-sm text-gray-500">Ahli #1</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <img src="https://www.svgrepo.com/show/382109/male-avatar-boy-person-user.svg" alt="User 4" class="w-10 h-10 rounded-full border-2 border-dark shadow-border-offset">
                    <div>
                        <p class="font-lexend font-bold text-dark">User 4</p>
                        <p class="font-lexend text-sm text-gray-500">Ahli #1</p>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <a href="#" class="fixed bottom-8 right-8 w-16 h-16 bg-primary text-white rounded-full flex items-center justify-center border-2 border-dark shadow-border-offset hover:bg-primary/80 transition-all active:shadow-[1px_2px_0px_#1A1A40] active:translate-x-0.5 active:translate-y-0.5 md:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-8 h-8">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
    </a>

</div>

<div id="commentModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4 hidden">
    <div class="bg-white p-6 rounded-playful-lg border-2 border-dark max-w-xl w-full shadow-border-offset overflow-y-auto max-h-[90vh]">
        <div class="flex justify-between items-center mb-4 border-b pb-4">
            <h3 class="text-xl font-bold font-exo2 text-dark">Komentar</h3>
            <button class="text-dark hover:text-gray-500 transition-colors" onclick="closeCommentModal()">
                <img src="https://www.svgrepo.com/show/501309/close-sm.svg" alt="Close" class="w-6 h-6">
            </button>
        </div>
        <div class="flex flex-col items-center mb-6">
            <div class="w-full max-w-md h-auto rounded-playful-lg border-2 border-dark overflow-hidden shadow-border-offset mb-4">
                <img src="https://images.unsplash.com/photo-1543877087-dec747f54695?q=80&w=1788&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Post Image" class="w-full h-full object-cover">
            </div>
            <p class="font-medium font-lexend text-dark text-center">Guys cara buat ngilangin self doubts gimana ya :(</p>
        </div>
        <div class="comments-section space-y-6">
            <div class="comment flex gap-3">
                <img src="https://www.svgrepo.com/show/382109/male-avatar-boy-person-user.svg" alt="Commenter 1" class="w-8 h-8 rounded-full border-2 border-dark shadow-border-offset flex-shrink-0">
                <div class="flex-1">
                    <div class="bg-gray-100 p-3 rounded-playful-lg border-2 border-dark shadow-border-offset">
                        <div class="flex justify-between items-center mb-1">
                            <p class="font-bold font-lexend text-dark text-sm">User 2</p>
                            <span class="text-xs text-gray-500 font-lexend">2 menit yang lalu</span>
                        </div>
                        <p class="font-lexend text-sm text-dark">Wajar kok! Semua orang pasti pernah ngerasain itu. Coba mulai dari hal kecil yang kamu bisa kuasai.</p>
                    </div>
                    <div class="flex items-center gap-4 mt-2 ml-3">
                        <button class="flex items-center gap-1 text-dark hover:text-red-500 transition-colors">
                            <img src="https://www.svgrepo.com/show/511051/heart-fill.svg" alt="Like" class="w-4 h-4">
                            <span class="font-lexend text-xs">2</span>
                        </button>
                        <button class="text-xs font-lexend text-gray-500 hover:text-dark transition-colors" onclick="showReplyForm('replyForm1')">Balas</button>
                    </div>
                    <div id="replyForm1" class="hidden mt-4 ml-8">
                        <textarea class="w-full p-2 text-sm border-2 border-dark rounded-playful-lg shadow-border-offset focus:outline-none font-lexend" placeholder="Tulis balasan..."></textarea>
                        <div class="flex justify-end mt-2">
                            <button class="bg-primary text-white px-3 py-1 rounded-playful-lg border-2 border-dark font-lexend text-sm shadow-border-offset hover:bg-primary/80 transition-all active:shadow-[1px_2px_0px_#1A1A40] active:translate-x-0.5 active:translate-y-0.5">Kirim</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="comment flex gap-3">
                <img src="https://www.svgrepo.com/show/382109/male-avatar-boy-person-user.svg" alt="Commenter 2" class="w-8 h-8 rounded-full border-2 border-dark shadow-border-offset flex-shrink-0">
                <div class="flex-1">
                    <div class="bg-gray-100 p-3 rounded-playful-lg border-2 border-dark shadow-border-offset">
                        <div class="flex justify-between items-center mb-1">
                            <p class="font-bold font-lexend text-dark text-sm">User 3</p>
                            <span class="text-xs text-gray-500 font-lexend">5 menit yang lalu</span>
                        </div>
                        <p class="font-lexend text-sm text-dark">Setuju sama User 2! Fokus aja ke progres diri sendiri, jangan bandingin sama orang lain. Semangat!</p>
                    </div>
                    <div class="flex items-center gap-4 mt-2 ml-3">
                        <button class="flex items-center gap-1 text-dark hover:text-red-500 transition-colors">
                            <img src="https://www.svgrepo.com/show/511051/heart-fill.svg" alt="Like" class="w-4 h-4">
                            <span class="font-lexend text-xs">4</span>
                        </button>
                        <button class="text-xs font-lexend text-gray-500 hover:text-dark transition-colors" onclick="showReplyForm('replyForm2')">Balas</button>
                    </div>
                    <div id="replyForm2" class="hidden mt-4 ml-8">
                        <textarea class="w-full p-2 text-sm border-2 border-dark rounded-playful-lg shadow-border-offset focus:outline-none font-lexend" placeholder="Tulis balasan..."></textarea>
                        <div class="flex justify-end mt-2">
                            <button class="bg-primary text-white px-3 py-1 rounded-playful-lg border-2 border-dark font-lexend text-sm shadow-border-offset hover:bg-primary/80 transition-all active:shadow-[1px_2px_0px_#1A1A40] active:translate-x-0.5 active:translate-y-0.5">Kirim</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    // Get the comment modal element
    const commentModal = document.getElementById('commentModal');

    // Function to open the modal
    function openCommentModal() {
        commentModal.classList.remove('hidden');
    }

    // Function to close the modal
    function closeCommentModal() {
        commentModal.classList.add('hidden');
    }

    // Function to show/hide the reply form for a specific comment
    function showReplyForm(formId) {
        const replyForm = document.getElementById(formId);
        if (replyForm) {
            replyForm.classList.toggle('hidden');
        }
    }

    // Close modal when clicking outside of it
    window.onclick = function(event) {
        if (event.target == commentModal) {
            closeCommentModal();
        }
    }
</script>
@endsection