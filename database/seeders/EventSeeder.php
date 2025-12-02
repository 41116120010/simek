<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventSession;
use App\Models\EventRequirement;
use App\Models\User;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $superAdmin = User::where('email', 'admin@simek.test')->first();

        // EVENT 1: Lomba Web Development (Team)
        $event1 = Event::create([
            'type' => 'competition',
            'name' => 'Lomba Web Development Competition 2025',
            'description' => 'Kompetisi pengembangan website untuk mahasiswa D3/D4/S1 se-Sumatera Barat. Peserta akan membuat website dengan tema Smart Campus dalam waktu 8 jam.',
            'terms_conditions' => '1. Mahasiswa aktif D3/D4/S1
2. Maksimal 3 orang per tim
3. Membawa laptop sendiri
4. Menggunakan framework bebas
5. Dilarang menggunakan template premium',
            'competition_type' => 'team',
            'max_team_members' => 3,
            'min_team_members' => 2,
            'venue' => 'Lab Komputer Lantai 3, Gedung Vokasi',
            'venue_address' => 'Kampus Vokasi Unand, Jl. Prof. Dr. Hamka, Padang',
            'venue_link' => 'https://maps.google.com/?q=-0.9471,100.4172',
            'start_date' => now()->addDays(30),
            'end_date' => now()->addDays(30)->addHours(8),
            'quota' => 20,
            'registration_fee' => 150000,
            'is_free' => false,
            'registration_start' => now(),
            'registration_end' => now()->addDays(25),
            'status' => 'published',
            'created_by' => $superAdmin->id,
        ]);

        // Event 1 - Sessions
        EventSession::create([
            'event_id' => $event1->id,
            'name' => 'Briefing & Technical Meeting',
            'description' => 'Penjelasan aturan lomba dan sesi tanya jawab',
            'start_time' => now()->addDays(30)->setTime(8, 0),
            'end_time' => now()->addDays(30)->setTime(9, 0),
            'location' => 'Aula Gedung Vokasi',
            'status' => 'scheduled',
        ]);

        EventSession::create([
            'event_id' => $event1->id,
            'name' => 'Babak Penyisihan',
            'description' => 'Pengerjaan website (8 jam)',
            'start_time' => now()->addDays(30)->setTime(9, 0),
            'end_time' => now()->addDays(30)->setTime(17, 0),
            'location' => 'Lab Komputer Lantai 3',
            'status' => 'scheduled',
        ]);

        EventSession::create([
            'event_id' => $event1->id,
            'name' => 'Presentasi & Pengumuman Pemenang',
            'description' => 'Presentasi karya dan pengumuman juara',
            'start_time' => now()->addDays(30)->setTime(17, 0),
            'end_time' => now()->addDays(30)->setTime(19, 0),
            'location' => 'Aula Gedung Vokasi',
            'status' => 'scheduled',
        ]);

        // Event 1 - Requirements
        EventRequirement::create([
            'event_id' => $event1->id,
            'name' => 'Kartu Tanda Mahasiswa (KTM)',
            'description' => 'Upload scan KTM semua anggota tim',
            'type' => 'file',
            'is_required' => true,
            'order' => 1,
        ]);

        EventRequirement::create([
            'event_id' => $event1->id,
            'name' => 'Surat Delegasi',
            'description' => 'Surat delegasi dari kampus/jurusan',
            'type' => 'file',
            'is_required' => true,
            'order' => 2,
        ]);

        EventRequirement::create([
            'event_id' => $event1->id,
            'name' => 'Portfolio Tim',
            'description' => 'Link portfolio tim (GitHub/Website)',
            'type' => 'link',
            'is_required' => false,
            'order' => 3,
        ]);

        // EVENT 2: Lomba UI/UX Design (Individual)
        $event2 = Event::create([
            'type' => 'competition',
            'name' => 'UI/UX Design Competition 2025',
            'description' => 'Kompetisi desain antarmuka aplikasi mobile untuk tema E-Commerce. Peserta akan mendesain prototype aplikasi menggunakan Figma.',
            'terms_conditions' => '1. Mahasiswa aktif D3/D4/S1
2. Peserta individu
3. Menggunakan Figma
4. Desain harus original
5. Menyertakan User Flow dan Wireframe',
            'competition_type' => 'individual',
            'max_team_members' => 1,
            'min_team_members' => 1,
            'venue' => 'Aula Serbaguna Kampus Vokasi',
            'venue_address' => 'Kampus Vokasi Unand, Jl. Prof. Dr. Hamka, Padang',
            'venue_link' => 'https://maps.google.com/?q=-0.9471,100.4172',
            'start_date' => now()->addDays(45),
            'end_date' => now()->addDays(45)->addHours(6),
            'quota' => 30,
            'registration_fee' => 100000,
            'is_free' => false,
            'registration_start' => now(),
            'registration_end' => now()->addDays(40),
            'status' => 'published',
            'created_by' => $superAdmin->id,
        ]);

        // Event 2 - Sessions
        EventSession::create([
            'event_id' => $event2->id,
            'name' => 'Opening & Briefing',
            'description' => 'Pembukaan dan penjelasan aturan',
            'start_time' => now()->addDays(45)->setTime(8, 0),
            'end_time' => now()->addDays(45)->setTime(9, 0),
            'location' => 'Aula Serbaguna',
            'status' => 'scheduled',
        ]);

        EventSession::create([
            'event_id' => $event2->id,
            'name' => 'Desain Session',
            'description' => 'Waktu mengerjakan desain (6 jam)',
            'start_time' => now()->addDays(45)->setTime(9, 0),
            'end_time' => now()->addDays(45)->setTime(15, 0),
            'location' => 'Aula Serbaguna',
            'status' => 'scheduled',
        ]);

        // Event 2 - Requirements
        EventRequirement::create([
            'event_id' => $event2->id,
            'name' => 'Kartu Tanda Mahasiswa (KTM)',
            'description' => 'Upload scan KTM',
            'type' => 'file',
            'is_required' => true,
            'order' => 1,
        ]);

        EventRequirement::create([
            'event_id' => $event2->id,
            'name' => 'Portfolio Desain',
            'description' => 'Link portfolio desain (Dribbble/Behance)',
            'type' => 'link',
            'is_required' => true,
            'order' => 2,
        ]);

        // EVENT 3: Seminar Teknologi AI
        $event3 = Event::create([
            'type' => 'seminar',
            'name' => 'Seminar Nasional: AI & Machine Learning for Beginners',
            'description' => 'Seminar nasional tentang penerapan Artificial Intelligence dan Machine Learning dalam kehidupan sehari-hari. Cocok untuk pemula yang ingin belajar AI.',
            'terms_conditions' => '1. Terbuka untuk umum
2. Mahasiswa/Pelajar/Profesional
3. Akan mendapat e-certificate
4. Wajib hadir tepat waktu',
            'speaker_name' => 'Dr. Budi Santoso, M.Kom',
            'speaker_bio' => 'AI Researcher di Institut Teknologi Bandung. Berpengalaman 10+ tahun dalam bidang Machine Learning dan Deep Learning. Pernah menjadi speaker di berbagai konferensi internasional.',
            'venue' => 'Auditorium Utama Kampus Vokasi',
            'venue_address' => 'Kampus Vokasi Unand, Jl. Prof. Dr. Hamka, Padang',
            'venue_link' => 'https://maps.google.com/?q=-0.9471,100.4172',
            'start_date' => now()->addDays(20),
            'end_date' => now()->addDays(20)->addHours(4),
            'quota' => 200,
            'registration_fee' => 50000,
            'is_free' => false,
            'registration_start' => now(),
            'registration_end' => now()->addDays(18),
            'status' => 'published',
            'created_by' => $superAdmin->id,
        ]);

        // Event 3 - Sessions
        EventSession::create([
            'event_id' => $event3->id,
            'name' => 'Registrasi & Opening',
            'description' => 'Registrasi peserta dan pembukaan acara',
            'start_time' => now()->addDays(20)->setTime(8, 0),
            'end_time' => now()->addDays(20)->setTime(9, 0),
            'location' => 'Lobby Auditorium',
            'status' => 'scheduled',
        ]);

        EventSession::create([
            'event_id' => $event3->id,
            'name' => 'Materi Sesi 1: Introduction to AI',
            'description' => 'Pengenalan dasar AI dan penerapannya',
            'start_time' => now()->addDays(20)->setTime(9, 0),
            'end_time' => now()->addDays(20)->setTime(10, 30),
            'location' => 'Auditorium Utama',
            'status' => 'scheduled',
        ]);

        EventSession::create([
            'event_id' => $event3->id,
            'name' => 'Coffee Break',
            'description' => 'Istirahat dan networking',
            'start_time' => now()->addDays(20)->setTime(10, 30),
            'end_time' => now()->addDays(20)->setTime(11, 0),
            'location' => 'Lobby Auditorium',
            'status' => 'scheduled',
        ]);

        EventSession::create([
            'event_id' => $event3->id,
            'name' => 'Materi Sesi 2: Machine Learning Basics',
            'description' => 'Dasar-dasar Machine Learning',
            'start_time' => now()->addDays(20)->setTime(11, 0),
            'end_time' => now()->addDays(20)->setTime(12, 30),
            'location' => 'Auditorium Utama',
            'status' => 'scheduled',
        ]);

        // Event 3 - Requirements
        EventRequirement::create([
            'event_id' => $event3->id,
            'name' => 'Identitas Diri',
            'description' => 'Upload KTP/KTM/Kartu Pelajar',
            'type' => 'file',
            'is_required' => true,
            'order' => 1,
        ]);

        // EVENT 4: Seminar Cyber Security (GRATIS)
        $event4 = Event::create([
            'type' => 'seminar',
            'name' => 'Workshop: Cyber Security Fundamentals',
            'description' => 'Workshop gratis tentang dasar-dasar keamanan siber. Peserta akan belajar tentang ethical hacking, network security, dan cara melindungi data pribadi.',
            'terms_conditions' => '1. Gratis untuk mahasiswa Kampus Vokasi
2. Membawa laptop
3. Install VirtualBox sebelum acara
4. Wajib hadir dari awal hingga akhir',
            'speaker_name' => 'Andi Pratama, S.Kom, CEH',
            'speaker_bio' => 'Certified Ethical Hacker dengan pengalaman 8 tahun di bidang cyber security. Saat ini bekerja sebagai Security Consultant di perusahaan multinasional.',
            'venue' => 'Lab Jaringan Komputer',
            'venue_address' => 'Gedung Vokasi Lt. 2, Kampus Vokasi Unand',
            'venue_link' => 'https://maps.google.com/?q=-0.9471,100.4172',
            'start_date' => now()->addDays(15),
            'end_date' => now()->addDays(15)->addHours(5),
            'quota' => 50,
            'registration_fee' => 0,
            'is_free' => true,
            'registration_start' => now(),
            'registration_end' => now()->addDays(13),
            'status' => 'published',
            'created_by' => $superAdmin->id,
        ]);

        // Event 4 - Sessions
        EventSession::create([
            'event_id' => $event4->id,
            'name' => 'Setup & Introduction',
            'description' => 'Setup environment dan pengenalan',
            'start_time' => now()->addDays(15)->setTime(9, 0),
            'end_time' => now()->addDays(15)->setTime(10, 0),
            'location' => 'Lab Jaringan Komputer',
            'status' => 'scheduled',
        ]);

        EventSession::create([
            'event_id' => $event4->id,
            'name' => 'Hands-on Practice',
            'description' => 'Praktik langsung cyber security',
            'start_time' => now()->addDays(15)->setTime(10, 0),
            'end_time' => now()->addDays(15)->setTime(14, 0),
            'location' => 'Lab Jaringan Komputer',
            'status' => 'scheduled',
        ]);

        // Event 4 - Requirements
        EventRequirement::create([
            'event_id' => $event4->id,
            'name' => 'Kartu Tanda Mahasiswa (KTM)',
            'description' => 'Upload scan KTM Kampus Vokasi',
            'type' => 'file',
            'is_required' => true,
            'order' => 1,
        ]);

        EventRequirement::create([
            'event_id' => $event4->id,
            'name' => 'Bukti Install VirtualBox',
            'description' => 'Screenshot VirtualBox yang sudah terinstall',
            'type' => 'file',
            'is_required' => true,
            'order' => 2,
        ]);

        $this->command->info('✅ Events with Sessions & Requirements created successfully!');
    }
}