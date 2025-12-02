<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Daftar Permissions
        $permissions = [
            // Event Management
            'view_events',
            'create_events',
            'edit_events',
            'delete_events',
            'publish_events',
            'export_events',
            
            // Registration Management
            'view_registrations',
            'approve_registrations',
            'reject_registrations',
            'export_registrations',
            
            // Payment Management
            'view_payments',
            'verify_payments',
            'refund_payments',
            'export_payments',
            
            // User Management
            'view_users',
            'create_users',
            'edit_users',
            'delete_users',
            
            // Role & Permission Management
            'view_roles',
            'create_roles',
            'edit_roles',
            'delete_roles',
            'assign_roles',
            
            // Poster Management
            'view_posters',
            'create_posters',
            'edit_posters',
            'delete_posters',
            
            // Attendance Management
            'view_attendances',
            'mark_attendance',
            'export_attendances',
            
            // Activity Log
            'view_activity_logs',
            
            // Dashboard
            'view_admin_dashboard',
        ];

        // Buat semua permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // ROLE: Super Admin (Full Access)
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin']);
        $superAdmin->syncPermissions(Permission::all());

        // ROLE: Event Manager (Kelola Event & Registrasi)
        $eventManager = Role::firstOrCreate(['name' => 'event_manager']);
        $eventManager->syncPermissions([
            'view_events',
            'create_events',
            'edit_events',
            'delete_events',
            'publish_events',
            'export_events',
            'view_registrations',
            'approve_registrations',
            'reject_registrations',
            'export_registrations',
            'view_payments',
            'verify_payments',
            'view_posters',
            'create_posters',
            'edit_posters',
            'view_attendances',
            'mark_attendance',
            'export_attendances',
            'view_admin_dashboard',
        ]);

        // ROLE: Finance (Kelola Pembayaran)
        $finance = Role::firstOrCreate(['name' => 'finance']);
        $finance->syncPermissions([
            'view_events',
            'view_registrations',
            'view_payments',
            'verify_payments',
            'refund_payments',
            'export_payments',
            'export_registrations',
            'view_admin_dashboard',
        ]);

        // ROLE: Committee (Absensi & Lihat Data)
        $committee = Role::firstOrCreate(['name' => 'committee']);
        $committee->syncPermissions([
            'view_events',
            'view_registrations',
            'view_attendances',
            'mark_attendance',
            'view_admin_dashboard',
        ]);

        // ROLE: Participant (Peserta Biasa)
        $participant = Role::firstOrCreate(['name' => 'participant']);
        // Participant nggak perlu permission khusus, cuma bisa daftar event

        $this->command->info('✅ Roles & Permissions created successfully!');
    }
}