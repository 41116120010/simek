<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Event;
use App\Traits\ActivityLogger;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentController extends Controller
{
    use ActivityLogger;

    /**
     * Display a listing of payments - PERMISSION CHECK
     */
    public function index(Request $request)
    {
        // Double check permission
        if (!auth()->user()->can('view_payments')) {
            abort(403, 'Anda tidak memiliki izin untuk melihat payments.');
        }

        $query = Payment::with(['registration.user', 'registration.event'])
            ->latest();

        // Filter by event
        if ($request->has('event') && $request->event != '') {
            $query->whereHas('registration', function ($q) use ($request) {
                $q->where('event_id', $request->event);
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter by payment method
        if ($request->has('payment_method') && $request->payment_method != '') {
            $query->where('payment_method', $request->payment_method);
        }

        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('reference', 'like', '%' . $request->search . '%')
                  ->orWhere('merchant_ref', 'like', '%' . $request->search . '%')
                  ->orWhereHas('registration.user', function ($sq) use ($request) {
                      $sq->where('name', 'like', '%' . $request->search . '%');
                  });
            });
        }

        $payments = $query->paginate(15);
        $events = Event::orderBy('name')->get();

        return view('admin.payments.index', compact('payments', 'events'));
    }

    /**
     * Display the specified payment - PERMISSION CHECK
     */
    public function show(Payment $payment)
    {
        // Double check permission
        if (!auth()->user()->can('view_payments')) {
            abort(403, 'Anda tidak memiliki izin untuk melihat detail payment.');
        }

        if ($payment->status === 'unpaid' && $payment->expired_at && $payment->expired_at->isPast()) {
            $payment->update(['status' => 'expired']);
            $payment->refresh();
        }

        $payment->load([
            'registration.user',
            'registration.event',
            'registration.members'
        ]);

        return view('admin.payments.show', compact('payment'));
    }

    /**
     * Verify/Approve payment - PERMISSION CHECK
     */
    public function verify(Payment $payment)
    {
        // Double check permission
        if (!auth()->user()->can('verify_payments')) {
            abort(403, 'Anda tidak memiliki izin untuk verify payment.');
        }

        if ($payment->isPaid()) {
            return back()->with('info', 'Pembayaran sudah terverifikasi sebelumnya.');
        }

        try {
            $payment->markAsPaid();

            self::logActivity(
                'Verified payment: ' . $payment->reference,
                'payment',
                Payment::class,
                $payment->id,
                'verified'
            );

            return back()->with('success', 'Pembayaran berhasil diverifikasi!');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memverifikasi pembayaran: ' . $e->getMessage());
        }
    }

    /**
     * Reject payment - PERMISSION CHECK
     */
    public function reject(Payment $payment)
    {
        // Double check permission
        if (!auth()->user()->can('verify_payments')) {
            abort(403, 'Anda tidak memiliki izin untuk reject payment.');
        }

        try {
            $payment->update(['status' => 'failed']);

            // Update registration status
            $payment->registration->update(['status' => 'cancelled']);

            self::logActivity(
                'Rejected payment: ' . $payment->reference,
                'payment',
                Payment::class,
                $payment->id,
                'rejected'
            );

            return back()->with('success', 'Pembayaran ditolak!');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menolak pembayaran: ' . $e->getMessage());
        }
    }

    /**
     * Export payments to Excel - PERMISSION CHECK
     */
    public function exportExcel(Request $request)
    {
        // Double check permission
        if (!auth()->user()->can('export_payments')) {
            abort(403, 'Anda tidak memiliki izin untuk export payments.');
        }

        $query = Payment::with(['registration.user', 'registration.event']);

        if ($request->has('event') && $request->event != '') {
            $query->whereHas('registration', function ($q) use ($request) {
                $q->where('event_id', $request->event);
            });
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $payments = $query->get();

        return Excel::download(new \App\Exports\PaymentsExport($payments), 'payments_' . now()->format('Y-m-d_His') . '.xlsx');
    }

    /**
     * Export payments to PDF - PERMISSION CHECK
     */
    public function exportPdf(Request $request)
    {
        // Double check permission
        if (!auth()->user()->can('export_payments')) {
            abort(403, 'Anda tidak memiliki izin untuk export payments.');
        }

        $query = Payment::with(['registration.user', 'registration.event']);

        if ($request->has('event') && $request->event != '') {
            $query->whereHas('registration', function ($q) use ($request) {
                $q->where('event_id', $request->event);
            });
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $payments = $query->get();

        $pdf = Pdf::loadView('admin.payments.pdf', compact('payments'));
        return $pdf->download('payments_' . now()->format('Y-m-d_His') . '.pdf');
    }
}