<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RegistrationsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $registrations;

    public function __construct($registrations)
    {
        $this->registrations = $registrations;
    }

    public function collection()
    {
        return $this->registrations;
    }

    public function headings(): array
    {
        return [
            'Kode Registrasi',
            'Event',
            'Nama Peserta',
            'Email',
            'No. Telepon',
            'Institusi',
            'Nama Tim',
            'Anggota Tim',
            'Status',
            'Tanggal Daftar',
            'Status Pembayaran',
            'Jumlah Bayar',
        ];
    }

    public function map($registration): array
    {
        $members = $registration->members->pluck('name')->implode(', ');
        $paymentStatus = $registration->payment ? $registration->payment->status : '-';
        $paymentAmount = $registration->payment ? 'Rp ' . number_format($registration->payment->amount, 0, ',', '.') : '-';

        return [
            $registration->registration_code,
            $registration->event->name,
            $registration->user->name,
            $registration->user->email,
            $registration->user->phone,
            $registration->user->institution,
            $registration->team_name ?? '-',
            $members ?: '-',
            ucfirst($registration->status),
            $registration->created_at->format('d M Y H:i'),
            ucfirst($paymentStatus),
            $paymentAmount,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}