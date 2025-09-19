<?php

namespace App\Http\Controllers;

use App\Models\Mood;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
        function getRandomQuote()
    {
        // Path file JSON
        $path = public_path('assets/json/text.json');

        // Cek apakah file ada
        if (!file_exists($path)) {
            return response()->json([
                'success' => false,
                'message' => 'File JSON tidak ditemukan'
            ], 404);
        }

        // Ambil isi file JSON
        $json = file_get_contents($path);
        $quotes = json_decode($json, true);

        // Cek validitas data
        if (!$quotes || !is_array($quotes)) {
            return response()->json([
                'success' => false,
                'message' => 'Data JSON tidak valid'
            ], 500);
        }

        // Ambil random 1 data
        $randomQuote = $quotes[array_rand($quotes)];

        return $randomQuote;
    }
    public function index()
    {
        $user = Auth::user()->load([
            'role',
            'messages',
            'moods',
            'journals',
            'challenges',
            'exercises'
        ]);

        $userId = $user->id;

        $topPost = Post::inRandomOrder()->first();

        $riwayatJournal = $user->journals->map(function ($journal) {
            return Carbon::parse($journal->updated_at)->day; // ambil angka harinya
        });

        $riwayatMeditasi = $user->exercises->map(function ($exercise) {
            return Carbon::parse($exercise->updated_at)->day;
        });

        $moods = Mood::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('MAX(mood) as mood') // ambil mood terakhir tiap hari
            )
            ->where('user_id', $userId)
            ->where('created_at', '>=', Carbon::now()->subDays(6))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $moodMap = [
            'sad' => 1,
            'anxious' => 2,
            'stressed' => 2,
            'calm' => 3,
            'tired' => 3,
            'happy' => 4,
            'relaxed' => 4,
            'angry' => 2,
            'energetic' => 5,
        ];

        $data = [];
        $labels = [];

        // 7 hari terakhir (biar selalu lengkap walau kosong)
        for ($i = 6; $i >= 0; $i--) {
            $day = Carbon::now()->subDays($i);
            $labels[] = $day->locale('id')->isoFormat('dd'); // Sen, Sel, dst

            $found = $moods->firstWhere('date', $day->toDateString());

            $data[] = $found ? ($moodMap[$found->mood] ?? 0) : 0;
        }
$quote= $this->getRandomQuote();
// dd($quote);
        return view('dashboard', compact(
            'user',
            'topPost',
            'riwayatJournal',
            'riwayatMeditasi',
            'labels',
            'data',
            'quote'
        ));
    }

}
