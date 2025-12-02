<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@simek.test',
            'password' => Hash::make('password'),
            'phone' => '081234567890',
            'address' => 'Padang, Sumatera Barat',
            'institution' => 'Kampus Vokasi Padang',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
        $superAdmin->assignRole('super_admin');

        // Event Manager
        $eventManager = User::create([
            'name' => 'Event Manager',
            'email' => 'manager@simek.test',
            'password' => Hash::make('password'),
            'phone' => '081234567891',
            'address' => 'Padang, Sumatera Barat',
            'institution' => 'Kampus Vokasi Padang',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
        $eventManager->assignRole('event_manager');

        // Finance
        $finance = User::create([
            'name' => 'Finance Officer',
            'email' => 'finance@simek.test',
            'password' => Hash::make('password'),
            'phone' => '081234567892',
            'address' => 'Padang, Sumatera Barat',
            'institution' => 'Kampus Vokasi Padang',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
        $finance->assignRole('finance');

        // Committee
        $committee = User::create([
            'name' => 'Panitia Event',
            'email' => 'committee@simek.test',
            'password' => Hash::make('password'),
            'phone' => '081234567893',
            'address' => 'Padang, Sumatera Barat',
            'institution' => 'Kampus Vokasi Padang',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
        $committee->assignRole('committee');

        // Participant (5 peserta dummy)
        for ($i = 1; $i <= 5; $i++) {
            $participant = User::create([
                'name' => "Peserta $i",
                'email' => "peserta$i@simek.test",
                'password' => Hash::make('password'),
                'phone' => '08123456789' . $i,
                'address' => 'Padang, Sumatera Barat',
                'institution' => 'Universitas ' . chr(64 + $i), // A, B, C, D, E
                'status' => 'active',
                'email_verified_at' => now(),
            ]);
            $participant->assignRole('participant');
        }

        $this->command->info('✅ Users created successfully!');
        $this->command->info('');
        $this->command->info('=== LOGIN CREDENTIALS ===');
        $this->command->info('Super Admin:');
        $this->command->info('  Email: admin@simek.test');
        $this->command->info('  Password: password');
        $this->command->info('');
        $this->command->info('Event Manager:');
        $this->command->info('  Email: manager@simek.test');
        $this->command->info('  Password: password');
        $this->command->info('');
        $this->command->info('Finance:');
        $this->command->info('  Email: finance@simek.test');
        $this->command->info('  Password: password');
        $this->command->info('');
        $this->command->info('Committee:');
        $this->command->info('  Email: committee@simek.test');
        $this->command->info('  Password: password');
        $this->command->info('');
        $this->command->info('Participant:');
        $this->command->info('  Email: peserta1@simek.test - peserta5@simek.test');
        $this->command->info('  Password: password');
    }
}