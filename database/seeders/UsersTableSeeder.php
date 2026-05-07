<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        // مستخدم Admin
        User::updateOrCreate(
            ['email' => 'admin@vayoclinic.com'],
            [
                'name'     => 'Admin Vayo',
                'password' => Hash::make('123123123'),
                'is_admin' => true,
            ]
        );
    }
}
