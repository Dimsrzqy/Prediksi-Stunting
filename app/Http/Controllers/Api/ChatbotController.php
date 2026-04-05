<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'history' => 'nullable|array' // Riwayat chat opsional
        ]);

        $apiKey = env('GEMINI_API_KEY');
        if (!$apiKey) {
            return response()->json(['reply' => 'Sistem Kila macet: GEMINI_API_KEY belum dipasang di .env Backend Laravel.'], 500);
        }

        $userInput = $request->input('message');
        
        // Prompt Engineering Profesional Sesuai Instruksi Baru
        $promptSetting = "Persona: Bertindak sebagai Asisten Pintar KILA (Klinik Ibu dan Anak), konsultan gizi, dan kesehatan anak yang ramah, berempati, dan profesional. Selalu sapa pengguna dengan sebutan 'Bunda'.\n\n"
            . "Kepadatan Jawaban (Conciseness): Jangan berikan jawaban 1 kalimat yang terlalu singkat, tapi hindari juga jawaban yang terlalu panjang seperti artikel Wikipedia. Berikan jawaban yang padat, komprehensif, dan langsung pada intinya (sekitar 2-4 paragraf pendek).\n\n"
            . "Format Solutif: Jika pengguna meminta saran atau bertanya solusi (misal: resep MPASI, cara mengatasi anak susah makan, atau kebersihan air), berikan poin-poin (bullet points) langkah praktis yang mudah diaplikasikan.\n\n"
            . "Tone & Gaya Bahasa: Gunakan bahasa Indonesia yang santai, sopan, suportif, dan menenangkan. Hindari bahasa medis yang terlalu berat tanpa penjelasan langsung.";
        
        $contents = $request->input('history', []);
        
        // Memasukkan pesan user saat ini ke dalam keranjang
        $contents[] = [
            'role' => 'user',
            'parts' => [['text' => $userInput]]
        ];

        $payload = [
            'contents' => $contents,
            'system_instruction' => [
                'parts' => [
                    ['text' => $promptSetting]
                ]
            ]
        ];

        // Menembak Rest API Asli Google
        // Update: karena beberapa versi 2.0 lite menahan kuota 0, kita ganti ke 2.5 flash yang lolos!
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}";

        try {
            // Mematikan verify SSL untuk menghindari "cURL error 60 SSL certificate problem" krn kita di localhost (Laragon) Windows
            $response = Http::withoutVerifying()
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post($url, $payload);
            
            if ($response->successful()) {
                $data = $response->json();
                $replyText = $data['candidates'][0]['content']['parts'][0]['text'] ?? "Maaf Bunda, otak pusat Kila tidak mengembalikan jawaban yang valid.";
                
                return response()->json([
                    'success' => true,
                    'reply' => $replyText
                ]);
            } else {
                Log::error('Gemini Error: ' . $response->body());
                return response()->json([
                    'success' => false,
                    'reply' => 'Maaf Bunda, otak pusat Kila mengeluh karena ditolak Google (HTTP '.$response->status().'). ' // Kami filter errornya agar user tdk pusing
                ], $response->status());
            }
        } catch (\Exception $e) {
            Log::error('Gemini Connection Exception: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'reply' => 'Koneksi dari Server Indonesia menuju server Google AI terputus tiba-tiba.'
            ], 500);
        }
    }
}
