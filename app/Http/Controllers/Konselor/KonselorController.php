<?php

namespace App\Http\Controllers\Konselor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class KonselorController extends Controller
{
    /**
     * Dashboard Konselor
     */
    public function dashboard()
    {
        // 1. DATA DUMMY UNTUK KARTU STATISTIK
        $stats = [
            'active_clients' => 8,
            'sessions_this_week' => 3,
            'new_messages' => 2,
            'completed_sessions' => 47,
        ];

        // 2. DATA DUMMY UNTUK JADWAL SESI MENDATANG
        $upcomingSessions = new Collection([
            (object)[
                'user' => (object)['name' => 'Budi Santoso'],
                'schedule_time' => Carbon::now()->addDays(1)->setTime(10, 0),
            ],
            (object)[
                'user' => (object)['name' => 'Citra Lestari'],
                'schedule_time' => Carbon::now()->addDays(2)->setTime(14, 30),
            ],
            (object)[
                'user' => (object)['name' => 'Agus Wijaya'],
                'schedule_time' => Carbon::now()->addDays(4)->setTime(11, 0),
            ],
        ]);

        // 3. DATA DUMMY UNTUK AKTIVITAS TERBARU
        $recentActivities = new Collection([
            (object)[
                'description' => 'Sesi dengan Budi Santoso berhasil dijadwalkan ulang.',
                'created_at' => Carbon::now()->subMinutes(30),
            ],
            (object)[
                'description' => 'Anda menerima pesan baru dari Citra Lestari.',
                'created_at' => Carbon::now()->subHours(2),
            ],
            (object)[
                'description' => 'Laporan sesi untuk Agus Wijaya telah selesai.',
                'created_at' => Carbon::now()->subHours(5),
            ],
        ]);
        
        // 4. Mengirim semua data dummy ke view
        return view('konselor.index', compact('stats', 'upcomingSessions', 'recentActivities'));
    }
}