<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiTesterController extends Controller
{
    /**
     * Display the API Tester UI.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.menus.api-tester');
    }

    /**
     * Execute the API request and return the result.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function execute(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
            'method' => 'required|in:GET,POST,PUT,DELETE,PATCH',
            'headers' => 'nullable|array',
            'body' => 'nullable|string',
        ]);

        $url = $request->input('url');
        $method = strtoupper($request->input('method'));
        $headers = $request->input('headers', []);
        $bodyRaw = $request->input('body', '{}');

        // Handle JSON Body
        $decodedBody = [];
        if (!in_array($method, ['GET', 'DELETE']) && !empty($bodyRaw)) {
            $decodedBody = json_decode($bodyRaw, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid JSON format in body: ' . json_last_error_msg()
                ], 400);
            }
        }

        try {
            $startTime = microtime(true);

            // Build the request
            $pendingRequest = Http::withHeaders($headers);

            // Execute the request
            $response = match ($method) {
                'GET'    => $pendingRequest->get($url),
                'POST'   => $pendingRequest->post($url, $decodedBody),
                'PUT'    => $pendingRequest->put($url, $decodedBody),
                'DELETE' => $pendingRequest->delete($url, $decodedBody),
                'PATCH'  => $pendingRequest->patch($url, $decodedBody),
                default  => throw new \Exception("Unsupported HTTP method: $method"),
            };

            $endTime = microtime(true);
            $executionTime = round(($endTime - $startTime) * 1000, 2); // ms

            // Process response body (try to parse as JSON first)
            $content = $response->body();
            $jsonContent = $response->json();

            return response()->json([
                'success' => true,
                'data' => [
                    'status'      => $response->status(),
                    'statusText'  => $this->getStatusText($response->status()),
                    'headers'     => $response->headers(),
                    'body'        => $jsonContent ?? $content,
                    'isJson'      => !is_null($jsonContent),
                    'time'        => $executionTime . ' ms',
                    'size'        => number_format(strlen($content) / 1024, 2) . ' KB'
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('API Tester Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Request error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Simple helper to get status text.
     * 
     * @param int $code
     * @return string
     */
    private function getStatusText($code)
    {
        $statusTexts = [
            200 => 'OK',
            201 => 'Created',
            204 => 'No Content',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            403 => 'Forbidden',
            404 => 'Not Found',
            422 => 'Unprocessable Entity',
            500 => 'Internal Server Error',
        ];

        return $statusTexts[$code] ?? 'Unknown Status';
    }
}
