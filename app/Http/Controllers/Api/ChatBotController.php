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
            $apiKey = env('GEMINI_API_KEY');

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=$apiKey", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $userMessage],
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
