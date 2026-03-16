<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ApiLogger
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Siapkan data log
        $logData = [
            "ip" => $request->ip(),
            "method" => $request->method(),
            "url" => $request->fullUrl(),
            "payload" => $request->all(),
            "status" => $response->getStatusCode(),
            "response" => json_decode($response->getContent(), true) ?? $response->getContent()
        ];

        // 1. Catat ke file log.log (Normal)
        Log::info("API_TRAFFIC", $logData);

        // 2. Tampil di console cantik, berwarna, dan indentasi rapi
        $this->printToConsole($logData);

        return $response;
    }

    private function printToConsole(array $data): void
    {
        // Format JSON agar cantik (Pretty Print)
        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        $json = str_replace("\n", "\n\033[0m", $json);

        // Warnai JSON
        $coloredJson = preg_replace(
            [
                "/(\"(?:[^\"\\\\]|\\\\.)*\")\s*:/", // Kunci (Cyan)
                "/:\s*(\"(?:[^\"\\\\]|\\\\.)*\")/", // Teks (Hijau)
                "/:\s*(-?\d+(?:\.\d+)?)/",          // Angka (Kuning)
                "/:\s*(true|false|null)/"           // Boolean/Null (Ungu)
            ],
            [
                "\033[36m$1\033[0m:",
                ": \033[32m$1\033[0m",
                ": \033[33m$1\033[0m",
                ": \033[35m$1\033[0m"
            ],
            $json
        );

        // Cetak ke terminal
        file_put_contents("php://stderr", "\n\033[1m\033[0m\n" . $coloredJson . "\n\n");
    }
}
