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
            ['email' => 'admin@vayuclinic.com'],
            [
                'name'     => 'Admin vayu',
                'password' => Hash::make('123123123'),
                'is_admin' => true,
            ]
        );
    }
}
