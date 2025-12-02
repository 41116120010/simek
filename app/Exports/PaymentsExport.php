<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PaymentsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $payments;

    public function __construct($payments)
    {
        $this->payments = $payments;
    }

    public function collection()
    {
        return $this->payments;
    }

    public function headings(): array
    {
        return [
            'Reference',
            'Merchant Ref',
            'Event',
            'Nama Peserta',
            'Email',
            'Payment Method',
            'Amount',
            'Fee',
            'Total',
            'Status',
            'Paid At',
            'Created At',
        ];
    }

    public function map($payment): array
    {
        return [
            $payment->reference,
            $payment->merchant_ref,
            $payment->registration->event->name,
            $payment->registration->user->name,
            $payment->registration->user->email,
            $payment->payment_channel ?? '-',
            'Rp ' . number_format($payment->amount, 0, ',', '.'),
            'Rp ' . number_format($payment->fee, 0, ',', '.'),
            'Rp ' . number_format($payment->total_amount, 0, ',', '.'),
            ucfirst($payment->status),
            $payment->paid_at ? $payment->paid_at->format('d M Y H:i') : '-',
            $payment->created_at->format('d M Y H:i'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}