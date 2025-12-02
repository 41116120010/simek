<?php

namespace App\Exports;

use App\Models\Event;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EventsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Event::with('registrations')
            ->withCount('registrations')
            ->latest()
            ->get();
    }

    public function headings(): array
    {
        return [
            'Kode Event',
            'Nama Event',
            'Tipe',
            'Status',
            'Tanggal Mulai',
            'Tanggal Selesai',
            'Tempat',
            'Kuota',
            'Jumlah Registrasi',
            'Biaya',
        ];
    }

    public function map($event): array
    {
        return [
            $event->code,
            $event->name,
            $event->type === 'competition' ? 'Lomba' : 'Seminar',
            ucfirst($event->status),
            $event->start_date->format('d/m/Y H:i'),
            $event->end_date->format('d/m/Y H:i'),
            $event->venue,
            $event->quota ?? 'Unlimited',
            $event->registrations_count,
            $event->is_free ? 'Gratis' : 'Rp ' . number_format($event->registration_fee, 0, ',', '.'),
        ];
    }
}