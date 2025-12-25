<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TripayService
{
    protected $apiKey;
    protected $privateKey;
    protected $merchantCode;
    protected $apiUrl;

    public function __construct()
    {
        // Mengambil config dari .env
        $this->apiKey = env('TRIPAY_API_KEY');
        $this->privateKey = env('TRIPAY_PRIVATE_KEY');
        $this->merchantCode = env('TRIPAY_MERCHANT_CODE');
        $this->apiUrl = env('TRIPAY_API_URL');
    }

    /**
     * Membuat Transaksi Baru ke TriPay
     */
    public function createTransaction($data)
    {
        // 1. Generate Signature (Wajib untuk keamanan)
        // Rumus TriPay: HMAC_SHA256(merchantCode + merchantRef + amount, privateKey)
        $signature = hash_hmac('sha256', $this->merchantCode . $data['merchant_ref'] . $data['amount'], $this->privateKey);

        // 2. Siapkan Payload (Data yang akan dikirim)
        $payload = [
            'method'         => $data['method'], // Kode payment, misal: BRIVA, QRIS
            'merchant_ref'   => $data['merchant_ref'],
            'amount'         => $data['amount'],
            'customer_name'  => $data['customer_name'],
            'customer_email' => $data['customer_email'],
            'customer_phone' => $data['customer_phone'],
            'order_items'    => $data['order_items'],
            'callback_url'   => url('/api/tripay/callback'), // Nanti kita buat route ini
            'return_url'     => route('participant.registrations.show', ['registration' => $data['registration_id']]), // Redirect user kesini setelah bayar
            'expired_time'   => (time() + (24 * 60 * 60)), // 24 jam dari sekarang
            'signature'      => $signature
        ];

        // 3. Kirim Request ke API TriPay
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey
        ])->post($this->apiUrl, $payload);

        // 4. Cek apakah request berhasil
        if ($response->successful()) {
            return $response->json(); // Kembalikan response asli dari TriPay
        }

        // 5. Jika gagal, throw error biar ketahuan di Controller
        throw new \Exception('TriPay Error: ' . $response->body());
    }
    /**
     * Mengambil daftar channel pembayaran yang aktif
     */
    public function getPaymentChannels()
    {
        // Kita tentukan URL secara manual agar lebih aman
        // Jika API_URL lo mengandung 'api-sandbox', berarti kita pakai URL sandbox juga buat channel
        $isSandbox = str_contains($this->apiUrl, 'api-sandbox');
        $url = $isSandbox 
            ? 'https://tripay.co.id/api-sandbox/merchant/payment-channel'
            : 'https://tripay.co.id/api/merchant/payment-channel';

        // Kirim Request
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey
        ])->get($url);

        // Debugging: Jika gagal, kita ingin tau kenapa
        if ($response->failed()) {
            // Ini akan memunculkan pesan error asli dari TriPay (misal: "Unauthorized", "Invalid Signature", dll)
            throw new \Exception('Gagal ambil channel dari TriPay. Status: ' . $response->status() . '. Pesan: ' . $response->body());
        }

        // Jika sukses, kembalikan datanya
        return $response->json()['data'];
    }
}