SIMEK (Sistem Manajemen Event Kampus) adalah Aplikasi berbasis Web yang saya buat untuk membantu Organisasi Kampus mengatur berbagai Event, mulai dari Lomba hingga Seminar.
Project ini masih dalam Tahap Pengembangan dan astinya terdapat Kekurangan. Maka dari itu akan terus Saya Kembangkan secara bertahap hingga Final Release.

## Fitur Utama
Beberapa fitur yang sudah ada, antara lain :

- **Manajemen Event**
  - Membuat dan Mengelola Event (Lomba / Seminar) dalam satu Dashboard.
  - Tersedia Tipe Peserta untuk Event yang dibuat, berupa Individual, Tim, dan Individual & Tim.
  - Status Event bisa diatur ke Draft, Aktif, atau Selesai.

- **Pendaftaran Peserta**
  - Form Pedaftaran Online untuk Peserta.
  - Data Peserta tersimpan Rapi di Database.
  - Tersedia Validasi Data Dasar (nama, kontak, dst.)

- **Pembayaran (Work in Progress)**
  - Rencana integrasi Pembayaran Online via **Tripay atau Midtrans**
  - Targetnya, kalau pembayaran sudah valid maka pendaftaran otomatis terkonfirmasi.

- **Notifikasi (Planned)**
  - Notifikasi via WhatsApp / e-mail untuk :
    - Status Pembayaran.
    - Pengingat Jadwal Event.

- **Role & Akses**
  - Super Admin : Akses Penuh (untuk Ketua dan Wakil Organisasi)
  - Role dengan Perizinan yang bisa diatur dan dibuat oleh Super Admin.

## Tech Stack
Project ini dibangun dengan :

- **Backend** : Laravel 12
- **Frontend** : Blade + TailAdmin (Tailwind CSS v4)
- **Database** : MySQL / MariaDB
- **Bundler** : Vite
- **Pembayaran** : Tripay/Midtrans (On Progress)
