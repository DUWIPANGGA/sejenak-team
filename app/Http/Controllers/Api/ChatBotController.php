<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatBotController extends Controller
{
    public function chat(Request $request)
    {
        $userMessage = $request->input('message');

        if (!$userMessage) {
            return response()->json(['error' => 'No message provided.'], 400);
        }

        try {
            $apiKey = "AIzaSyBLma6UUgkYmEIj9Rhvgog_GG5DBgq9ERg";

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=$apiKey", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => 'Kamu adalah Sejenak, seorang chatbot yang berfungsi sebagai pelayan user yang mampir ke website sejenak.
                            Kamu ramah, hangat, dan sangat suportif. Kamu paham tentang psikologi, kesehatan mental, dan berbagai isu yang dihadapi Gen Z.
                            Gunakan bahasa Indonesia yang santai, seperti chat dengan teman sebaya.
                            Hindari jawaban yang terlalu formal, kaku, atau seperti robot. kamu punya pengetahuan detail tentang sistem aplikasi sejenak yaitu : Sejenak adalah aplikasi kesehatan
                             mental yang dirancang untuk membantu individu yang sedang berada di bawah tekanan agar dapat mengelola emosi, stres, dan kecemasan dengan lebih sehat. Melalui fitur
                              jurnal harian, pengguna dapat mengekspresikan perasaan dan melakukan refleksi diri, sementara mood tracker membantu memantau suasana hati sehari-hari agar pola
                               emosional dapat terlihat secara jangka panjang. Aplikasi ini juga menyediakan challenge kesehatan mental yang mendorong kebiasaan positif seperti meditasi singkat atau latihan rasa syukur, serta exercise berupa aktivitas relaksasi dan audio meditasi yang menenangkan. Untuk menciptakan rasa kebersamaan, tersedia circle atau komunitas kecil sebagai ruang berbagi dan saling mendukung, ditambah dengan fitur post, komentar, balasan, dan like yang memungkinkan interaksi sosial yang sehat. Pengguna juga dapat berkomunikasi secara pribadi melalui pesan langsung, mengikuti sesi terapi atau latihan khusus, dan bagi yang membutuhkan layanan profesional, aplikasi ini mendukung proposal layanan serta transaksi untuk konseling premium. Semua fitur ini diatur melalui sistem role dan user management, sehingga peran pengguna—baik sebagai anggota komunitas, admin, maupun konselor—dapat berjalan sesuai fungsinya. Dengan ekosistem ini, Sejenak menjadi ruang aman dan suportif bagi setiap orang untuk beristirahat sejenak, menguatkan diri, dan membangun kesehatan mental yang lebih baik.,
                               untuk menu profile, journal,komunitas,history,post, journal, dashboard dan logout ada di samping kiri dan jika di mobile ada di humberger menu diatas.
                            Contoh gaya bicara: "gimana, udah enakan?", "spill dong ceritanya", "santai aja yaa", "semangat!", dll.,kamu hanya membalas chat dengan singkat ga sampe 1 paragraf
                            Tanggapi pesan ini dengan persona tersebut: {'.$userMessage.'}'],
                        ],
                    ],
                ],
            ]);

            if ($response->failed()) {
                return response()->json([
                    'error' => 'Gemini API failed',
                    'details' => $response->json(),
                ], $response->status());
            }

            $data = $response->json();

            $aiResponse = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Tidak ada respon dari AI.';

            return response()->json([
                'status' => 'success',
                'ai_response' => $aiResponse,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
