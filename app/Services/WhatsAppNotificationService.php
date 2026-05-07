<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppNotificationService
{
    public function send(?string $phone, string $message): void
    {
        $enabled = (bool) config('services.whatsapp.enabled');
        $normalizedPhone = $phone ? $this->normalizePhone($phone) : null;

        Log::info('WhatsApp send dipanggil', [
            'enabled' => $enabled,
            'phone' => $phone,
            'normalized_phone' => $normalizedPhone,
            'message_length' => strlen($message),
        ]);

        if (!$enabled || empty($phone) || empty($message)) {
            Log::warning('WhatsApp skip', [
                'enabled' => $enabled,
                'phone_empty' => empty($phone),
                'message_empty' => empty($message),
            ]);
            return;
        }

        try {
            $response = Http::timeout(20)->withHeaders([
                'Authorization' => config('services.whatsapp.token'),
            ])->post(config('services.whatsapp.url'), [
                'target' => $normalizedPhone,
                'message' => $message,
            ]);

            if ($response->failed()) {
                Log::warning('WhatsApp API gagal', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'target' => $normalizedPhone,
                ]);
            } else {
                Log::info('WhatsApp API sukses', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'target' => $normalizedPhone,
                ]);
            }
        } catch (\Throwable $e) {
            Log::warning('Gagal kirim WhatsApp', ['error' => $e->getMessage()]);
        }
    }

    private function normalizePhone(string $phone): string
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        if (str_starts_with($phone, '0')) {
            return '62' . substr($phone, 1);
        }
        return $phone;
    }
}
