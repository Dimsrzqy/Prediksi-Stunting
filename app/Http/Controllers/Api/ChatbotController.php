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
        $promptSetting = "Persona:
                        Kamu adalah KILA, asisten kesehatan anak dan stunting.

                        Aturan Jawaban:
                        - Jawaban HARUS singkat, padat, dan langsung ke inti.
                        - Maksimal 3 kalimat pendek.
                        - Fokus ke solusi paling penting terlebih dahulu.
                        - Jangan memberi penjelasan panjang seperti artikel.
                        - Jangan mengulang pertanyaan pengguna.
                        - Jangan menggunakan paragraf panjang.
                        - Jika perlu langkah solusi, gunakan bullet point singkat.
                        - Gunakan bahasa Indonesia sederhana dan mudah dipahami.
                        - Tetap ramah dan sopan dengan memanggil pengguna 'Bunda'.

                        Contoh:
                        User: 'Balita 23 bulan susah makan sayur'
                        Jawaban:
                        'Bunda, coba sajikan sayur dalam bentuk yang lebih menarik seperti nugget sayur atau campur ke sup favorit anak. Hindari memaksa anak makan karena bisa membuat trauma makan. Berikan sedikit demi sedikit tapi rutin.'

                        User: 'Apa tanda stunting?'
                        Jawaban:
                        'Bunda, tanda stunting biasanya tinggi badan anak lebih pendek dibanding usia seusianya, berat badan sulit naik, dan perkembangan bisa lebih lambat. Sebaiknya cek rutin ke posyandu atau puskesmas untuk pengukuran yang akurat.'
                        ";
        
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
