<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 pb-20 md:p-6 md:pb-6">
        <!-- Breadcrumb -->
        <div class="flex flex-wrap items-center justify-between gap-3 pb-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Pembayaran</h2>
            <nav>
                <ol class="flex items-center gap-1.5">
                    <li>
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400" href="{{ route('dashboard') }}">
                            Dashboard
                            <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400" href="{{ route('participant.registrations.index') }}">
                            Registrasi Saya
                            <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400" href="{{ route('participant.registrations.show', $registration) }}">
                            {{ $registration->registration_code }}
                            <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                    </li>
                    <li class="text-sm text-gray-800 dark:text-white/90">Pembayaran</li>
                </ol>
            </nav>
        </div>

        <div class="space-y-6">
            <!-- Payment Warning (Countdown) -->
            @if($registration->payment && $registration->payment->expired_at && !$registration->payment->isExpired())
            <div class="rounded-xl border border-orange-200 bg-orange-50 p-5 dark:border-orange-800 dark:bg-orange-900/20">
                <div class="flex items-start gap-3">
                    <span class="flex h-12 w-12 items-center justify-center rounded-full bg-orange-500 text-white text-2xl">⏰</span>
                    <div class="flex-1">
                        <p class="font-semibold text-orange-800 dark:text-orange-400 mb-1">Batas waktu pembayaran:</p>
                        <p class="text-sm text-orange-700 dark:text-orange-400 mb-1">{{ $registration->payment->expired_at->format('d M Y, H:i') }} WIB</p>
                        <p class="text-xs text-orange-600 dark:text-orange-400">
                            Sisa waktu: {{ now()->diffForHumans($registration->payment->expired_at, true) }}
                        </p>
                    </div>
                </div>
            </div>
            @elseif($registration->payment && $registration->payment->isExpired())
            <div class="rounded-xl border border-red-200 bg-red-50 p-5 dark:border-red-800 dark:bg-red-900/20">
                <div class="flex items-start gap-3">
                    <span class="flex h-12 w-12 items-center justify-center rounded-full bg-red-500 text-white text-2xl">⚠️</span>
                    <div class="flex-1">
                        <p class="font-semibold text-red-800 dark:text-red-400 mb-1">Pembayaran Kadaluarsa</p>
                        <p class="text-sm text-red-700 dark:text-red-400">Batas waktu pembayaran telah habis. Silakan hubungi panitia untuk bantuan.</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Registration Info -->
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Detail Registrasi</h3>
                </div>
                <div class="p-5 sm:p-6 space-y-3">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Kode Registrasi</span>
                        <span class="font-mono font-semibold text-gray-800 dark:text-white/90">{{ $registration->registration_code }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Event</span>
                        <span class="font-semibold text-gray-800 dark:text-white/90">{{ $registration->event->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Nama Peserta</span>
                        <span class="font-semibold text-gray-800 dark:text-white/90">{{ $registration->user->name }}</span>
                    </div>
                    @if($registration->team_name)
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Nama Tim</span>
                        <span class="font-semibold text-gray-800 dark:text-white/90">{{ $registration->team_name }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Payment Details -->
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Detail Pembayaran</h3>
                </div>
                <div class="p-5 sm:p-6 space-y-4">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Biaya Pendaftaran</span>
                        <span class="font-semibold text-gray-800 dark:text-white/90">Rp {{ number_format($registration->payment->amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Biaya Admin</span>
                        <span class="font-semibold text-gray-800 dark:text-white/90">Rp {{ number_format($registration->payment->fee, 0, ',', '.') }}</span>
                    </div>
                    <div class="border-t border-gray-200 dark:border-gray-800 pt-4">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-800 dark:text-white/90">Total Pembayaran</span>
                            <span class="text-2xl font-bold text-brand-500">Rp {{ number_format($registration->payment->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Instructions -->
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-200 px-5 py-4 sm:px-6 sm:py-5 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">📋 Instruksi Pembayaran</h3>
                </div>
                <div class="p-5 sm:p-6">
                    @if($registration->payment->isPaid())
                        <!-- Payment Success -->
                        <div class="rounded-lg border border-green-200 bg-green-50 p-5 dark:border-green-800 dark:bg-green-900/20">
                            <div class="flex items-start gap-3">
                                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-green-500 text-white">✓</span>
                                <div>
                                    <p class="font-semibold text-green-800 dark:text-green-400 mb-1">Pembayaran berhasil!</p>
                                    <p class="text-sm text-green-700 dark:text-green-400">Terima kasih telah melakukan pembayaran. Registrasi Anda sedang diproses.</p>
                                </div>
                            </div>
                        </div>
                    @elseif($registration->payment->isExpired())
                        <!-- Payment Expired -->
                        <div class="rounded-lg border border-red-200 bg-red-50 p-5 dark:border-red-800 dark:bg-red-900/20">
                            <div class="flex items-start gap-3">
                                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-red-500 text-white">⚠️</span>
                                <div>
                                    <p class="font-semibold text-red-800 dark:text-red-400 mb-1">Pembayaran kadaluarsa</p>
                                    <p class="text-sm text-red-700 dark:text-red-400">Batas waktu pembayaran telah habis. Silakan hubungi panitia untuk bantuan.</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Important Notes -->
                        <div class="rounded-lg border border-blue-200 bg-blue-50 p-4 mb-6 dark:border-blue-800 dark:bg-blue-900/20">
                            <p class="font-semibold text-blue-800 dark:text-blue-400 mb-2">💡 Catatan Penting:</p>
                            <ul class="text-sm text-blue-700 dark:text-blue-400 space-y-1 list-disc list-inside">
                                <li>Pastikan nominal yang ditransfer sesuai dengan total pembayaran</li>
                                <li>Simpan bukti pembayaran Anda</li>
                                <li>Pembayaran akan otomatis terverifikasi setelah konfirmasi dari sistem</li>
                                <li>Jika ada kendala, hubungi panitia melalui kontak yang tersedia</li>
                            </ul>
                        </div>

                        <!-- Manual Transfer Section -->
                        <div class="space-y-6">
                            <div>
                                <h4 class="font-semibold text-gray-800 dark:text-white/90 mb-4">🏦 Transfer Manual</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Silakan transfer ke rekening berikut:</p>
                                
                                <div class="bg-gray-50 dark:bg-white/[0.02] p-5 rounded-xl border border-gray-200 dark:border-gray-800 space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Bank</span>
                                        <span class="font-semibold text-gray-800 dark:text-white/90">BCA</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">No. Rekening</span>
                                        <span class="font-mono font-semibold text-gray-800 dark:text-white/90">1234567890</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Atas Nama</span>
                                        <span class="font-semibold text-gray-800 dark:text-white/90">SIMEK Event Management</span>
                                    </div>
                                    <div class="flex justify-between items-center pt-3 border-t border-gray-200 dark:border-gray-700">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Jumlah Transfer</span>
                                        <div class="text-right flex items-center gap-2">
                                            <span class="font-bold text-brand-500 text-lg">Rp {{ number_format($registration->payment->total_amount, 0, ',', '.') }}</span>
                                            <button type="button" onclick="copyToClipboard('{{ $registration->payment->total_amount }}')" class="shadow-theme-xs inline-flex items-center gap-1 rounded-lg bg-gray-100 px-2 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700">
                                                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                                </svg>
                                                Copy
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tripay Placeholder -->
                            <div class="rounded-lg border border-yellow-200 bg-yellow-50 px-4 py-3 dark:border-yellow-800 dark:bg-yellow-900/20">
                                <p class="text-sm font-semibold text-yellow-800 dark:text-yellow-400 mb-1">⚠️ Integrasi Payment Gateway (Tripay) sedang dalam pengembangan</p>
                                <p class="text-xs text-yellow-700 dark:text-yellow-400">Untuk sementara, silakan lakukan transfer manual dan hubungi panitia untuk konfirmasi pembayaran.</p>
                            </div>

                            <!-- Contact Info -->
                            <div class="border-t border-gray-200 dark:border-gray-800 pt-6">
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                                    Setelah melakukan pembayaran, hubungi panitia untuk konfirmasi:
                                </p>
                                <div class="flex flex-wrap gap-4">
                                    <a href="https://wa.me/6281234567890" target="_blank" class="inline-flex items-center gap-2 text-sm text-green-600 hover:text-green-700 dark:text-green-500">
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                        </svg>
                                        WhatsApp: 0812-3456-7890
                                    </a>
                                    <span class="text-gray-400">|</span>
                                    <a href="mailto:admin@simek.test" class="inline-flex items-center gap-2 text-sm text-brand-500 hover:text-brand-600">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        admin@simek.test
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end gap-4">
                <a href="{{ route('participant.registrations.show', $registration) }}" class="shadow-theme-xs inline-flex items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-6 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Detail
                </a>
                @if(!$registration->payment->isPaid() && !$registration->payment->isExpired())
                <button type="button" onclick="alert('Fitur upload bukti pembayaran akan segera tersedia!')" class="shadow-theme-xs inline-flex items-center justify-center gap-2 rounded-lg bg-brand-500 px-6 py-2.5 text-sm font-medium text-white hover:bg-brand-600">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    Upload Bukti Pembayaran
                </button>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function copyToClipboard(text) {
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).then(function() {
                    alert('Nominal berhasil dicopy!');
                }, function(err) {
                    console.error('Could not copy text: ', err);
                    alert('Gagal copy nominal');
                });
            } else {
                // Fallback for older browsers
                const textArea = document.createElement("textarea");
                textArea.value = text;
                textArea.style.position = "fixed";
                textArea.style.left = "-999999px";
                document.body.appendChild(textArea);
                textArea.select();
                try {
                    document.execCommand('copy');
                    alert('Nominal berhasil dicopy!');
                } catch (err) {
                    console.error('Fallback: Could not copy text', err);
                    alert('Gagal copy nominal');
                }
                document.body.removeChild(textArea);
            }
        }
    </script>
    @endpush
</x-app-layout>