<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions untuk Forests
        $forestPermissions = [
            'forest.view',
            'forest.create',
            'forest.edit',
            'forest.delete',
        ];

        // Create permissions untuk Plants
        $plantPermissions = [
            'plant.view',
            'plant.create',
            'plant.edit',
            'plant.delete',
        ];

        // Create permissions untuk Submissions
        $submissionPermissions = [
            'submission.view',
            'submission.create',
            'submission.edit',
            'submission.delete',
            'submission.approve',
            'submission.reject',
        ];

        // Create permissions untuk Reports
        $reportPermissions = [
            'report.view',
            'report.create',
            'report.edit',
            'report.delete',
            'report.verify',
            'report.resolve',
        ];

        // Create permissions untuk Articles
        $articlePermissions = [
            'article.view',
            'article.create',
            'article.edit',
            'article.delete',
            'article.publish',
        ];

        // Create permissions untuk Users
        $userPermissions = [
            'user.view',
            'user.create',
            'user.edit',
            'user.delete',
        ];

        // Create all permissions
        $allPermissions = array_merge(
            $forestPermissions,
            $plantPermissions,
            $submissionPermissions,
            $reportPermissions,
            $articlePermissions,
            $userPermissions
        );

        foreach ($allPermissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        // Create roles
        $adminRole = Role::create([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        $petugasRole = Role::create([
            'name' => 'petugas',
            'guard_name' => 'web',
        ]);

        $masyarakatRole = Role::create([
            'name' => 'masyarakat',
            'guard_name' => 'web',
        ]);        // Assign permissions to admin (semua akses)
        $adminRole->givePermissionTo($allPermissions);

        // Assign permissions to petugas (verifikasi laporan, update status, lihat data)
        $petugasRole->givePermissionTo([
            'forest.view',
            'plant.view',
            'submission.view',
            'submission.approve',
            'submission.reject',
            'report.view',
            'report.verify',
            'report.resolve',
            'article.view',
            'article.create',
            'article.edit',
        ]);

        // Assign permissions to masyarakat (kirim pengajuan & laporan, lihat status)
        $masyarakatRole->givePermissionTo([
            'forest.view',
            'plant.view',
            'submission.view',
            'submission.create',
            'report.view',
            'report.create',
            'article.view',
        ]);

        // Create admin user
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@perhutani.go.id'],
            [
                'name' => 'Admin Perhutani',
                'password' => bcrypt('admin123'),
            ]
        );
        $adminUser->assignRole('admin');

        // Create petugas user
        $petugasUser = User::firstOrCreate(
            ['email' => 'petugas@perhutani.go.id'],
            [
                'name' => 'Petugas Lapangan',
                'password' => bcrypt('petugas123'),
            ]
        );
        $petugasUser->assignRole('petugas');

        // Create masyarakat user
        $masyarakatUser = User::firstOrCreate(
            ['email' => 'masyarakat@gmail.com'],
            [
                'name' => 'Warga Masyarakat',
                'password' => bcrypt('masyarakat123'),
            ]
        );
        $masyarakatUser->assignRole('masyarakat');
    }
}
