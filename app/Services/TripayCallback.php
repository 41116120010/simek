<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Payment;
use App\Models\Registration;

class TripayCallback extends Controller
{
    public function handle(Request $request)
    {
        // 1. Ambil Callback Signature dari Header
        $callbackSignature = $request->header('X-Callback-Signature');
        
        // 2. Ambil JSON Content (Raw Body)
        $json = $request->getContent();

        // 3. Validasi Signature (Keamanan Tingkat Tinggi)
        // Kita hitung ulang signature pakai Private Key kita
        $privateKey = env('TRIPAY_PRIVATE_KEY');
        $signature = hash_hmac('sha256', $json, $privateKey);

        // Jika tanda tangan tidak cocok, tolak!
        if ($signature !== $callbackSignature) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid Signature',
            ], 403);
        }

        // 4. Jika Valid, Ambil Datanya
        $data = json_decode($json);
        $eventName = $request->header('X-Callback-Event');

        // Pastikan ini event update pembayaran
        if ($eventName !== 'payment_status') {
             return Response::json(['success' => true, 'message' => 'Event ignored']);
        }

        // 5. Cari Transaksi Berdasarkan Merchant Ref
        $merchantRef = $data->merchant_ref;
        $payment = Payment::where('merchant_ref', $merchantRef)->first();

        if (!$payment) {
            return Response::json([
                'success' => false,
                'message' => 'Payment not found',
            ], 404);
        }

        // 6. Cek Status Pembayaran dan Update Database
        $status = $data->status; // UNPAID, PAID, EXPIRED, FAILED

        if ($status === 'PAID') {
            // Update Tabel Payments
            $payment->update([
                'status' => 'paid',
                'paid_at' => now(), // Catat waktu bayar
                'payment_response' => json_encode($data) // Simpan log respons
            ]);

            // Update Tabel Registration jadi 'paid'
            $payment->registration->update(['status' => 'paid']);
            
        } elseif ($status === 'EXPIRED') {
            $payment->update(['status' => 'expired']);
            $payment->registration->update(['status' => 'cancelled']); // Atau biarkan waiting
            
        } elseif ($status === 'FAILED') {
            $payment->update(['status' => 'failed']);
        }

        // 7. Berikan respon sukses ke Tripay
        return Response::json(['success' => true]);
    }
}